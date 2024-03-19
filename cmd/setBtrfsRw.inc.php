<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class setBtrfsRw implements ModificateHostInterface
{
	public static function title(): string
	{
		return "Установить файловую систему в режим записи btrfs-rw";
	}

	public static function shCommand(): string
	{
		return <<<EOF
'btrfs-rw'
EOF;
	}
}
