<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class enableSnmp extends CmdAbstract
{
    public static function title(): string
    {
        return "Включить ответ по SNMP для устройства у всех comunity";
    }


    public function shCommand(array $params): void
    {
        $this->cmd = <<<EOF
"echo 'rocommunity public  default    -V systemonly' > /run/etc/snmp/snmpd.d/rocommunity.conf && systemctl restart b4c-snmpd"
EOF;
        $this->sshRun($params['user'], $params['host']);
    }
}
