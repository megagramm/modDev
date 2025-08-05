<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class disabledKnocker extends CmdAbstract
{
    public static function title(): string
    {
        return "Выключить knocker для отправки данных в песочницу";
    }


    public function shCommand(array $params): void
    {
        global $c;
        $this->cmd = <<<EOF
"btrfs-rw \
&& systemctl disabled knock.{$c['suphix']}.timer \
&& rm /run/systemd/system/knock.{$c['suphix']}.timer \
&& rm /run/systemd/system/knock.{$c['suphix']}.service \
&& btrfs-ro
"
EOF;
        $this->sshRun($params['user'], $params['host']);
    }
}
