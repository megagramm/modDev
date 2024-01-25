<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */
$title = "Выключить получение по SNMP данных по установленным пакетам";
$shCommand = "\"rm /run/etc/snmp/snmpd.d/enablePackages.conf && systemctl restart b4c-snmpd\"";
