<?php

class WordBuilder {

	private $vowels = ["а", "е", "ё", "и", "о", "у", "э", "ю", "я"];
	private $consonants = ["б", "в", "г", "д", "ж", "з", "к", "й", "л", "м", "н", "п", "р", "с", "т", "ф", "х", "ц", "ч", "ш", "щ"];
	private $worldNameFirst = ["Земля", "Отрог", "Край", "Страна", "Архипелаг", "Острова", "Пространство", "Пространства", "Владение", "Владения", "Королевство", "Королевства", "Остров", "Континент", "Материк"];
	private $worldNameLast = ["Могущества", "Драконов", "Великанов", "Разочарования", "Исхода", "Отваги", "Чести", "Раскаяния", "Вольнодумства", "Ветров", "Отречения", "Порока", "Храбрости", "Мечты", "Словоблудия", "Превосходства", "Сладострастия", "Освобождения"];

	function __construct() {
	}

	function getWorldName() {
		$first = $this->worldNameFirst[rand(0, count($this->worldNameFirst) - 1)];
		$last = $this->worldNameLast[rand(0, count($this->worldNameLast) - 1)];
		return "{$first} {$last}";
	}

	function getWord($length) {
		$word = '';

		for ($i = 0; $i < $length / 2; $i++) {
			$vowel = rand(0, count($this->vowels) - 1);
			$consonant = rand(0, count($this->consonants) - 1);
			$word .= $this->vowels[$vowel] . $this->consonants[$consonant];
		}
		return mb_convert_case($word, MB_CASE_TITLE, "UTF-8");
	}
}

class World {

	public $name = '';
	public $day = 1;
	public $wordBuilder;

	public function __construct() {

	}

	public function Generate() {
		$this->wordBuilder = new WordBuilder();
		$this->name = $this->wordBuilder->getWorldName();
		$this->day = 1;
	}
}


$world = new World();
$world->Generate();

$tales_list = ['Отваге', "Слабоумии", "Могуществе", "Сундуках", "Ракушках", "Бамбуке", "Героях", "Странствиях", "Палках", "Собаках", "Сладких рулетах", "Камнях", "Страсти", "Жадности", "Самопожертвовании", "Отчаянии", "Верности", "Долге", "Коварстве"];

$tales = [];
$tales[0] = $tales_list[rand(0, count($tales_list) - 1)];
$tales[1] = $tales_list[rand(0, count($tales_list) - 1)];

$incredible_list = ['Невероятные', "Невозможные", "Былинные", "Древние"];
$stories_list = ['истории', "рассказы", "былины", "повести"];

$stories = $stories_list[rand(0, count($stories_list) - 1)];
$incredible = $incredible_list[rand(0, count($incredible_list) - 1)];