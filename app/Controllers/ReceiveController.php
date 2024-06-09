<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use chillerlan\QRCode\QRCode;

class ReceiveController extends BaseController
{
    public function index ()
    {
        $qrCodeLib = new QRCode();
        $qrValue = session('phone');

        $qrCode = $qrCodeLib->render($qrValue);
        
        return view('receive/index', compact('qrCode'));
    }
}