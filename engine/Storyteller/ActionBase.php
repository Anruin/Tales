<?php

namespace Storyteller;

/**
 * Class ActionBase
 * @package Storyteller
 */
abstract class ActionBase extends Base {
	/** @var array */
	protected $verbs;

	public function __construct($morphy, $json) {
		parent::__construct($morphy);

		$data = json_decode($json, JSON_OBJECT_AS_ARRAY);
		$this->verbs = $data['verbs'];
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return $this->verbs[rand(0, count($this->verbs) - 1)];
	}

	/**
	 * Приводит глагол к нужной форме
	 * @param $tense string
	 * @return null
	 */
	public function getRandomVerb($tense = 'НСТ') {
		$verb = $this->verbs[rand(0, count($this->verbs) - 1)];

		$result = $this->morphy->castFormByGramInfo($verb, 'Г', array($tense, 'ЕД', '3Л'));

		if (empty($result)):
			throw new \InvalidArgumentException("Не найдено формы для {$verb}");
		else:
			return $result[0]['form'];
		endif;
	}
}
