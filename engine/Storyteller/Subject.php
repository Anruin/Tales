<?php

namespace Storyteller;

class Subject extends Object {
	/** @var Storyteller */
	private $storyteller;
	private $location;
	private $memory;

	public function __construct($morphy, $json, $storyteller) {
		parent::__construct($morphy, $json);

		$this->memory = array();
		$this->storyteller = $storyteller;
	}

	// Изучаем локацию
	public function Analyse() {
		$result = '';
		/**
		 * @var string $key
		 * @var Object $object
		 */
		foreach ($this->location as $key => $object):
			/** @var ActionCase $actionSpot */
			$actionSpot = $this->storyteller->GetAction('Spot');
			/** @var Action $actionThink */
			$actionThink = $this->storyteller->GetAction('Think') ;
			/** @var Action $actionUseful */
			$actionUseful = $this->storyteller->GetAction('Handy');

			/** @var string $verb */
			$verbSpot = $actionSpot->getRandomVerb();
			/** @var string $verbThink */
			$verbThink = $actionThink->getRandomVerb();
			/** @var string $verbUseful */
			$verbUseful = $actionUseful->getRandomVerb('БУД');

			// Говорим, что мы заметили предмет
			$result .= $this->storyteller->BuildSentence("{$this->noun} {$verbSpot} {$object->cast($actionSpot->getCase())}");

			// Проверяем на наличие силушки в предмете
			if (!empty($object->energy)):
				// Герой думает, что предмет ему пригодится
				$result .= $this->storyteller->BuildSentence("{$this->noun} {$verbThink}, что {$object->noun} {$verbUseful}");
				// Герой добавляет предмет себе в память, чтобы использовать позднее
				$this->memory[$key] = $object;
			endif;
		endforeach;

		return $result;
	}

	public function Status() {
		/** @var Action $actionFeel */
		$actionFeel = $this->storyteller->GetAction('Feel');
		/** @var Action $actionDie */
		$actionDie = $this->storyteller->GetAction('Die');
		/** @var string $verbFeel */
		$verbFeel = $actionFeel->getRandomVerb();
		/** @var string $verbDie */
		$verbDie = $actionDie->getRandomVerb();
		/** @var string $self */
		$self = $this->storyteller->GetSpecial('Self', 'ВН');

		switch ($this->energy):
			case 0:
				return $this->storyteller->BuildSentence("{$this->noun} {$verbDie}");
			case 1:
				return $this->storyteller->BuildSentence("{$this->noun} видит свет");
			case 2:
				return $this->storyteller->BuildSentence("{$this->noun} {$verbFeel}, что смерть приближается");
			case 3:
				return $this->storyteller->BuildSentence("{$this->noun} {$verbFeel} {$self} очень плохо");
			case 4:
				return $this->storyteller->BuildSentence("{$this->noun} {$verbFeel} {$self} плохо");
			case 5:
				return $this->storyteller->BuildSentence("{$this->noun} {$verbFeel} голод");
			case 6:
				return $this->storyteller->BuildSentence("{$this->noun} в порядке");
			case 7:
				return $this->storyteller->BuildSentence("{$this->noun} вполне доволен");
			case 8:
				return $this->storyteller->BuildSentence("{$this->noun} {$verbFeel} {$self} хорошо");
			case 9:
				return $this->storyteller->BuildSentence("{$this->noun} {$verbFeel} {$self} очень хорошо");
			case 10:
				return $this->storyteller->BuildSentence("{$this->noun} {$verbFeel} {$self} превосходно");
		endswitch;
		return null;
	}

	// Принятие решения - съесть объект или перейти в другую локацию
	public function Decide() {
		if (!empty($this->memory)):
			$object = $this->GetRandomItem($this->memory);
			if (!empty($object->energy) && $object->energy > 0):
				return $this->Consume(array_search($object, $this->memory));
			endif;
		endif;

		// TODO: TEMPORARY
		$object = $this->GetRandomItem($this->location);
		if (!empty($object->energy) && $object->energy > 0):
			echo $this->Consume(array_search($object, $this->memory));
		endif;

		return $this->NextLocation();
	}

	// Переход к следующей локации
	public function NextLocation() {
		$this->location = $this->storyteller->GenerateLocation();
		return $this->storyteller->BuildSentence("{$this->noun} {$this->storyteller->GetAction('Move')} {$this->storyteller->GetPlace('Next')}") . $this->Analyse();
	}

	/**
	 * @param $key
	 * @return string
	 */
	public function Consume($key) {
		/** @var Object $object */
		$object = $this->location[$key];
		$this->energy += $object->energy;
		unset($this->location[$key]);
		/** @var ActionCase $actionEat */
		$actionEat = $this->storyteller->GetAction('Eat');
		/** @var string $verbEat */
		$verbEat = $actionEat->GetRandomVerb();
		return $this->storyteller->BuildSentence("{$this->noun} {$verbEat} {$object->cast($actionEat->getCase())}") . $this->Analyse();;
	}

	/**
	 * @return string
	 */
	public function NextTurn() {
		$status = $this->Status();
		// Используем единицу энергии для поддержания жизнедеятельности
		$this->energy--;
		// Принимаем решение
		return $status . $this->Decide();
	}
}