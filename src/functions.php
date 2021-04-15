<?php

function connect_database() {
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

function get_latest_news() {
    $db = connect_database();
    try {
        // Get the 3 most latest news items
        $results = $db->query('SELECT * FROM latest_news ORDER BY posted_at LIMIT 3');
        return $results->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function display_latest_news(
    $cover_image_path = 'img/netmatters-logo-background.png',
    $title,
    $summary,
    $category,
    $posted_by,
    $posted_by_image_path = 'img/netmatters-logo-small.png',
    $posted_at
) {
}

foreach(get_latest_news() as $news_item) {
    
    // Need a handler that will check if file exists based on title/date
    // Need a handler that will convert date to correct string format
    
    // Do some validation
    display_latest_news();
}