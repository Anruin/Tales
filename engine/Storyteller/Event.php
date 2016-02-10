<?php
namespace Storyteller;

/**
 * Class Event
 * @package Storyteller
 */
class Event {
	/** @var Object */
	private $subject;
	/** @var Action */
	private $predicate;
	/** @var Object */
	private $object;
	/** @var Object */
	private $place;

	public function __construct($action, $subject = null, $object = null, $place = null) {
		$this->subject = $subject;
		$this->predicate = $action;
		$this->object = $object;
		$this->place = $place;
	}

	public function toString() {
		$result = '';

		if (!empty($this->subject)):
			$result .= $this->subject->cast();
		endif;

		if (empty($this->predicate)):
			// throw new \InvalidArgumentException("Не задано действие для события");
		else:
			$result .= ' ' . $this->predicate->cast();
		endif;

		if (!empty($this->object)):
			$result .= ' ' . $this->object->cast('ВН');
		endif;

		if (!empty($this->place)):
			$predicateProperties = $this->predicate->getProperties();
			$placeProperties = $this->place->getProperties();

			var_dump($predicateProperties);
			var_dump($placeProperties);

			$arr = array_intersect($predicateProperties, $placeProperties);
		endif;

		return $result;
	}
}