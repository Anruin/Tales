<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

include_once('World.php');

$world = new World();
$world->Generate();

$tales_list = ['Отваге', "Слабоумии", "Могуществе", "Драконах", "Страсти", "Жадности", "Самопожертвовании", "Отчаянии", "Верности", "Долге", "Коварстве"];

$tales = [];
$tales[0] = $tales_list[rand(0, count($tales_list) - 1)];
$tales[1] = $tales_list[rand(0, count($tales_list) - 1)];

$incredible_list = ['Невероятные', "Невозможные", "Былинные", "Древние"];
$stories_list = ['истории', "рассказы", "былины", "повести"];

$stories = $stories_list[rand(0, count($stories_list) - 1)];
$incredible = $incredible_list[rand(0, count($incredible_list) - 1)];

$actions = [
	'take' => [
		'to' => 'брать',
		'tense' => [
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
		'tense' => [
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
	'be' => [
		'root' => 'бы',
		'infinitive' => [
			'ending' => 'ть'
		],
		'present' => [
			'root' => 'ес',
			'ending' => 'ть'
		],
		'future' => [
			'root' => 'буд',
			'ending' => [
				'1st' => 'у',
				'2nd' => 'ешь',
				'3rd' => 'ет'
			]
		],
		'past' => [
			'ending' => [
				'masculine' => 'л',
				'feminine' => 'ла',
				'neuter' => 'ло'
			]
		]
	],
	'swing' => [
		'root' => 'мах',
		'base' => 'взмах',
		'infinitive' => [
			'suffix' => 'ива',
			'ending' => 'ть'
		],
		'present' => [
			'suffix' => 'ива',
			'ending' => [
				'1st' => 'ю',
				'2nd' => 'ешь',
				'3rd' => 'ет'
			]
		],
		'future' => [
			'suffix' => 'н',
			'ending' => [
				'1st' => 'у',
				'2nd' => 'ёшь',
				'3rd' => 'ёт'
			]
		],
		'past' => [
			'suffix' => 'н',
			'ending' => [
				'masculine' => 'ул',
				'feminine' => 'ула',
				'neuter' => 'уло'
			]
		]
	],
	'spot' => [
		'to' => 'замечать',
		'tense' => [
			'present' => [
				'1st' => 'замечаю',
				'2nd' => 'замечаешь',
				'3rd' => 'замечает',
			],
			'future' => [
				'1st' => 'замечу',
				'2nd' => 'заметишь',
				'3rd' => 'заметит',
			],
			'past' => [
				'masculine' => 'заметил',
				'feminine' => 'заметила',
				'neuter' => 'заметило'
			]
		]
	],
	'attack' => [
		'to' => 'нападать',
		'tense' => [
			'present' => [
				'1st' => 'нападаю',
				'2nd' => 'нападаешь',
				'3rd' => 'нападает',
			],
			'future' => [
				'1st' => 'нападу',
				'2nd' => 'нападёшь',
				'3rd' => 'нападёт',
			],
			'past' => [
				'masculine' => 'напал',
				'feminine' => 'напала',
				'neuter' => 'напало'
			]
		]
	],
	'open' => [
		'to' => 'открывать',
		'tense' => [
			'present' => [
				'1st' => 'открываю',
				'2nd' => 'открываешь',
				'3rd' => 'открывает',
			],
			'future' => [
				'1st' => 'открою',
				'2nd' => 'откроешь',
				'3rd' => 'откроет',
			],
			'past' => [
				'masculine' => 'открыл',
				'feminine' => 'открыла',
				'neuter' => 'открыло'
			]
		]
	],
	'confuse' => [
		'to' => 'не шарить',
		'tense' => [
			'present' => [
				'1st' => 'не шарю',
				'2nd' => 'не шаришь',
				'3rd' => 'не шарит',
			],
			'future' => [
				'1st' => 'не шарю',
				'2nd' => 'не шаришь',
				'3rd' => 'не шарит',
			],
			'past' => [
				'masculine' => 'не шарил',
				'feminine' => 'не шарила',
				'neuter' => 'не шарило'
			]
		]
	],
	'pray' => [
		'to' => 'молиться',
		'tense' => [
			'present' => [
				'1st' => 'молюсь',
				'2nd' => 'молишься',
				'3rd' => 'молится',
			],
			'future' => null,
			'past' => [
				'masculine' => 'молил',
				'feminine' => 'молила',
				'neuter' => 'молило'
			]
		]
	],
	'glad' => [
		'to' => 'благодарить',
		'tense' => [
			'present' => [
				'1st' => 'благодарю',
				'2nd' => 'благодаришь',
				'3rd' => 'благодарит',
			],
			'future' => null,
			'past' => [
				'masculine' => 'молил',
				'feminine' => 'молила',
				'neuter' => 'молило'
			]
		]
	],
];

$objects = [
	'hero' => [
		'name' => 'Педро',
		'gender' => 'masculine'
	],
	'sword' => [
		'name' => 'меч',
		'gender' => 'masculine',
		'actions' => [
			'spot', 'take', 'throw', 'swing'
		]
	],
	'monster' => [
		'name' => 'Зверюго',
		'gender' => 'neuter',
		'actions' => [
			'kill'
		]
	],
	'creator' => [
		'name' => 'Создатель',
		'gender' => 'masculine',
		'actions' => [
			'pray'
		]
	]
];

$data = [
	'actions' => $actions,
	'objects' => $objects
];

function buildVerb($verb, $gender, $tense, $person = '3rd') {
	$link = '';
	$prefix = '';
	$root = '';
	$suffix = '';
	$ending = '';

	// var_dump($verb);

	// Prefixes
	if (!empty($verb['prefix'])):
		$prefix = $verb['prefix'];
	endif;

	// Root word
	if (!empty($verb['root'])):
		$root = $verb['root'];
	endif;

	// Process suffixes and endings based on tense and person
	switch ($tense):
		case 'past': {
			if (empty($verb['past'])):
				throw new InvalidArgumentException('Verb past form is not defined!');
			else:
				$past = $verb['past'];

				if (!empty($past['prefix'])):
					$prefix = $past['prefix'];
				endif;

				if (!empty($past['root'])):
					$root = $past['root'];
				endif;

				if (!empty($past['suffix'])):
					$suffix = $past['suffix'];
				endif;

				if (!empty($past['ending'])):
					if (empty($past['ending'][$gender])):
						throw new InvalidArgumentException("Verb past form for {$gender} is not defined!");
					else:
						$ending = $past['ending'][$gender];
					endif;
				endif;
			endif;
			break;
		}
		case 'present': {
			if (empty($verb['present'])):
				throw new InvalidArgumentException('Verb present forms are not defined!');
			else:
				$present = $verb['present'];

				if (!empty($past['prefix'])):
					$prefix = $past['prefix'];
				endif;

				if (!empty($present['root'])):
					$root = $present['root'];
				endif;

				if (!empty($present['suffix'])):
					$suffix = $present['suffix'];
				endif;

				if (!empty($present['ending'])):
					if (is_array($present['ending'])):
						if (empty($present['ending'][$person])):
							throw new InvalidArgumentException("Verb present form for {$person} person is not defined!");
						else:
							$ending = $present['ending'][$person];
						endif;
					else:
						$ending = $present['ending'];
					endif;
				endif;
			endif;
			break;
		}
		case 'future': {
			break;
		}
		default: {
			if (empty($verb['infinitive'])):
				throw new InvalidArgumentException('Verb infinitive form is not defined!');
			else:
				if (!empty($verb['infinitive']['suffix'])):
					$suffix = $verb['infinitive']['suffix'];
				endif;

				if (!empty($verb['infinitive']['ending'])):
					$ending = $verb['infinitive']['ending'];
				endif;
			endif;
			break;
		}
	endswitch;
/*
	if ($tense === 'future'):
		if (empty($verb['future'])):
			$link = '';
		endif;
	endif;

	if ($tense === 'past'):
		$verb_str = $verb['tense'][$tense][$gender];
	else:
		if ($verb['tense'][$tense] == null && $tense === 'future'):
			$verb_str = "будет " . $verb['to'];
		endif;
		$verb_str = $verb['tense'][$tense]['3rd'];
	endif;
*/
	if (empty($root)):
		throw new InvalidArgumentException('Verb root is not defined!');
	endif;

	return $prefix . $root . $suffix . $ending;
}

function generateAction($turn, $data, $subject, $action, $object, $tense = 'present') {
	foreach ($data['objects'] as $s_key => $s):
		if ($s_key === $subject):
			$subject = $data['objects'][$s_key];
			break;
		endif;
	endforeach;

	foreach ($data['actions'] as $a_key => $a):
		if ($a_key === $action):
			$action = $data['actions'][$a_key];
			break;
		endif;
	endforeach;

	foreach ($data['objects'] as $o_key => $o):
		if ($o_key === $object):
			$object = $data['objects'][$o_key];
			break;
		endif;
	endforeach;

	$subject_str = $subject['name'];

	$action_str = buildVerb($action, $tense, $subject['gender']);

	$object_str = $object['name'];

	return "Ход {$turn}: {$subject_str} {$action_str} {$object_str}";
}

$events = [
	[
		'subject' => 'hero',
		'action' => 'confuse',
		'object' => null
	],
	[
		'subject' => 'hero',
		'action' => 'pray',
		'object' => 'creator'
	],
	[
		'subject' => 'hero',
		'action' => 'spot',
		'object' => 'sword'
	],
	[
		'subject' => 'hero',
		'action' => 'take',
		'object' => 'sword'
	],
	[
		'subject' => 'hero',
		'action' => 'swing',
		'object' => 'sword'
	],
	[
		'subject' => 'monster',
		'action' => 'spot',
		'object' => 'hero'
	],
	[
		'subject' => 'monster',
		'action' => 'attack',
		'object' => 'hero'
	],
	[
		'subject' => 'hero',
		'action' => 'spot',
		'object' => 'monster'
	],
	[
		'subject' => 'hero',
		'action' => 'attack',
		'object' => 'monster'
	],
];


