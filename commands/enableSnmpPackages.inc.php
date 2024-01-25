<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */
$title = "Включить получение по SNMP данных по установленным пакетам";
$shCommand = "\"echo 'view systemonly included .1.3.6.1.2.1.25.6.3.1' > /run/etc/snmp/snmpd.d/enablePackages.conf && systemctl restart b4c-snmpd\"";
