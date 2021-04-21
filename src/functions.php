<?php
/**
 * File functions.php - Utility functions
 *
 * PHP version 8
 *
 * @category
 * @package
 * @author
 * @license
 * @link
 */


function connect_to_database()
{
    try {
        $db = new PDO("sqlite:" . __DIR__ . '/database.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
        return false;
    }
}

function get_latest_news()
{
    $db = connect_to_database();
    try {
        // Get the 3 most latest news items
        $results = $db->query('SELECT * FROM latest_news ORDER BY posted_at DESC LIMIT 3');
        return $results->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function generate_filename($string)
{
    // Remove any special chars and replace whitespace/underscores with dashes
    $filename = str_replace([' ', '_'], '-', $string);
    $filename = preg_replace('/[^A-Za-z0-9\-]/', '', $filename);
    // Convert to lower case
    $filename = strtolower($filename);

    return $filename;
}


function get_card_image($filename)
{
    $extensions = ['.jpg','.jpeg','.png'];

    foreach ($extensions as $extension) {
        $filepath = "img/$filename" . $extension;
        if (file_exists($filepath)) {
            return $filepath;
        }
    }

    switch ($filename) {
        case $filename == 'netmatters-ltd':
            return 'img/netmatters-logo-small.png';
        default:
            return 'img/netmatters-logo-background.png';
    }
}

function display_latest_news(array $news_item)
{
    // Cover image filename is based on news item title
    $cover_img_filepath = get_card_image(
        generate_filename($news_item['title'])
    );
    // Posted by avatar image is based on news item posted_by
    $posted_by_img_filepath = get_card_image(
        generate_filename($news_item['posted_by'])
    );
    $posted_at = date('jS F Y', strtotime($news_item['posted_at']));

    $card_style;
    switch ($news_item['category']) {
        case 'case studies':
            $card_style = 'bespoke-software';
            break;

        default:
            $card_style = 'it-support';
            break;
    }

    $post = <<<EOD
<div class="news-card news-card-{$card_style}">
    <div class="news-card-cover">
        <a href="#">
            <div class="image-wrapper">
                <img class="news-card-image" src="{$cover_img_filepath}" alt="{$news_item['title']}">
            </div>
        </a>
        <a class="news-card-category" href="#">{$news_item['category']}</a>
    </div>
    <div class="news-card-summary">
        <a class="title-link" href="#">
            <h6>{$news_item['title']}</h6>
        </a>
        <p class="card-description">{$news_item['summary']}&hellip;</p>
        <a class="read-more" href="#">Read more</a>
        <hr />
        <img class="logo-small" src="{$posted_by_img_filepath}" alt="News article posted by {$news_item['posted_by']}">
        <div class="card-publish-info">
            <p><strong>Posted by {$news_item['posted_by']}</strong></p>
            <p>{$posted_at}</p>
        </div>
    </div>
</div>
EOD;

    return $post;
}

function formatPhoneNumber($phone)
{
    // Strip any whitespace, brackets, or dashes from phone number
    return preg_replace('/[\s\(\)\-]/', '', $phone);
}

function redirect($path)
{
    $response = \Symfony\Component\HttpFoundation\Response::create(
        null, \Symfony\Component\HttpFoundation\Response::HTTP_FOUND, ['Location' => $path]
    );
    /*
    if (key_exists('cookies', $extra)) {
        foreach ($extra['cookies'] as $cookie) {
            $response->headers->setCookie($cookie);
        }
    }
    */

    $response->send();
    exit;
}

function displayFormResponseMessages()
{
    global $session;

    // If no error or success messages in the flash bag
    if (!$session->getFlashBag()->has('success') && !$session->getFlashBag()->has('error')) {
        // Early return
        return;
    }

    // Else display messages
    $messageContainer = '<div class="form--response-wrapper">';

    // If error messages in flash bag
    if ($session->getFlashBag()->has('error')) {
        $errorMessages = $session->getFlashBag()->get('error');

        // Display each error message
        foreach ($errorMessages as $message) {
            $messageContainer .= '<div class="form--response-error-message">';
            $messageContainer .= '<p class="form--response-copy">' . $message . '</p>';
            $messageContainer .= '</div>';
        }
    }
    // Else if not error messages, and success message, in flash bag
    else if ($session->getFlashBag()->has('success')) {
        $message = $session->getFlashBag()->get('success')[0];

        // Display a success message
        $messageContainer .= '<div class="form--response-success-message">';
        $messageContainer .= '<p class="form--response-copy">' . $message . '</p>';
        $messageContainer .= '</div>';
    }

    $messageContainer .= '</div>';

    echo $messageContainer;
}
