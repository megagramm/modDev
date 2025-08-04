<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class disableSnmpPackages implements ModificateHostInterface
{
    public static function title(): string
    {
        return "Выключить получение по SNMP данных по установленным пакетам";
    }

    public static function shCommand(): string
    {
        return <<<EOF
"rm /run/etc/snmp/snmpd.d/enablePackages.conf && systemctl restart b4c-snmpd"
EOF;
    }
}
