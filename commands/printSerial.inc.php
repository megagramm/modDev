<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */


$title = "Показать серийный номер и ключ";
$shCommand = <<<EOF
'SER=$(cat /etc/dev_serial) && cat /etc/apt/auth.conf.d/\${SER}.conf | tail -2' | awk '{print $2}'
EOF;
