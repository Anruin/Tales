<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

include_once('engine/World.php');

$world = new World();
$world->Generate();

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
	'swing' => [
		'to' => 'взмахивать',
		'tense' => [
			'present' => [
				'1st' => 'взмахиваю',
				'2nd' => 'взмахиваешь',
				'3rd' => 'взмахивает',
			],
			'future' => [
				'1st' => 'взмахну',
				'2nd' => 'взмахнёшь',
				'3rd' => 'взмахнёт',
			],
			'past' => [
				'masculine' => 'взмахнул',
				'feminine' => 'взмахнула',
				'neuter' => 'взмахнуло'
			]
		]
	],
	'spot' => [
		'to' => 'заметить',
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
	]
];

$data = [
	'actions' => $actions,
	'objects' => $objects
];

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
	$action_str = $action['tense'][$tense]['3rd'];
	$object_str = $object['name'];

	return "Ход {$turn}: {$subject_str} {$action_str} {$object_str}";
}

$events = [
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
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Добро пожаловать в <?php echo $world->name; ?></title>
	<link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="css/app.css" />
</head>
<body>

	<header class="text-center">
		<h1><?php echo $world->name; ?></h1>
		<div class="stat">День <?php echo $world->day; ?></div>
	</header>

	<div class="row align-stretch text-left">
		<div class="column">
			<?php foreach ($events as $i => $event): ?>
			<div class="callout">

				<?php echo generateAction($i, $data, $event['subject'], $event['action'], $event['object'], 'present'); ?>

			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<script src="js/vendor/jquery.min.js"></script>
	<script src="js/vendor/what-input.min.js"></script>
	<script src="js/foundation.js"></script>
	<script src="js/app.js"></script>
</body>
</html>
