# vndb-client-php

A PHP client library for [vndb.org API](https://vndb.org/d11). 

## Library usage:

```php
use VndbClient\Client;

$client = new Client();
$client->connect();
$client->login($username, $password);
$res = $client->sendCommand('dbstats'); // send raw command
$res = $client->getVisualNovelDataById(5);
$res = $client->getReleaseDataById(21446);
$res = $client->getProducerDataById(24);
$res = $client->getCharacterDataById(537);
```
All methods return a `VndbClient\Response` object, containing `->getType()` and `->getData()` methods to read the response.

## The VNDB Protocol

For details on the workings of this API, and for a description of the returned data, please check:

        https://vndb.org/d11

## License

MIT
