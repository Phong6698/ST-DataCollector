<?php
Class Game{
	private $id;
	private $gameId;
	private $gameMode;
	private $gameType;
	private $subType;
	private $createDate;

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}

	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}
	}
}