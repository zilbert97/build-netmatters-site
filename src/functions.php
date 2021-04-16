<?php

function connect_database()
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
    $db = connect_database();
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
