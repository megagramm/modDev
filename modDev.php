#!/usr/bin/env php
<?php

declare(strict_types=1);

/**
 * Модифицирует настройки на устройствах, если они были сброшены
 *
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

$o = getopt('d:c:h', ['device:', 'command:', 'help']);
$commandsDir = __DIR__ . '/commands/';

if(empty($o['c'])) {
	$o['c'] = '';
}
if(empty($o['d'])) {
	$o['d'] = '';
}
if (isset($o['command'])) {
	$o['c'] = $o['command'];
}
if (isset($o['device'])) {
	$o['d'] = $o['device'];
}

$devices = $o['d'];
$command = $o['c'];
$commandPath = $commandsDir . $o['c'] . '.inc.php';
$commandsPrint = "";

foreach (glob($commandsDir . '*.inc.php') as $value) {
	include_once $value;
	$key = basename($value, '.inc.php');
	$commands[$key] = [
		'title'   => $title,
		'command' => $shCommand,
	];
	$commandsPrint .= " - $key    $title\r\n";
}
$help_screen = <<<EOF
Скрипт изменяет некоторые состояния устройств. Например включает или отключает поддержку snmp:

$argv[0] -d 000.000.000.000 -c test
$argv[0] -d hostname.local -c test

Доступные опции:
 -d | --device   hostname или ip устройства.
 -c | --command  команда на исполение.
 -h | --help     вывести это окно

Доступные команды:

$commandsPrint

EOF . PHP_EOL;

// Вывести help screen
if (
	$argc == 1
	|| (
		(empty($o['d'])) || (empty($o['c']))
	)
) {
	echo $help_screen;
	exit;
}

if (file_exists($commandPath)) {
	if (empty($commands[$o['c']])) {
		echo "Command does not exists" . PHP_EOL;
		exit;
	}

	if(is_string($devices) && file_exists($devices)) {
		$lines = file($devices, FILE_IGNORE_NEW_LINES);
		foreach ($lines as $device) {
			$cmd = "ssh root@{$device} {$commands[$o['c']]['command']}";
			echo $cmd . PHP_EOL;
			echo shell_exec($cmd);
		}
	} elseif (is_array($devices)) {
		foreach ($devices as $device) {
			$cmd = "ssh root@{$device} {$commands[$o['c']]['command']}";
			echo $cmd . PHP_EOL;
			echo shell_exec($cmd);
		}
	} else {
		$cmd = "ssh root@{$devices} {$commands[$o['c']]['command']}";
		echo $cmd . PHP_EOL;
		echo shell_exec($cmd);
	}
} else {
	echo "Command does not exists" . PHP_EOL;
}
