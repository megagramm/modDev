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
        global $config;
        return <<<EOF
"echo 'trap2sink {$config['ip']} public 162' > /run/etc/snmp/snmpd.d/enableTraps.{$config['suphix']}.conf && systemctl restart b4c-snmpd"
EOF;
    }
}
