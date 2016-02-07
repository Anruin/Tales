<?php
include_once ('engine/main.php');
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
		<svg id="logo">
			<polygon points="0,0 100,0 50,75" style="fill:#a00;stroke:#300;stroke-width:1"></polygon>
		</svg>
		<h1><?php echo $incredible; ?> <?php echo $stories; ?></h1>
		<h3>мира <?php echo $world->name; ?></h3>
		<div class="stat">Истории о <?php echo $tales[0]; ?> и <?php echo $tales[1]; ?></div>
	</header>

	<div class="row align-stretch text-left">
		<div class="column">
			<?php /*
			$genders = ['masculine', 'feminine', 'neuter'];
			$tenses = ['past', 'present', 'future'];
			?>
			<?php foreach ($genders as $g => $gender): ?>
				<?php foreach ($tenses as $t => $tense): ?>
					<div class="callout">
						<?php echo buildVerb($actions['be'], $gender, $tense); ?>
					</div>
				<?php endforeach; ?>
			<?php endforeach; */?>

		</div>
	</div>

	<script src="js/vendor/jquery.min.js"></script>
	<script src="js/vendor/what-input.min.js"></script>
	<script src="js/foundation.js"></script>
	<script src="js/app.js"></script>
</body>
</html>
