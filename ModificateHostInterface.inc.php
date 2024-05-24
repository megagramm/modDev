<?php

declare(strict_types=1);

/**
 * Модифицирует настройки на устройствах, если они были сброшены
 *
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

interface ModificateHostInterface
{
    public static function title(): string;
    public static function shCommand(): string;
}
