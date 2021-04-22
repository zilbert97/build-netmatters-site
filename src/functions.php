<?php
/**
 * Utility functions
 *
 * PHP version 8
 *
 * @category
 * @package
 * @author   Z Gilbert <zach.gilbert@netmatters-scs.co.uk>
 * @license  github.com/zilbert97/build-netmatters-site/blob/add-php/LICENSE LICENSE
 * @link     https://www.github.com/zilbert97/build-netmatters-site/blob/add-php/src/functions.php
 */

 /**
  * Establishes a connection to the database
  *
  * @return PDO|bool Database connection object, or false if unsuccesful
  */
function connectToDatabase()
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

/**
 * Gets 3 most recent latest news results from the database
 *
 * @return array|bool Top 3 news results from database, or false if unsuccesful
 */
function getLatestNews()
{
    $db = connectToDatabase();
    if ($db) {
        try {
            $query = 'SELECT * FROM latest_news ORDER BY posted_at DESC LIMIT 3';
            $results = $db->query($query);
            return $results->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
    return false;
}

/**
 * Creates a filename for assets based on the latest news item title
 *
 * @param string $title Title of the latest news item
 *
 * @return string A formatted filename based on the item title
 */
function generateFilename($title)
{
    // Remove any special chars and replace whitespace/underscores with dashes
    $filename = str_replace([' ', '_'], '-', $title);
    $filename = preg_replace('/[^A-Za-z0-9\-]/', '', $filename);
    // Convert to lower case
    $filename = strtolower($filename);

    return $filename;
}

/**
 * Gets the image asset based on the latest news item title
 *
 * @param string $filename Formatted filename of the latest news item title
 *
 * @return string Path to the latest news item image based on news item filename
 */
function getCardImage($filename)
{
    $extensions = ['.jpg','.jpeg','.png'];

    foreach ($extensions as $extension) {
        $filepath = "img/$filename" . $extension;
        if (file_exists($filepath)) {
            return $filepath;
        }
    }

    switch ($filename) {
    case 'netmatters-ltd':
        return 'img/netmatters-logo-small.png';
    default:
        return 'img/netmatters-logo-background.png';
    }
}

/**
 * Generates the news card HTML body from a news item data array
 *
 * @param array $news_item Array of new item data to display
 *
 * @return string HTML for the news card to display
 */
function displayLatestNews(array $news_item)
{
    // Get the cover image filename, which is based on news item title
    $cover_img_filepath = getCardImage(
        generateFilename($news_item['title'])
    );
    // Get the posted by avatar image, which is based on news item posted_by
    $posted_by_img_filepath = getCardImage(
        generateFilename($news_item['posted_by'])
    );
    // Convert the datetime from the data row to a format for the card
    $posted_at = date('jS F Y', strtotime($news_item['posted_at']));

    // Get the card style (colours) based on the card category
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

/**
 * Removes whitespace, brackets, and dashes from the phone number string
 *
 * @param string $phone Contact number string
 *
 * @return string The formatted phone number string
 */
function formatPhoneNumber($phone)
{
    // Strip any whitespace, brackets, or dashes from phone number
    return preg_replace('/[\s\(\)\-]/', '', $phone);
}

/**
 * Redirects the page to the path passed
 *
 * @param string $path Path to a site page to reidrect to
 *
 * @return void
 */
function redirect($path) : void
{
    $response = \Symfony\Component\HttpFoundation\Response::create(
        null,
        \Symfony\Component\HttpFoundation\Response::HTTP_FOUND, ['Location'=>$path]
    );

    $response->send();
    exit;
}

/**
 * Displays an error or success message from the flash bag to the user
 *
 * @return void
 */
function displayFormResponseMessages() : void
{
    global $session;

    // If no error or success messages in the flash bag
    if (!$session->getFlashBag()->has('success') && !$session->getFlashBag()->has('error')) {
        // No errors or success message means that the page has been refreshed
        // or been navigated to - therefore we don't want to display the stored
        // user values from the session on form fields

        // Early return
        return;
    }

    // Else display messages
    $messageBody = '<div class="form--response-wrapper">';

    // If error messages in flash bag
    if ($session->getFlashBag()->has('error')) {
        $errorMessages = $session->getFlashBag()->get('error');

        // Generate each error message
        foreach ($errorMessages as $message) {
            $messageBody .= '<div class="form--response-error-message">';
            $messageBody .= '<p class="form--response-copy">' . $message . '</p>';
            $messageBody .= '</div>';
        }
    } else if ($session->getFlashBag()->has('success')) {
        // Else if not error messages, and success message, in flash bag
        $message = $session->getFlashBag()->get('success')[0];

        // Generate a success message
        $messageBody .= '<div class="form--response-success-message">';
        $messageBody .= '<p class="form--response-copy">' . $message . '</p>';
        $messageBody .= '</div>';
    }

    $messageBody .= '</div>';

    echo $messageBody;
}
