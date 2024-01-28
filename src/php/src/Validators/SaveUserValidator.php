<?php

namespace Inklo\Validators;

class SaveUserValidator implements ISaveUserValidator
{
    /**
     * @return void
     */
    public function validate(): void
    {
        $username = input()->post('username');
        if (!$username) {
            throw new \Exception('username field is required');
        }
    }
}
