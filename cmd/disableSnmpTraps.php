<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class disableSnmpTraps extends CmdAbstract
{
    public static function title(): string
    {
        return "Выключить поддержку SNMP Traps";
    }


    public function shCommand(array $params): void
    {
        global $c;
        $this->cmd = <<<EOF
"rm /run/etc/snmp/snmpd.d/enableTraps.{$c['suphix']}.conf && systemctl restart b4c-snmpd"
EOF;
        $this->sshRun($params['user'], $params['host']);
    }
}
