<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class addRouteToSandbox implements ModificateHostInterface
{
    public static function title(): string
    {
        return "Добавляет маршрут к песочнице";
    }

    public static function shCommand(): string
    {
        global $config;
        return <<<EOF
"ip r add {$config['ip']} via 10.77.122.1"
EOF;
    }
}
