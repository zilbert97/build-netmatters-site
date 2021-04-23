<?php

require_once __DIR__ . '/../src/functions.php';

class LatestNewsTest extends PHPUnit\Framework\TestCase
{
    /** @test */
    public function getThreeLatestNewsEntries()
    {
        $entries = getLatestNews();
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

    /** @test */
    public function generateNewsCardFileName()
    {
        $filename = 'this-is-an-example-1-23-filename';
        $this->assertEquals(
            $filename,
            generateFilename('/This/ !is @an EXAMPLE_1-2.3 filename')
        );
    }

    /** @test */
    public function getNewsCardCoverImage()
    {
        // Image that does exist in file path - therefore gets default image
        $this->assertFileExists(
            getCardImage(
                'A card title that does not exist',
                'img/netmatters-logo-background.png'
            )
        );

        // Image that does exist in file path
        $this->assertFileExists(
            getCardImage(
                'Happy 25th Birthday Kati!',
                'img/netmatters-logo-background.png'
            )
        );
    }

    /** @test */
    public function getNewsCardPostedByImage()
    {
        // Image that does not exist in file path - therefore gets default image
        $this->assertFileExists(
            getCardImage(
                'Something that does NOT exist!',
                'img/netmatters-logo-small.png'
            )
        );

        // Image that does exist in file path - 1
        $this->assertFileExists(
            getCardImage(
                'Simon Wright',
                'img/netmatters-logo-background.png'
            )
        );
        // Image that does exist in file path - 2
        $this->assertFileExists(
            getCardImage(
                'Netmatters Ltd',
                'img/netmatters-logo-background.png'
            )
        );
    }

    /** @test */
    public function formatPostedAtDate()
    {
        $formatted_date = date('jS F Y', strtotime('2020-12-18 00:00:00'));

        $this->assertEquals($formatted_date, '18th December 2020');
        //return strftime(, );
    }

    /** @test */
    public function displayLatestNewsCard()
    {
        $expectedPost = <<<EOD
        <div class="news-card news-card-it-support">
            <div class="news-card-cover">
                <a href="#">
                    <div class="image-wrapper">
                        <img class="news-card-image"
                             src="img/happy-25th-birthday-kati.jpeg"
                             alt="Happy 25th Birthday Kati!">
                    </div>
                </a>
                <a class="news-card-category" href="#">news</a>
            </div>
            <div class="news-card-summary">
                <a class="title-link" href="#">
                    <h6>Happy 25th Birthday Kati!</h6>
                </a>
                <p class="card-description">Since joining Netmatters Kati has done a fantastic job keeping our IT projects progressing&hellip;</p>
                <a class="read-more" href="#">Read more</a>
                <hr />
                <img class="logo-small"
                     src="img/netmatters-logo-small.png"
                     alt="News article posted by Netmatters Ltd">
                <div class="card-publish-info">
                    <p><strong>Posted by Netmatters Ltd</strong></p>
                    <p>18th December 2020</p>
                </div>
            </div>
        </div>
        EOD;

        $dataArray = array(
            "title" => "Happy 25th Birthday Kati!",
            "summary" => "Since joining Netmatters Kati has done a fantastic job keeping our IT projects progressing",
            "category" => "news",
            "posted_by" => "Netmatters Ltd",
            "posted_at" => "2020-12-18 00:00:00"
        );

        $this->assertEquals($expectedPost, createLatestNewsCard($dataArray));
    }
}
