<?php

namespace GbClicker\Controller;

class Error404Controller
{
    public function index()
    {
        http_response_code(404);
    }
}
