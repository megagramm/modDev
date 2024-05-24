<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class setBtrfsRo implements ModificateHostInterface
{
    public static function title(): string
    {
        return "Установить файловую систему в режим чтения btrfs-ro";
    }

    public static function shCommand(): string
    {
        return <<<EOF
'btrfs-ro'
EOF;
    }
}
