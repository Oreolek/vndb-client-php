<?php
namespace VndbClient;

use \Http\Client\Socket\Client as SocketClient;
use \Http\Message\MessageFactory\GuzzleMessageFactory;
use \Http\Client\Common\HttpMethodsClient;
use \GuzzleHttp\Client as GuzzleClient;

class VndbClient
{
    private $client;
    
    public function __construct()
    {
      $messageFactory = new GuzzleMessageFactory();
      $options = [
        'remote_socket' => 'api.vndb.org:19534'
      ];
      $this->client = new HttpMethodsClient(new SocketClient($messageFactory, $options), $messageFactory);
    }
    
    public function login($username, $password)
    {
        $data = array(
            'protocol' => 1,
            'client' => 'vndb-client-php',
            'clientver' => 0.1,
            'username' => $username,
            'password' => $password
        );
        $response = $this->sendCommand('login', $data);
        if ($response->getType() == 'ok') {
            //echo "Login OK\n";
        } else {
            //echo "Login failed..\n";
        }
    }

    public function sendCommand($command, $data = null)
    {
        $packet = $command;
        if ($data) {
            $packet .= ' ' . json_encode($data);
        }
        $response = $this->client->get($packet);
        var_dump($response);

       /* 
        } else {
            $p = strpos($res, '{');
            if ($p>0) {
                $type = substr($res, 0, $p - 1);
                $response->setType($type);

                $json = substr($res, $p);
                $data = json_decode($json, true);
                $response->setData($data);
            }
            }
        */
        return $response;
    }
    
    public function getVisualNovelDataById($id)
    {
        $res = $this->sendCommand('get vn basic,anime,details,relations,stats (id = ' . (int)$id . ')');
        return $res;
    }

    public function getReleaseDataById($id)
    {
        $res = $this->sendCommand('get release basic,details,vn,producers (id = ' . (int)$id . ')');
        return $res;
    }
    
    public function getProducerDataById($id)
    {
        $res = $this->sendCommand('get producer basic,details,relations (id = ' . (int)$id . ')');
        return $res;
    }
    
    public function getCharacterDataById($id)
    {
        $res = $this->sendCommand('get character basic,details,meas,traits (id = ' . (int)$id . ')');
        return $res;
    }
}
