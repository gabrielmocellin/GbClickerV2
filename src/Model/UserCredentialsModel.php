<?php

namespace Gbclicker\Model;

use GbClicker\DAO\UserDao;
use GbClicker\Model\LevelModel;

class UserCredentialsModel
{
    public $email;
    public $password;

    function __construct(
        $email='',
        $password=''
    ) {
        $this->setEmail($email);
        $this->setPassword($password);
    }

    // =-=-=-=-= GETTERS =-=-=-=-=
    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }


    // =-=-=-=-= SETTERS =-=-=-=-=
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}
