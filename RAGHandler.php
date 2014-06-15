<?php

class RAGHandler {

	/**
	 * Basic server info.
	 */
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


	/**
	 * Basic server respond.
	 */
    const RESPOND_BASIC_SERVER_INFO = 0x10;

	/**
	 * Server owner respond.
	 */
    const RESPOND_OWNER_SERVER_INFO = 0x11;

	/**
	 * Server extra respond.
	 */
    const RESPOND_MISC_SERVER_INFO = 0x12;

	/**
	 * Players stats respond.
	 */
    const RESPOND_PLAYERS_INFO = 0x20;

	/**
	 * Map respond.
	 */
    const RESPOND_MAP_INFO = 0x30;

	/**
	 * Extended players info.
	 */
    const RESPOND_EXT_PLAYERS_INFO = 0x21;

	/**
	 * Player status info.
	 */
    const RESPOND_PLAYER_STATUS_INFO = 0x22;

	public function __construct(RAGBuffer $info) {

        $info->getShort();

        while( $info->isValid() )
        {
            switch( $info->getChar() )
            {
                case self::RESPOND_BASIC_SERVER_INFO:
                    $this->name = $info->getString();
                    $this->ip = $info->getString();
                    $this->port = (int) $info->getString();
                    break;

                case self::RESPOND_OWNER_SERVER_INFO:
                    $this->owner = $info->getString();
                    $this->eMail = $info->getString();
                    break;

                case self::RESPOND_MISC_SERVER_INFO:
                    $this->motd = $info->getString();
                    $this->location = $info->getString();
                    $this->url = $info->getString();
                   // $this->uptime = $info->getLong() << 32;
                    $this->version = $info->getString();
                    break;

                case self::RESPOND_PLAYERS_INFO:
                    $this->online = $info->getLong();
                    $this->max = $info->getLong();
                    $this->peak = $info->getLong();
                    break;

                case self::RESPOND_MAP_INFO:
                    $this->map = $info->getString();
                    $this->author = $info->getString();
                    $this->width = $info->getShort();
                    $this->height = $info->getShort();
                    break;

                case self::RESPOND_EXT_PLAYERS_INFO:
                    $count = $info->getLong();

                    for($i = 0; $i < $count; $i++)
                    {
                        $name = $info->getString();
                        $this->players[$name] = $info->getLong();
                    }
                    break;
            }
        }
	}

	public function getName() { return $this->name; }

	public function getIp() { return $this->ip; }

	public function getPort() { return $this->port; }

	public function getOwner() { return $this->owner; }

	public function getEmail() { return $this->eMail; }

	public function getMotd() { return $this->motd; }

	public function getLocation() { return $this->location; }

	public function getUrl() { return $this->url; }

	public function getVersion() { return $this->version; }

	public function getOnline() { return $this->online; }

	public function getMax() { return $this->max; }

	public function getPeak() { return $this->peak; }

	public function getMap() { return $this->map; }

	public function getAutor() { return $this->autor; }

	public function getWidth() { return $this->width; }

	public function getHeight() { return $this->height; }

	public function getPlayers() { return $this->players; }
}