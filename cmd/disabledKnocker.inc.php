<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */
final class disabledKnocker implements ModificateHostInterface
{
    public static function title(): string
    {
        return "Выключить knocker для отправки данных в песочницу";
    }

    public static function shCommand(): string
    {
        return <<<EOF
"btrfs-rw \
&& systemctl disabled knock.sandbox.timer \
&& rm /run/systemd/system/knock.sandbox.timer \
&& rm /run/systemd/system/knock.sandbox.service \
&& btrfs-ro
"
EOF;
        "echo 'trap2sink 10.77.128.150 public 162' > /run/etc/snmp/snmpd.d/enableTraps.conf && systemctl restart b4c-snmpd";
    }
}
