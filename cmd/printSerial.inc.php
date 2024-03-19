<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class printSerial implements ModificateHostInterface
{
	public static function title(): string
	{
		return "Показать серийный номер и ключ";
	}

	public static function shCommand(): string
	{
		return <<<EOF
'SER=$(cat /etc/dev_serial) && cat /etc/apt/auth.conf.d/\${SER}.conf | tail -2' | awk '{print $2}'
EOF;
	}
}
