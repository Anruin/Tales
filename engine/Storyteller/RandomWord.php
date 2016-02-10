<?php
/**
 * Created by PhpStorm.
 * User: Egor
 * Date: 10.02.2016
 * Time: 23:09
 */

namespace Storyteller;


class RandomWord extends Base {
	private $variants;

	/**
	 * RandomWord constructor.
	 * @param $morphy
	 * @param $json
	 */
	public function __construct($morphy, $json) {
		parent::__construct($morphy);

		$data = json_decode($json, JSON_OBJECT_AS_ARRAY);
		$this->variants = $data['variants'];
	}

	public function GetRandomVariant() {
		return $this->GetRandomItem($this->variants);
	}
}