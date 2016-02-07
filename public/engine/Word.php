<?php

namespace {
	include_once('Enum.php');
}

namespace Words {

	class BaseString
	{
		public $string = '';

		function __construct($string)
		{
			$this->string = $string;
		}

		public function __toString()
		{
			return $this->string;
		}
	}

	//////////////////////////////////

	class Part extends BaseString
	{
		/** @var EPartType */
		public $type;
	}

	//////////////////////////////////

	class EGender extends \Enum
	{
		const MASCULINE = 0;
		const FEMININE = 1;
		const NEUTER = 2;
	}

	class EWordType extends \Enum
	{
		const NOUN = 0;
		const VERB = 1;
		const ADJECTIVE = 2;
		const PREPOSITION = 3;
		const PRONOUN = 4;
		const ADVERB = 5;
	}

	class EPartType extends \Enum
	{
		const ROOT = 0;
		const PREFIX = 1;
		const SUFFIX = 2;
		const ENDING = 3;
	}

	class ETense extends \Enum
	{
		const PRESENT = 0;
		const PAST = 1;
		const FUTURE = 2;
	}

	class EPrepositionType extends \Enum
	{
		const APPROACH = 0; // При
		const OVER = 1; // Над
		const ON = 2; // На
		const BY = 3; // По
		const IN = 4; // В
		const FROM = 5; // От
		const OUT = 6; // Из
	}

	class EActionType extends \Enum
	{
		const STAND = 0;
		const TAKE = 1;
		const WALK = 2;
	}

	$actions = [
		[
			'take' => [
				'to' => 'брать',
				'tenses' => [
					'present' => [
						'1st' => 'беру',
						'2nd' => 'берёшь',
						'3rd' => 'берёт',
					],
					'future' => [
						'1st' => 'возьму',
						'2nd' => 'возьмёшь',
						'3rd' => 'возьмёт',
					],
					'past' => [
						'masculine' => 'взял',
						'feminine' => 'взяла',
						'neuter' => 'взяло'
					]
				]
			],
			'throw' => [
				'to' => 'бросать',
				'tenses' => [
					'present' => [
						'1st' => 'бросаю',
						'2nd' => 'бросаешь',
						'3rd' => 'бросает',
					],
					'future' => [
						'1st' => 'брошу',
						'2nd' => 'бросишь',
						'3rd' => 'бросит',
					],
					'past' => [
						'masculine' => 'бросил',
						'feminine' => 'бросила',
						'neuter' => 'бросило'
					]
				]
			],
			'swing' => [
				'to' => 'брать',
				'tenses' => [
					'present' => [
						'1st' => 'беру',
						'2nd' => 'берёшь',
						'3rd' => 'берёт',
					],
					'future' => [
						'1st' => 'возьму',
						'2nd' => 'возьмёшь',
						'3rd' => 'возьмёт',
					],
					'past' => [
						'masculine' => 'взял',
						'feminine' => 'взяла',
						'neuter' => 'взяло'
					]
				]
			],
		]
	];

	$subjects = [
		[
			'name' => 'Педро',
			'gender' => EGender::MASCULINE
		]
	];

	$objects = [
		'sword' => [
			'name' => 'меч',
			'gender' => EGender::MASCULINE,
			'actions' => [
				'take', 'throw', 'swing'
			]
		]
	];

	class Word
	{
		/** @var EWordType */
		protected $type;

		protected $parts;

		/** @var EGender */
		public $gender;

		/** @var ETense */
		public $tense;

		public function __construct($parts, $type = EWordType::NOUN, $gender = null, $tense = null)
		{
			$this->parts = $parts;
			$this->type = $type;
			$this->gender = $gender;
			$this->tense = $tense;
		}

		public function __toString()
		{
			return implode($this->parts);
		}
	}

	//////////////////////////////////

	class Action
	{
		/** @var Word */
		protected $subject;
		/** @var Word */
		protected $predicate;

		/**
		 * Action constructor.
		 * @param Word $subject
		 * @param Word $predicate
		 */
		public function __construct(Word $subject, Word $predicate)
		{
			$this->subject = $subject;
			$this->predicate = $predicate;
		}

		public function __toString()
		{
			return "{$this->subject} {$this->predicate}";
		}
	}

	class ActionUponObject extends Action
	{
		protected $object;

		public function __construct(Word $subject, Word $predicate, Word $object)
		{
			$this->object = $object;
			parent::__construct($subject, $predicate);
		}

		public function __toString()
		{
			return "{$this->subject} {$this->predicate} {$this->object}";
		}
	}

	class Sentence
	{
		protected $words = [];

		/**
		 * Sentence constructor.
		 */
		public function __construct()
		{
			$count = func_num_args();
			$args = func_get_args();

			if ($count > 1) {
				$this->words = func_get_args();
			} else {
				if (gettype($args[0]) == 'array') {
					$this->words = $args[0];
				}
			}
		}

		public function __toString()
		{
			return implode(' ', $this->words);
		}
	}

	class Dictionary
	{
		protected $nouns = [];
		protected $adjectives = [];
		protected $verbs = [];
	}
}