<?php

namespace Inklo\Usecases;

use Inklo\Repositories\IGithubUsersRepository;
use Inklo\Repositories\IFileManager;

class SaveUserLocallyUseCase implements ISaveUserLocallyUseCase
{
    private IGithubUsersRepository $repo;
    private IFileManager $fileManager;

    public function __construct(
        IGithubUsersRepository $repo,
        IFileManager $fileManager
    ) {
        
        $this->repo = $repo;
        $this->fileManager = $fileManager;
    }

    /**
     * @return string
     */
    public function execute(): string
    {
        $username = input()->post('username');

        $data = $this->repo->fetchUser($username);
        
        $folder = 'storage';
        $filename = sprintf('%s__%s.json', $username, date('Y-m-d_H-i-s'));
        $filePath = sprintf('%s/%s', $folder, $filename);
        $fileCreated = $this->fileManager->saveFile($filePath, $data);
        if (!$fileCreated) {
            throw new \Exception(sprintf('O arquivo %s não pôde ser criado.', $filename));
        }
        
        return $filename;
    }
}
