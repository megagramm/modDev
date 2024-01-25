<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */
$title = "Включить поддержку SNMP Traps";
$shCommand = "\"echo 'trap2sink 192.168.14.73 public 8062' > /run/etc/snmp/snmpd.d/enableTraps.conf && systemctl restart b4c-snmpd\"";
