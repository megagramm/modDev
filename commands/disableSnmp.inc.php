<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */
$title = "Выключить ответ по SNMP для устройства у всех comunity";
$shCommand = "\"echo 'rocommunity public  10.2.0.1    -V systemonly' > /run/etc/snmp/snmpd.d/rocommunity.conf && systemctl restart b4c-snmpd\"";
