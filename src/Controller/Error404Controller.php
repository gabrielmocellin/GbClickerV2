<?php

namespace GbClicker\Controller;

class Error404Controller
{
    public static function index()
    {
        http_response_code(404);
    }
}
