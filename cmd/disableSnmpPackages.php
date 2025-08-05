<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class disableSnmpPackages extends CmdAbstract
{
    public static function title(): string
    {
        return "Выключить получение по SNMP данных по установленным пакетам";
    }


    public function shCommand(array $params): void
    {
        $this->cmd = <<<EOF
"rm /run/etc/snmp/snmpd.d/enablePackages.conf && systemctl restart b4c-snmpd"
EOF;
        $this->sshRun($params['user'], $params['host']);
    }
}
