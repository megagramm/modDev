<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */
$title = "Включить ответ по SNMP для устройства у всех comunity";
$shCommand = "\"echo 'rocommunity public  default    -V systemonly' > /run/etc/snmp/snmpd.d/rocommunity.conf && systemctl restart b4c-snmpd\"";
