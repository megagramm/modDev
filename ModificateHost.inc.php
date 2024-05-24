<?php

declare(strict_types=1);

/**
 * Модифицирует настройки на устройствах, если они были сброшены
 *
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

class ModificateHost
{
    public static $commandsDir = __DIR__ . '/cmd/'; // путь к классам-командам
    protected $devices; // устройство или устройства для применения
    protected $commands; //команда на исполнение
    protected $user = 'root'; // пользователь по-умолчанию

    public function __construct($o)
    {
        if (empty($o['c'])) {
            $o['c'] = '';
        }

        if (empty($o['d'])) {
            $o['d'] = '';
        }

        if (empty($o['u'])) {
            $o['u'] = '';
        }

        if (isset($o['command'])) {
            $o['c'] = $o['command'];
        }

        if (isset($o['device'])) {
            $o['d'] = $o['device'];
        }

        if (isset($o['user'])) {
            $o['u'] = $o['user'];
        }

        if (
            count($o['argv']) == 1 // нет параметров
            || isset($o['h'])
            || isset($o['help'])
            || empty($o['d'])      // нет устройства
            || empty($o['c'])      // нет комманды
        ) {
            echo self::getHelpScreen($o['argv']);
            exit;
        }

        if (is_string($o['d'])) {
            $this->devices[] = $o['d'];
        } else {
            foreach ($o['d'] as $device) {
                if (is_file($device)) {
                    $lines = file($device, FILE_IGNORE_NEW_LINES);
                    foreach ($lines as $deviceFromFile) {
                        $this->devices[] = $deviceFromFile;
                    }
                } else {
                    $this->devices[] = $device;
                }
            }
        }

        if (is_string($o['c'])) {
            $this->commands[] = $o['c'];
        } else {
            foreach ($o['c'] as $command) {
                if (is_file($command)) {
                    $lines = file($command, FILE_IGNORE_NEW_LINES);
                    foreach ($lines as $commandFromFile) {
                        $this->commands[] = $commandFromFile;
                    }
                } else {
                    $this->commands[] = $command;
                }
            }
        }

        $this->user = $o['u'][0] ?? $this->user;

        foreach ($this->devices as $device) {
            foreach ($this->commands as $command) {
                if (class_exists($command)) {
                    $cmd = sprintf(
                        "ssh %s@%s %s",
                        $this->user,
                        $device,
                        $command::shCommand()
                    );
                    echo $cmd . PHP_EOL;
                    echo shell_exec($cmd);
                } else {
                    echo "Команды {$command} не существует" . PHP_EOL;
                    continue;
                }
            }
        }
    }

    public static function getHelpScreen(array $argv): string
    {
        $commandsPrint = self::getCommands();
        return <<<EOF
Скрипт изменяет некоторые состояния устройств. Например разрешает/запрещает отдавать данные любому по snmp:

Доступные опции:
	-d | --device   [обязательная] hostname, ip устройства, путь к файлу, где каждое устройство записано на новой строке.
	-c | --command  [обязательная] команда на исполение, путь к файлу, где каждая команда указана на новой строке.
	-h | --help     вывести это окно
	-u              username (default:root)

Доступные команды:

$commandsPrint

Примеры:
Протестировать что доступ по ssh к устройству hostname.local
$argv[0] -d hostname.local -c test

Для 192.168.10.3 построить маршрут к песочнице и включить отдачу snmp для всех
$argv[0] -d 192.168.10.3 -c addRouteToSandbox -с enableSnmp

Настроить 3 перечисленных стройства для работы с песочницей
$argv[0] -d 10.10.10.101 -d 10.10.10.102 -d 10.10.10.103 -c makeCool

Выполлнить команды из файла для перечисленных в фаайле устройств
$argv[0] -d /path/to/devicesFile -c /path/to/commandsFile

EOF . PHP_EOL;
    }


    public static function getCommands(): string
    {
        $commandsPrint = "";
        $arr = [];
        $maxKeyLengh = 0;
        foreach (glob(self::$commandsDir . '*.inc.php') as $value) {
            $key = basename($value, '.inc.php');
            if (class_exists($key)) {
                if (strlen($key) > $maxKeyLengh) {
                    $maxKeyLengh = strlen($key);
                }
                $arr[$key] = $key::title();
            }
        }

        foreach ($arr as $key => $value) {
            $spacer = strlen($key) < $maxKeyLengh ? str_repeat(" ", ($maxKeyLengh - strlen($key))) : "";

            $commandsPrint .= <<<EOF
  - {$key}{$spacer} {$value}
EOF . PHP_EOL;
        }
        return $commandsPrint;
    }
}
