<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class ReceiveController extends BaseController
{
    public function index ()
    {
        return view('receive/index');
    }
}