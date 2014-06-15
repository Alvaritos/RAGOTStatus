<?php

class RAGBuffer {
    
	private $buffer;

	private $position; 

    public function __construct($buffer = '') {

    	$this->buffer = $buffer;
    	$this->position = 0;
    }

    public function getBuffer() {

    	return $this->buffer;
    }

    public function getPos() {

    	return $this->position;
    }

    public function isValid() {

    	if ($this->position < strlen($this->buffer)) return true;

    	return false;
    }

    public function isLonger($length = 1) {

    	if (strlen($this->buffer) < $this->position + $length) return false;

    	return true;
    }

    public function getChar() {

    	if ($this->isLonger()) {

    		$value = ord($this->buffer[$this->position]);
    		$this->position++;

    		return $value;
    	}
    }

    public function addChar($char) {

    	$this->buffer.= chr($char);
    }

    public function getShort() {

    	if ($this->isLonger(2)) {

    		$value = unpack('v', substr($this->buffer, $this->position, 2));
    		$this->position += 2;

    		return $value[1];
    	}
    }

    public function addShort($short) {

    	$this->buffer .= pack('v', $short);
    }

    public function getLong() {

    	if ($this->isLonger(4)) {

    		$value = unpack('V', substr($this->buffer, $this->position, 4));
    		$this->position += 4;

    		return $value[1];
    	}
    }

    public function addLong($long) {

    	$this->buffer.= pack('V', $long);
    }

    public function getString($length = false) {

    	if (!$length) $length = $this->getShort();

    	if ($this->isLonger($length)) {

    		$value = substr($this->buffer, $this->position, $length);
    		$this->position += $length;

    		return $value;
    	}
    }

    public function addString($string) {

    	$this->buffer.= $string;
    }
}