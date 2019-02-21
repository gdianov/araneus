<?php

declare(strict_types=1);

namespace Araneus\File;

trait FileTrait
{
    /**
     * @param string $dir
     * @param string $extension
     * @return array
     * @throws \Exception
     */
    public function findFiles(string $dir, string $extension) : array
    {
        $this->clearDir($dir);
        $list = [];
        $handle = $this->openDir($dir);
        while (($file = readdir($handle)) !== false) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            if (is_file($path) && pathinfo($path, PATHINFO_EXTENSION) === $extension) {
                $list[] = $path;
            }
        }
        closedir($handle);

        return $list;
    }

    /**
     * @param string $dir
     * @throws \Exception
     */
    protected function clearDir(string $dir)
    {
        if (!is_dir($dir)) {
            throw new \Exception('Invalid directory.');
        }
    }

    /**
     * @param $dir
     * @return bool|resource
     * @throws \Exception
     */
    private function openDir(string $dir)
    {
        $handle = opendir($dir);
        if ($handle === false) {
            throw new \Exception("Unable to open directory: $dir");
        }
        return $handle;
    }
}