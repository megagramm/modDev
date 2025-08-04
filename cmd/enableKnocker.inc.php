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
        global $c;
        return <<<EOF
"btrfs-rw \
; cp /run/systemd/system/knock.timer /run/systemd/system/knock.{$c['suphix']}.timer \
; sed -i 's/knock.service/knock.{$c['suphix']}.service/g' /run/systemd/system/knock.{$c['suphix']}.timer \
; sed -i 's/"1m 30s"/90/g' /run/systemd/system/knock.{$c['suphix']}.timer \
; cp /run/systemd/system/knock.service /run/systemd/system/knock.{$c['suphix']}.service \
; sed -i 's/10.2.0.1/{$c['ip']}/g' /run/systemd/system/knock.{$c['suphix']}.service \
; systemctl enable knock.{$c['suphix']}.timer \
; systemctl start knock.{$c['suphix']}.timer \
; btrfs-ro"
EOF;
    }
}
