<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */


final class addRouteToSandbox extends CmdAbstract
{
    public static function title(): string
    {
        return "Добавляет маршрут к песочнице";
    }


    public function shCommand(array $params): void
    {
        global $c;
        $this->cmd = "ip r add {$c['ip']} via 10.77.122.1";
        $this->sshRun($params['user'], $params['host']);
    }
}
