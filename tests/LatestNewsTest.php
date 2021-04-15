<?php

require(__DIR__ . '/../src/functions.php');

class LatestNewsTest extends PHPUnit\Framework\TestCase
{
    /** @test */
    /*
    public function displayThreeLatestNewsCards()
    {
    }
    */
    
    /** @test */
    public function getThreeLatestNewsEntries()
    {
        $entries = get_latest_news();
        $this->assertCount(3, $entries);
        foreach ($entries as $news_item) {
            $this->assertIsArray($news_item);
        }
    }
    
    /** @test */
    public function showLatestNewsEntry()
    {
        $card = 'placeholder';
        $this->assertIsString($card);
    }
    
}
