<?php
/**
 * Создает бэкап в указанной директории
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 13.07.2022
 * Time: 07:59
 */

namespace App;


class Backup
{

    /*
     *    if ($content = $this->replaceBackup($object->get('id'), $object->get('content'), $callback)) {
                $object->setContent($content);
                return $object;
            }
    */
    public function setPathBackup(string $path)
    {
        if (!file_exists($path)) {
            if (!mkdir($path, 0777, true) && !is_dir($path)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
            }
        }
        $this->pathVersion = rtrim($path, '/') . '/';
        return $this;
    }



    /**
     * Замена с бэкапом оригинального html
     * @param $key
     * @param $original
     * @return String|null
     */
    public function replaceBackup($key, string $original, $callback)
    {
        if ($content = $this->replace($original, $callback)) {
            if ($this->backup($key, $original)) {
                return $content;
            }
        }
        return null;
    }

    /**
     * Делаеть бэкап документа
     * @param $key
     * @param $html
     * @return bool|int
     */
    public function backup($key, $html)
    {
        $key = rtrim($key, '.html');
        $size = strlen($html);
        $dir = $this->pathVersion . $key;
        if (!file_exists($dir)) {
            if (!mkdir($dir, 0777, true) && !is_dir($dir)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
            }
        }
        $filePath = $dir . '/' . $size . '.html';
        if (file_exists($filePath)) {
            return true;
        }
        return file_put_contents($filePath, $html);
    }

}
