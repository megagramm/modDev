<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class test extends CmdAbstract
{
    public static function title(): string
    {
        return "Тестирование подключения";
    }


    public function shCommand(array $params): void
    {
        $this->cmd = "echo 'I am in; hostname;'";
        $this->sshRun($params['user'], $params['host']);
    }
}
