<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class disableSnmpTraps implements ModificateHostInterface
{
    public static function title(): string
    {
        return "Выключить поддержку SNMP Traps";
    }

    public static function shCommand(): string
    {
        global $config;
        return <<<EOF
"rm /run/etc/snmp/snmpd.d/enableTraps.{$config['suphix']}.conf && systemctl restart b4c-snmpd"
EOF;
    }
}
