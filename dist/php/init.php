<?php
session_start();
date_default_timezone_set('Europe/London');

// Include all classes
spl_autoload_register(function ($class) {
	require_once __DIR__ . '\\classes\\' . $class . '.php';
});

// Include all functions
foreach (glob(__DIR__ . "\\functions\\*.php") as $filename) {
	include_once $filename;
}

include __DIR__ . '\\..\\vendor\\autoload.php';