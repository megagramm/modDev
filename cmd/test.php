<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class test implements ModificateHostInterface
{
    public static function title(): string
    {
        return "Тестирование подключения";
    }

    public static function shCommand(): string
    {
        return "echo 'I am in; hostname;'";
    }
}
