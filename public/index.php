<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

include_once('engine/Word.php');
include_once('engine/World.php');

$world = new World();
$world->Generate();

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
    <div class="callout">
      <pre><?php

      $str = "string";
      $obj = (object)$str;

      $subject = new Words\Word(array('root' => 'Герой'));
      $predicate = new Words\Word(array('root' => 'Бездействует'), \Words\EWordType::VERB, null, \Words\ETense::PRESENT);
      $action = new Words\Action($subject, $predicate);
      $sentence = new Words\Sentence([$action]);
      echo $sentence;
      echo '</br>';
      $predicate = new Words\Word(array('root' => 'активирует'), \Words\EWordType::VERB, null, \Words\ETense::PRESENT);
      $object = new Words\Word(array('root' => 'рычаг'));
      $action = new Words\ActionUponObject($subject, $predicate, $object);
      $sentence = new Words\Sentence([$action]);
      echo $sentence;
      ?>
      </pre>
    </div>
  </div>
</div>

<script src="js/vendor/jquery.min.js"></script>
<script src="js/vendor/what-input.min.js"></script>
<script src="js/foundation.js"></script>
<script src="js/app.js"></script>
</body>
</html>
