<?php

namespace Inklo\Repositories;

class FileManager implements IFileManager
{
    /**
     * @param string $filename
     * @param string $content
     * @return bool
     */
    public function saveFile(string $filename, string $content): bool
    {
        return @file_put_contents($filename, $content) !== false;
    }
}
