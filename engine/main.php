<?php

define('PATH_BASE', '/var/www/projects/tales/public');
define('PATH_ENGINE', '/var/www/projects/tales/engine');
define('PATH_MORPHY', '/var/www/projects/tales/phpmorphy');

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

require_once(PATH_MORPHY . '/src/common.php');

$dir = PATH_MORPHY . '/dicts';

$lang = 'ru_RU';

$opts = array(
	'storage' => PHPMORPHY_STORAGE_FILE
);

$morphy = null;

try {
	$morphy = new phpMorphy($dir, $lang, $opts);
} catch(phpMorphy_Exception $e) {
	die('Exception while creating phpMorphy instance: ' . $e->getMessage());
}

spl_autoload_register(function($class) {
	include PATH_ENGINE . "/" . str_replace("\\", "/", $class) . '.php';
});