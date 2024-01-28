<?php

namespace Inklo\Repositories;

interface IFileManager
{
    /**
     * @param string $filename
     * @param string $content
     * @return bool
     */
    public function saveFile(string $filename, string $content): bool;
}
