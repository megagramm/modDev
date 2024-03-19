<?php

declare(strict_types=1);

/**
 * Модифицирует настройки на устройствах
 *
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

include_once "ModificateHost.inc.php";

spl_autoload_register(function ($Class) {
	if (preg_match('/^\w/i', $Class)) {
		$file = $Class . '.inc.php';
		if (file_exists($file)) {
			include_once $file;
			return;
		}
	}

	if (preg_match('/^\w/i', $Class)) {
		$file = ModificateHost::$commandsDir . $Class . '.inc.php';
		if (file_exists($file)) {
			include_once $file;
			return;
		}
	}

});

$o = getopt('d:c:hu:', ['device:', 'command:', 'help']);
$o['argv'] = $argv;
$obj = new ModificateHost($o);
