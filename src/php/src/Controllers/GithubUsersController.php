<?php

namespace Inklo\Controllers;

use Inklo\Usecases\ISaveUserLocallyUseCase;
use \Inklo\Validators\ISaveUserValidator;

class GithubUsersController
{
    private ISaveUserLocallyUseCase $useCase;
    private ISaveUserValidator $saveValidator;

    public function __construct(
        ISaveUserLocallyUseCase $useCase,
        ISaveUserValidator $saveValidator
    ) {
        
        $this->useCase = $useCase;
        $this->saveValidator = $saveValidator;
    }

    public function index()
    {
        response()->json([
            'message' => 'Usuários Github v.1',
        ]);
    }

    public function save()
    {
        try {
            $this->saveValidator->validate();
            $filename = $this->useCase->execute();
            response()->json([
                'success' => true,
                'message' => 'Informações gravadas com sucesso no arquivo',
                'filename' => $filename
            ]);
        } catch (\Throwable $th) {
            response()->httpCode(500)->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
