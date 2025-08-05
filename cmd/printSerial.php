<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class printSerial extends CmdAbstract
{
    public static function title(): string
    {
        return "Показать серийный номер и ключ";
    }


    public function shCommand(array $params): void
    {
        $this->cmd = <<<EOF
'SER=$(cat /etc/dev_serial) && cat /etc/apt/auth.conf.d/\${SER}.conf | tail -2' | awk '{print $2}'
EOF;
        $this->sshRun($params['user'], $params['host']);
    }
}
