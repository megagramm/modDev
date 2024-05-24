<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class makeCool implements ModificateHostInterface
{
    public static function title(): string
    {
        return "Настроить устройство для работы с песочницей";
    }

    public static function shCommand(): string
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
                    $arr2[] = $class::shCommand();
                }
            }
        }

        $str = "\"" . str_replace("\"", "", implode(" ;\\" . PHP_EOL, $arr2)) . "\"";
        // var_dump($str);

        return $str;
    }
}
