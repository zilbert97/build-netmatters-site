<?php
require_once __DIR__ . '/../src/functions.php';

class FunctionsTest extends PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
    }

    /** @test */
    public function databaseConnection()
    {
        $db = connectToDatabase();
        $this->assertInstanceOf(PDO::class, $db);
    }

    /** @test */
    public function callLatestNewsFromDatabase()
    {
        $news = getLatestNews();
        $this->assertIsArray($news);
        $this->assertCount(3, $news);
    }

    /** @test */
    public function convertNewsItemTitleToFilename()
    {
        $filename = generateFilename(
            "Some 123 card-title, \"Let's SEE?\" to_test!"
        );
        $this->assertIsString($filename);
        $this->assertEquals(
            'some-123-card-title-lets-see-to-test',
            $filename
        );
    }

    /** @test */
    public function defaultCardCoverImage()
    {
        // If no image exists for the card title, use image
        // img/netmatters-logo-background.png
        $title = 'Non Existent Card Title';
        $filename = generateFilename($title);

        $this->assertFileDoesNotExist(__DIR__ . '/../img/' . $filename);

        $image = getCardImage($filename, 'img/netmatters-logo-background.png');
        $filepath = __DIR__ . '/../' . $image;

        $this->assertEquals(
            'img/netmatters-logo-background.png',
            $image
        );
    }

    /** @test */
    public function defaultCardPostedByImage()
    {
        // If no image exists for the card posted by, use image
        // img/netmatters-logo-small.png
        $title = 'Non Existent Card Posted By';
        $filename = generateFilename($title);

        $this->assertFileDoesNotExist(__DIR__ . '/../img/' . $filename);

        $image = getCardImage($filename, 'img/netmatters-logo-small.png');
        $filepath = __DIR__ . '/../' . $image;

        $this->assertEquals(
            'img/netmatters-logo-small.png',
            $image
        );
    }

    /** @test */
    public function notDefaultCardCoverImage()
    {
        // If image exists for the card title, use that image
        $title = 'Netmatters Logo Background';
        $filename = generateFilename($title);

        $this->assertFileExists(__DIR__ . '/../img/' . $filename . '.png');

        $image = getCardImage($filename, 'img/netmatters-logo-background.png');
        $filepath = __DIR__ . '/../' . $image;

        $this->assertEquals(
            'img/netmatters-logo-background.png',
            $image
        );
    }

    /** @test */
    public function notDefaultCardPostedByImage()
    {
        // If image exists for the card posted by, use that image
        $title = 'Netmatters Logo Small';
        $filename = generateFilename($title);

        $this->assertFileExists(__DIR__ . '/../img/' . $filename . '.png');

        $image = getCardImage($filename, 'img/netmatters-logo-small.png');
        $filepath = __DIR__ . '/../' . $image;

        $this->assertEquals(
            'img/netmatters-logo-small.png',
            $image
        );
    }

    /** @test */
    public function generateLatestNewsCardUseDefaults()
    {
        $news_item = [
            'category'=>'news',
            'title'=>'Test title (does not exist)',
            'summary'=>'This is a test summary to be displayed',
            'posted_by'=>'Test posted by (does not exist)',
            'posted_at'=>'2020-12-10 00:00:00'
        ];

        $card = createLatestNewsCard($news_item);

        $expectedCardBody = <<<EOD
        <div class="news-card news-card-it-support">
            <div class="news-card-cover">
                <a href="#">
                    <div class="image-wrapper">
                        <img class="news-card-image"
                             src="img/netmatters-logo-background.png"
                             alt="Test title (does not exist)">
                    </div>
                </a>
                <a class="news-card-category" href="#">news</a>
            </div>
            <div class="news-card-summary">
                <a class="title-link" href="#">
                    <h6>Test title (does not exist)</h6>
                </a>
                <p class="card-description">This is a test summary to be displayed&hellip;</p>
                <a class="read-more" href="#">Read more</a>
                <hr />
                <img class="logo-small"
                     src="img/netmatters-logo-small.png"
                     alt="News article posted by Test posted by (does not exist)">
                <div class="card-publish-info">
                    <p><strong>Posted by Test posted by (does not exist)</strong></p>
                    <p>10th December 2020</p>
                </div>
            </div>
        </div>
        EOD;

        $this->assertIsString($card);
        $this->assertEquals($expectedCardBody, $card);
    }

    /** @test */
    public function generateLatestNewsCardUseReal()
    {
        $news_item = [
            'category'=>'case studies',
            'title'=>'Happy 25th Birthday, Kati!',
            'summary'=>'This is another test summary to be displayed',
            'posted_by'=>'Simon Wright',
            'posted_at'=>'2021-04-14 01:23:45'
        ];

        $card = createLatestNewsCard($news_item);

        $expectedCardBody = <<<EOD
        <div class="news-card news-card-bespoke-software">
            <div class="news-card-cover">
                <a href="#">
                    <div class="image-wrapper">
                        <img class="news-card-image"
                             src="img/happy-25th-birthday-kati.jpeg"
                             alt="Happy 25th Birthday, Kati!">
                    </div>
                </a>
                <a class="news-card-category" href="#">case studies</a>
            </div>
            <div class="news-card-summary">
                <a class="title-link" href="#">
                    <h6>Happy 25th Birthday, Kati!</h6>
                </a>
                <p class="card-description">This is another test summary to be displayed&hellip;</p>
                <a class="read-more" href="#">Read more</a>
                <hr />
                <img class="logo-small"
                     src="img/simon-wright.jpeg"
                     alt="News article posted by Simon Wright">
                <div class="card-publish-info">
                    <p><strong>Posted by Simon Wright</strong></p>
                    <p>14th April 2021</p>
                </div>
            </div>
        </div>
        EOD;

        $this->assertIsString($card);
        $this->assertEquals($expectedCardBody, $card);
    }
}
