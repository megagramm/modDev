<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class enableSnmpTraps implements ModificateHostInterface
{
	public static function title(): string
	{
		return "Включить поддержку SNMP Traps";
	}

	public static function shCommand(): string
	{
		return <<<EOF
"echo 'trap2sink 192.168.14.73 public 8062' > /run/etc/snmp/snmpd.d/enableTraps.conf && systemctl restart b4c-snmpd"
EOF;
	}
}
