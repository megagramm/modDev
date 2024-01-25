<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */
$title = "Установить ваш ssh ключ чтобы исполнять команды без пароля";
$sshPublicKey = `cat ~/.ssh/id_rsa.pub`;
$shCommand = "\" btrfs-rw ; echo '$sshPublicKey' >> ~/.ssh/authorized_keys ; btrfs-ro\"";
