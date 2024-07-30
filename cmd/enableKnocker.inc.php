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
        global $config;
        return <<<EOF
"btrfs-rw \
; cp /run/systemd/system/knock.timer /run/systemd/system/knock.{$config['suphix']}.timer && sed -i 's/knock.service/knock.{$config['suphix']}.service/g' /run/systemd/system/knock.{$config['suphix']}.timer \
; cp /run/systemd/system/knock.service /run/systemd/system/knock.{$config['suphix']}.service && sed -i 's/10.2.0.1/{$config['ip']}/g' /run/systemd/system/knock.{$config['suphix']}.service \
; systemctl enable knock.{$config['suphix']}.timer \
; systemctl start knock.{$config['suphix']}.timer \
; btrfs-ro"
EOF;
    }
}
