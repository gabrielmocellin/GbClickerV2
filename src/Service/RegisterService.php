<?php

namespace GbClicker\Service;

use GbClicker\DAO\UserDAO;
use GbClicker\Model\RegisterModel;
use Exception;

class RegisterService
{
    private UserDAO $userDao;

    public function __construct(UserDAO $userDao)
    {
        $this->userDao = $userDao;
    }

    public function register(RegisterModel $model): bool
    {
        return $this->userDao->register($model);
    }
}
