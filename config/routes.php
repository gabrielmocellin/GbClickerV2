<?php
    return [
        "GET|/" => \GbClicker\Controller\LandingpageController::class,
        "GET|/login" => GbClicker\Controller\LoginController::class,
        "GET|/register" => GbClicker\Controller\RegisterController::class,
        "POST|/register/save" => GbClicker\Controller\SaveRegisterController::class
    ];