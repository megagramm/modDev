<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class enableSnmp implements ModificateHostInterface
{
	public static function title(): string
	{
		return "Включить ответ по SNMP для устройства у всех comunity";
	}

	public static function shCommand(): string
	{
		return <<<EOF
"echo 'rocommunity public  default    -V systemonly' > /run/etc/snmp/snmpd.d/rocommunity.conf && systemctl restart b4c-snmpd"
EOF;
	}
}
