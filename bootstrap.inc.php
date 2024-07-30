<?php

declare(strict_types=1);

/**
 * Модифицирует настройки на устройствах
 *
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

$varsFilePath = __DIR__ . '/vars.inc.php';
if (! is_file($varsFilePath)) {

    echo PHP_EOL
        . "Первый запуск скрипта" . PHP_EOL
        . "Необходимо собрать базовые параметры:" . PHP_EOL
        . PHP_EOL;

    $hostIpShow = $hostIp = `ip -f inet addr show eth0 | grep -Po 'inet \K[\d.]+' | head -n1`;
    $hostIpShow = $hostIpShow ?: 'IP не определён';
    echo "Укажите IP адрес SDMAN ({$hostIpShow}):" . PHP_EOL;
    $ip = trim(fgets(STDIN));
    $hostIp = $ip ?: $hostIp;

    $filenameSuphixShow = $filenameSuphix = (trim(`echo \$USER`) ?: 'sandbox');
    echo "Укажите суффикс для файлов настройки ({$filenameSuphixShow}):" . PHP_EOL;
    $suphix = trim(fgets(STDIN));
    $filenameSuphix = $suphix ?: $filenameSuphix;

    $vars = <<<EOF
<?php

declare(strict_types=1);

/**
 * Модифицирует настройки на устройствах
 *
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

\$config = [];
\$config['ip'] = '$hostIp';
\$config['suphix'] = '$filenameSuphix';
EOF;

    if (file_put_contents($varsFilePath, $vars) === false) {
        die('vars.inc.php does not exists');
    }
    echo "================================" . PHP_EOL . PHP_EOL;
}
include_once $varsFilePath;

include_once __DIR__ . "/" ."ModificateHost.inc.php";
include_once __DIR__ . "/" ."ModificateHostInterface.inc.php";

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
