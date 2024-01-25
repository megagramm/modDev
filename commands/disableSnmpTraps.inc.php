<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */
$title = "Выключить поддержку SNMP Traps";
$shCommand = "\"rm /run/etc/snmp/snmpd.d/enableTraps.conf && systemctl restart b4c-snmpd\"";
