<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */
final class enableKnocker implements ModificateHostInterface
{
    public static function title(): string
    {
        return "Включить knocker для отправки данных в песочницу";
    }

    public static function shCommand(): string
    {
        return <<<EOF
"btrfs-rw \
&& cp /run/systemd/system/knock.timer /run/systemd/system/knock.sandbox.timer && sed -i 's/knock.service/knock.sandbox.service/g' /run/systemd/system/knock.sandbox.timer \
&& cp /run/systemd/system/knock.service /run/systemd/system/knock.sandbox.service && sed -i 's/10.2.0.1/10.77.128.150/g' /run/systemd/system/knock.sandbox.service \
&& systemctl enable knock.sandbox.timer \
&& btrfs-ro
"
EOF;
        "echo 'trap2sink 10.77.128.150 public 162' > /run/etc/snmp/snmpd.d/enableTraps.conf && systemctl restart b4c-snmpd";
    }
}
