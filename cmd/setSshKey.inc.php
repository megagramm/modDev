<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class setSshKey implements ModificateHostInterface
{
	public static function title(): string
	{
		return "Установить ваш ssh ключ чтобы исполнять команды без пароля";
	}

	public static function shCommand(): string
	{
		$sshPublicKey = `cat ~/.ssh/id_rsa.pub`;
		return "\" btrfs-rw ; echo '$sshPublicKey' >> ~/.ssh/authorized_keys ; btrfs-ro\"";
	}
}
