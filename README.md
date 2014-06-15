Advanced OTServer status
========================

This system is based on Wrzasq POT library

System uses a custom BufferedReader / Writter. It sends a packet to the desired OTServer
To get any information you may need to also send flags to the server, heres the list

```php
const REQUEST_BASIC_SERVER_INFO = 1;

/**
* Server owner info.
*/
const REQUEST_OWNER_SERVER_INFO = 2;

/**
* Server extra info.
*/
const REQUEST_MISC_SERVER_INFO = 4;

/**
* Players stats info.
*/
const REQUEST_PLAYERS_INFO = 8;

/**
* Map info.
*/
const REQUEST_MAP_INFO = 16;

/**
* Extended players info.
*/
const REQUEST_EXT_PLAYERS_INFO = 32;

/**
* Player status info.
*/
const REQUEST_PLAYER_STATUS_INFO = 64;
```


Example
=======

```php
include_once('RAGBuffer.php');
include_once('RAGServer.php');
include_once('RAGHandler.php');

mb_internal_encoding("UTF-8");

$test = new RAGBuffer();

$test->addChar('255');
$test->addChar('1');
$test->addShort(4 | 1 | 2 | 8 | 16 | 32);

$server = new RAGServer('shadowcores.twifysoft.net');
$status = $server->sendPacket($test);

echo '<h1>Basic server info from - '.$status->getName().' | IP : '.$status->getIp().' PORT : '.$status->getPort().'</h1>';
echo '<li>Owner - '.$status->getOwner().'</li><li>'.$status->getMotd().'</li><li>Players - '.$status->getOnline().'('.$status->getPeak().')'.$status->getMax().')</li>
<h1>Player list</h1>';

foreach ($status->players as $name => $level) {

	echo '<li>'.$name.' ('.$level.')</li>';
}
```


Credits
========

Raggaer

Wrzasq (POT Library)