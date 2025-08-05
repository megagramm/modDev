<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class makeCool extends CmdAbstract
{
    public static function title(): string
    {
        return "Настроить устройство для работы с песочницей";
    }


    public function shCommand(array $params): void
    {
        $arr = [
            'setSshKey',
            'addRouteToSandbox',
            'enableKnocker',
            'enableSnmp',
            'enableSnmpPackages',
            'enableSnmpTraps',
        ];
        $arr2 = [];
        foreach ($arr as $class) {
            if (class_exists($class)) {
                if (method_exists($class, 'shCommand')) {
                    $arr2[] = (new $class)->shCommand($params);
                }
            }
        }

        $this->cmd = "\"" . str_replace("\"", "", implode(" ;\\" . PHP_EOL, $arr2)) . "\"";
        $this->sshRun($params['user'], $params['host']);
    }
}
