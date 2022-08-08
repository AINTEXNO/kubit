<?php

namespace App\Controllers;

use App\Services\Request;

class Controller
{
    protected $request;

    public function __construct()
    {
        $this->request = new Request();
    }
}