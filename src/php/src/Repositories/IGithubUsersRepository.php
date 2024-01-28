<?php

namespace Inklo\Repositories;

interface IGithubUsersRepository
{
    /**
     * @param string $username
     * @return string
     */
    public function fetchUser(string $username): string;
}
