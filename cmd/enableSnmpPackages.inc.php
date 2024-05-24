<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class enableSnmpPackages implements ModificateHostInterface
{
    public static function title(): string
    {
        return "Включить получение по SNMP данных по установленным пакетам";
    }

    public static function shCommand(): string
    {
        return <<<EOF
"echo 'view systemonly included .1.3.6.1.2.1.25.6.3.1' > /run/etc/snmp/snmpd.d/enablePackages.conf && systemctl restart b4c-snmpd"
EOF;
    }
}
