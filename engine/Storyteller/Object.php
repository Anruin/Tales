<?php

namespace Storyteller;

/**
 * Class Object
 * @package Storyteller
 */
class Object extends Base {
	/** @var string Существительное */
	protected $noun;
	/** @var string Род */
	protected $gender;
	/** @var array */
	protected $actions;
	/** @var integer */
	protected $energy;

	public function __construct($morphy, $json) {
		parent::__construct($morphy);

		$data = json_decode($json, JSON_OBJECT_AS_ARRAY);
		$this->noun = $data['noun'];

		if (!empty($data['gender'])):
			$this->gender = $data['gender'];
		endif;

		if (!empty($data['actions'])):
			$this->actions = $data['actions'];
		endif;

		if (!empty($data['energy'])):
			$this->energy = $data['energy'];
		else:
			$this->energy = 0;
		endif;
	}

	public function __toString() {
		return $this->noun;
	}

	/**
	 * @param $case
	 * @return mixed
	 * @throws \Exception
	 */
	public function cast($case = 'ИМ') {
		$result = $this->morphy->castFormByGramInfo($this->noun, null, array($case, 'ЕД', $this->gender));

		if (empty($result)):
			throw new \InvalidArgumentException("Не найдено формы для {$this->noun}");
		else:
			return $result[0]['form'];
		endif;
	}

	/**
	 * @return array
	 */
	public function getActions() {
		return $this->actions;
	}
}