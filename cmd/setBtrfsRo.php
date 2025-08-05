<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class setBtrfsRo extends CmdAbstract
{
    public static function title(): string
    {
        return "Установить файловую систему в режим чтения btrfs-ro";
    }


    public function shCommand(array $params): void
    {
        $this->cmd = <<<EOF
'btrfs-ro'
EOF;
        $this->sshRun($params['user'], $params['host']);
    }
}
