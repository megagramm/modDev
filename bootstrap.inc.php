<?php

declare(strict_types=1);

/**
 * Модифицирует настройки на устройствах
 *
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

$init_modules = ['cli'];

spl_autoload_register(function ($Class) {
    if (preg_match('/^\w/i', $Class)) {
        $file = $Class . '.php';
        if (file_exists($file)) {
            include_once $file;
            return;
        }
    }

    if (preg_match('/^\w/i', $Class)) {
        $file = ModificateHost::$commandsDir . $Class . '.php';
        if (file_exists($file)) {
            include_once $file;
            return;
        }
    }
});

try {

    $varsFilePath = __DIR__ . '/vars.inc.php';
    if (! is_file($varsFilePath)) {
        ModificateHost::makeVarsFile($varsFilePath);
    }
    include_once $varsFilePath;

    // проверка что все параметры сущетвуют
    if (!ModificateHost::checkCParams()) {
        echo "Запуск скрипта конфигурации" . PHP_EOL;
        ModificateHost::makeVarsFile($varsFilePath);
    }

    if (! is_readable($c['initPath'])) {
        throw new Exception("Wrong Init path", 1);
    }
    require $c['initPath'];

    $o = getopt('d:c:hu:', ['device:', 'command:', 'help']);
    $o['argv'] = $argv;
    $obj = new ModificateHost($o);
} catch (Exception $e) {

    echo "!!! Error " . PHP_EOL . $e->getMessage() . PHP_EOL;
}
