<?php

namespace App\Controllers;

use App\Services\Request;

class Controller
{
    /**
     * @var Request - инстанс класса Request
     */
    protected $request;

    public function __construct()
    {
        $this->request = new Request();
    }
}