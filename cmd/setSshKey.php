<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class setSshKey extends CmdAbstract
{
    public static function title(): string
    {
        return "Установить ваш ssh ключ чтобы исполнять команды без пароля";
    }


    public function shCommand(array $params): void
    {
        $sshPublicKey = `cat ~/.ssh/id_rsa.pub`;
        $this->cmd = "\" btrfs-rw ; echo '$sshPublicKey' >> ~/.ssh/authorized_keys ; btrfs-ro\"";
        $this->sshRun($params['user'], $params['host']);
    }
}
