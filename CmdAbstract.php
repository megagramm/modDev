<?php

declare(strict_types=1);

/**
 * Модифицирует настройки на устройствах, если они были сброшены
 *
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

abstract class CmdAbstract
{
    protected $cmd = "";


    protected function run(): void
    {
        echo $this->cmd . PHP_EOL;
        echo shell_exec($this->cmd);
    }


    protected function sshRun($user, $host): void
    {
        $this->cmd = sprintf(
            "ssh %s@%s %s",
            $user,
            $host,
            $this->cmd
        );
        echo $this->cmd . PHP_EOL;
        echo shell_exec($this->cmd);
    }


    abstract public static function title(): string;
    abstract public function shCommand(array $params): void;
}
