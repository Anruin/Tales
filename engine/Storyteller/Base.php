<?php

namespace Storyteller;

/** Основной класс */
abstract class Base {
	/** @var \phpMorphy Морфологический процессор */
	protected $morphy;

	public function __construct($morphy) {
		$this->morphy = $morphy;
	}

	public function GetRandomItem($array) {
		$random_index = rand(0, count($array) - 1);
		return $array[$random_index];
	}
}