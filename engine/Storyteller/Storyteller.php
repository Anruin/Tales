<?php

namespace Storyteller;

/**
 * Class Storyteller
 * @package Storyteller
 */
class Storyteller {
	/** @var phpMorphy */
	public $morphy;
	/** @var array */
	private $location;
	/** @var array */
	private $actions;
	/** @var Subject */
	private $subject;
	/** @var array[Object] */
	private $objects;
	/** @var array[RandomWord] */
	private $places;
	/** @var array */
	private $specials;

	private $minObjects;
	private $maxObjects;

	private function mb_ucfirst($string) {
		$first = mb_substr($string, 0, 1, 'UTF-8');
		$rest = mb_substr($string, 1, null, 'UTF-8');
		$first = mb_convert_case($first, MB_CASE_UPPER, 'UTF-8');
		return $first . $rest;
	}

	public function BuildSentence($string) {
		$string = mb_convert_case($string, MB_CASE_LOWER, 'UTF-8');
		$string = $this->mb_ucfirst($string);
		$string .= '. ';
		return $string;
	}

	public function __construct($morphy) {
		$this->morphy = $morphy;

		$data = json_decode(file_get_contents("data.json"), true);

		$this->subject = new Subject($morphy, '{"noun" : "ГЕРОЙ", "gender" : "МР", "energy": 10}', $this);

		$this->objects = [
			new Object($morphy, '{"noun" : "ВОДА", "gender" : "ЖР", "actions" : [ "Spot", "Take", "Throw", "Drink" ], "energy": 10}'),
			new Object($morphy, '{"noun" : "ШАР", "gender" : "МР", "actions" : [ "Spot", "Take", "Throw" ], "energy": 0}'),
			new Object($morphy, '{"noun" : "КУБ", "gender" : "МР", "actions" : [ "Spot", "Take", "Throw" ], "energy": 0}'),
			new Object($morphy, '{"noun" : "СУНДУК", "gender" : "МР", "actions" : [ "Spot", "Open", "Search", "Close", "Throw" ], "energy": 0}'),
			new Object($morphy, '{"noun" : "КОНУС", "gender" : "МР", "actions" : [ "Take", "Throw" ], "energy": 0}'),
			new Object($morphy, '{"noun" : "ПАЛКА", "gender" : "ЖР", "actions" : [ "Take", "Swing", "Throw" ], "energy": 0}'),
			new Object($morphy, '{"noun" : "КОЛБАСА", "gender" : "ЖР", "actions" : [ "Take", "Eat" ], "energy": 10} '),
			new Object($morphy, '{"noun" : "РУЛЕТ", "gender" : "МР", "actions" : [ "Eat", "Take" ], "energy": 10} ')
		];

		$this->actions = [
			'Die' => new Action($morphy, '{"verbs": [ "УМИРАЕТ", "ПОГИБАЕТ", "ПОМИРАЕТ" ]}'),
			'Feel' => new Action($morphy, '{"verbs": [ "ЧУВСТВУЕТ" ]}'),
			'Move' => new Action($morphy, '{"verbs": [ "ИДЁТ", "ДВИГАЕТСЯ", "ПРОХОДИТ", "ПЕРЕМЕЩАЕТСЯ" ]}'),
			'Sleep' => new Action($morphy, '{"verbs": [ "СПИТ" ]}'),
			'Think' => new Action($morphy, '{"verbs": [ "ДУМАЕТ", "СЧИТАЕТ", "ПРЕДПОЛАГАЕТ", "РЕШАЕТ", "ПОЛАГАЕТ", "РАССЧИТЫВАЕТ" ]}'),
			'Handy' => new Action($morphy, '{"verbs": [ "ПРИГОДИТСЯ" ]}'),
			'Spot' => new ActionCase($morphy, '{"verbs" : [ "ВИДИТ", "ЗАМЕЧАЕТ", "ОБНАРУЖИВАЕТ", "НАХОДИТ" ], "case": "ВН" }'),
			'Open' => new ActionCase($morphy, '{"verbs": [ "ОТКРЫВАЕТ" ], "case": "ВН" }'),
			'Search' => new ActionCase($morphy, '{"verbs": [ "ОБЫСКИВАЕТ", "ОСМАТРИВАЕТ" ], "case": "ВН" }'),
			'Close' => new ActionCase($morphy, '{"verbs": [ "ЗАКРЫВАЕТ" ], "case": "ВН" }'),
			'Take' => new ActionCase($morphy, '{"verbs": [ "ХВАТАЕТ", "БЕРЁТ" ], "case": "ВН" }'),
			'Throw' => new ActionCase($morphy, '{"verbs": [ "БРОСАЕТ", "КИДАЕТ", "ШВЫРЯЕТ" ], "case": "ВН" }'),
			'Swing' => new ActionCase($morphy, '{"verbs": [ "МАШЕТ", "МАХАТЬ", "ВЗМАХИВАТЬ", "КРУТИТЬ", "ВИНТИТЬ" ], "case": "ТВ" }'),
			'Smoke' => new ActionCase($morphy, '{"verbs": [ "КУРИТЬ" ], "case": "ВН" }'),
			'Blame' => new ActionCase($morphy, '{"verbs": [ "ВИНИТЬ" ], "case": "ВН" }'),
			'Eat' => new ActionCase($morphy, '{"verbs": [ "ЕСТ", "ЖЕВАТЬ" ], "case": "ВН" }'),
			'Drink' => new ActionCase($morphy, '{"verbs": [ "ПИТЬ", "ГЛОТАТЬ" ], "case": "ВН" }'),
		];
		$this->places = [
			'Next' => new RandomWord($morphy, '{"variants": ["ВПЕРЁД", "ДАЛЬШЕ", "НА СЛЕДУЮЩУЮ ЛОКАЦИЮ", "В ДРУГОЕ МЕСТО"]}'),
		];

		$this->specials = [
			'Self' => 'себя'
		];

		$this->minObjects = 1;
		$this->maxObjects = 10;
	}

	function GetPlace($type) {
		return $this->places[$type]->GetRandomVariant();
	}

	function GetAction($type) {
		return $this->actions[$type];
	}

	function GetSpecial($type) {
		return $this->specials[$type];
	}

	function GenerateLocation() {
		$this->location = [];

		$count = rand($this->minObjects, $this->maxObjects);

		for ($i = $count; $i > 0; $i--):
			$key = rand(0, count($this->objects) - 1);
			array_push($this->location, $this->objects[$key]);
		endfor;

		return $this->location;
	}

	public function GetRandomItem($array) {
		$random_index = rand(0, count($array) - 1);
		return $array[$random_index];
	}

	/**
	 * @param $turn
	 * @return string
	 */
	function NextTurn($turn) {
		$time = date('Y-m-d h:i:s: ');
		$result = "Ход {$turn}: " . $this->subject->NextTurn();
		file_put_contents('game_log.txt', $time . $result.PHP_EOL, FILE_APPEND);
		return $result;
	}

	function GenerateActions() {
		$this->actions = ['ВЗЯТЬ', 'УВИДЕТЬ', 'ПОЛОЖИЛ', 'БРОСИТЬ', 'ПНУТЬ'];
	}
}