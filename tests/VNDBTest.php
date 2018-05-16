<?php
require_once "vendor/autoload.php";
require_once "src/VndbClient.php";

use PHPUnit\Framework\TestCase;
use VndbClient\VndbClient;

class VNDBTest extends TestCase
{
  protected $client;
  public function testConnect()
  {
    $this->client = new VndbClient();
    $this->client->login(VNDB_USERNAME, VNDB_PASSWORD);

    $this->assertEquals(TRUE, $this->client->isConnected());

  }

  /**
   * @depends testConnect
   */
  public function testDetails()
  {
    $data = $this->client->getVisualNovelDataById('3126'); // Everlasting Summer
    $this->assertEquals($data['title'], 'Beskonechnoe leto');
  }
}
