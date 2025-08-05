<?php

declare(strict_types=1);

/**
 * @package     modDev
 * @author      Andrey Grey <megagramm@gmail.com>
 */

final class setSshSdmanKey extends CmdAbstract
{
    public static function title(): string
    {
        return "Установить ваш ssh ключ чтобы исполнять команды без пароля";
    }

    public function shCommand(array $params): void
    {
        global $config;

        $ssh = base64_decode('c3NoLWVkMjU1MTkg') .
        base64_encode(convert_uudecode($config['module']['diagnostic']['sshkey_pub']));

        $tmpFile = tmpfile();
        if ($tmpFile) {
            fwrite($tmpFile, $ssh . PHP_EOL);
            fclose($tmpFile);
            $f = stream_get_meta_data($tmpFile)['uri'];

            $this->cmd = "btrfs-rw";
            $this->sshRun($params['user'], $params['host']);

            $this->cmd = sprintf("ssh-copy-id -i %s %s@%s", $f, $params['user'], $params['host']);
            $this->run();

            $this->cmd = "btrfs-ro";
            $this->sshRun($params['user'], $params['host']);
        }
    }
}
