# modDev
Небольшой скрипт для настройки устройств через выполнение команды по ssh.
По работе часто приходится тестировать функционал проекта и необходимо чтоб утройства оперативно переключались в разные режимы работы. Для этого написал этот скрипт, который можно пополнять командами по мере роста задач.

## Содержание
- [modDev](#moddev)
  - [Содержание](#содержание)
  - [Доступные опции](#доступные-опции)
  - [Доступные команды](#доступные-команды)
    - [Примеры:](#примеры)
  - [Todo](#todo)

## Доступные опции
* -d | --device   [обязательная] hostname, ip устройства, путь к файлу, где каждое устройство записано на новой строке.
* -c | --command  [обязательная] команда на исполение, путь к файлу, где каждая команда указана на новой строке.
* -u              имя пользователя. default: root
* -h | --help     вывести окно помощи

## Доступные команды

  - addRouteToSandbox   Добавляет маршрут к песочнице
  - disableSnmp         Выключить ответ по SNMP для устройства у всех comunity
  - disableSnmpPackages Выключить получение по SNMP данных по установленным пакетам
  - disableSnmpTraps    Выключить поддержку SNMP Traps
  - disabledKnocker     Выключить knocker для отправки данных в песочницу
  - enableKnocker       Включить knocker для отправки данных в песочницу
  - enableSnmp          Включить ответ по SNMP для устройства у всех comunity
  - enableSnmpPackages  Включить получение по SNMP данных по установленным пакетам
  - enableSnmpTraps     Включить поддержку SNMP Traps
  - makeCool            Настроить устройство для работы с песочницей
  - printSerial         Показать серийный номер и ключ
  - setBtrfsRo          Установить файловую систему в режим чтения btrfs-ro
  - setBtrfsRw          Установить файловую систему в режим записи btrfs-rw
  - setSshKey           Установить ваш ssh ключ чтобы исполнять команды без пароля
  - test                Тестирование подключения

### Примеры:
Протестировать что доступ по ssh к устройству hostname.local
```
./md.php -d hostname.local -c test
```

Для 192.168.10.3 построить маршрут к песочнице и включить отдачу snmp для всех
```
./md.php -d 192.168.10.3 -c addRouteToSandbox -с enableSnmp
```

Настроить 3 перечисленных стройства для работы с песочницей
```
./md.php -d 10.10.10.101 -d 10.10.10.102 -d 10.10.10.103 -c makeCool
```
Выполлнить команды из файла для перечисленных в фаайле устройств
```
./md.php -d /path/to/devicesFile -c /path/to/commandsFile
```

Команду добавить можно разместив новый класс-файл в cmd/<названиекоманды>.inc.php

## Todo
- Работать напрямую с sh-командами
