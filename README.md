Advanced OTServer status
========================

This system is based on Wrzasq POT library

Example
=======

<code>
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
</code>


Credits
========

Raggaer
Wrzasq (POT Library)