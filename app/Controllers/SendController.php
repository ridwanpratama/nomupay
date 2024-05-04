<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class SendController extends BaseController
{
    public function index ()
    {
        return view('send/index');
    }
}