<?php

class RAGServer {

	private $server;

	private $port;

	public function __construct($server, $port = 7171) {

		$this->server = $server;
		$this->port = $port;
	}

	public function sendPacket(RAGBuffer $packet) {

		$socket = fsockopen($this->server, $this->port, $error, $message, 5);

		if ($socket) {

			stream_set_timeout($socket, 5);

			$packet = $packet->getBuffer();
			$packet = pack('v', strlen($packet)).$packet;

			fwrite($socket, $packet);

			$data = stream_get_contents($socket);

			fclose($socket);

			return new RAGHandler(new RAGBuffer($data));
		}
	}
}