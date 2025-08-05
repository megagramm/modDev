<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class setBtrfsRw extends CmdAbstract
{
    public static function title(): string
    {
        return "Установить файловую систему в режим записи btrfs-rw";
    }


    public function shCommand(array $params): void
    {
        $this->cmd = <<<EOF
'btrfs-rw'
EOF;
        $this->sshRun($params['user'], $params['host']);
    }
}
