<?php
namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Services\SysOtpService;
use CodeIgniter\HTTP\RedirectResponse;

class VerifyController extends BaseController
{
    private SysOtpService $sysOtpService;

    /**
     * Constructor for initializing the SysOtpService.
     */
    public function __construct()
    {
        $this->sysOtpService = new SysOtpService();
    }

    /**
     * Render the verify OTP view.
     *
     * @return string The rendered view
     */
    public function verifyOTP(): string
    {
        helper(['form']);
        return view('auth/verify-otp');
    }

    /**
     * Verify the OTP code entered by the user.
     */
    public function checkVerifyOTP(): RedirectResponse
    {
        $enteredOTP = $this->request->getVar('otp');
        if ( ! $this->sysOtpService->isValid($enteredOTP)) {
            session()->setFlashdata('error', 'Invalid OTP code');
            return redirect()->to('auth/verify-otp');
        }

        session()->set('isLoggedIn', true);
        return redirect()->to('mypanel/dashboard');
    }
}
