<?php

namespace Storyteller;

class ActionCase extends ActionBase {
	private $case;

	public function __construct($morphy, $json) {
		parent::__construct($morphy, $json);

		$data = json_decode($json, JSON_OBJECT_AS_ARRAY);
		$this->case = $data['case'];
	}

	/**
	 * @return mixed
	 */
	public function getCase() {
		return $this->case;
	}
}