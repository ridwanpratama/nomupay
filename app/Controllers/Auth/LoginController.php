<?php
namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Services\SysOtpService;
use App\Services\UserService;
use CodeIgniter\HTTP\RedirectResponse;

class LoginController extends BaseController
{
    private UserService $userService;
    private SysOtpService $sysOtpService;

    /**
     * Constructor for initializing the UserService and SysOtpService.
     */
    public function __construct()
    {
        $this->userService   = new UserService();
        $this->sysOtpService = new SysOtpService();
    }

    /**
     * Shows the login page
     *
     * @return string The rendered login page
     */
    public function index(): string
    {
        helper(['form']);
        return view('auth/login');
    }

    /**
     * Perform user login and redirect based on the result.
     *
     * @return RedirectResponse
     */
    public function login(): RedirectResponse
    {
        $user = $this->userService->findUserByEmail($this->request->getVar('email'));

        if ($user && password_verify($this->request->getVar('password'), $user['password'])) {
            $this->setLoginOtpSession($user);
            return redirect()->to('auth/verify-otp');
        }

        session()->setFlashdata('error', 'Invalid credentials');
        return redirect()->to('auth/login');
    }

    /**
     * Sets the login OTP session data.
     *
     * @param array<string, string|int> $user The user data, with at least the keys 'id', 'name', 'email' and 'phone'.
     * @return void
     */
    private function setLoginOtpSession(array $user): void
    {
        $this->setSessionData($user, false);

        $otp = $this->sysOtpService->generateOTP();
        $this->sysOtpService->sendOTP((string) $user['phone'], $otp);
        session()->set('otp', $otp);
    }

    /**
     * Sets session data for the user.
     *
     * @param array $user The user data array.
     * @param bool $isLoggedIn The user's login status.
     * @return void
     */
    private function setSessionData(array $user, bool $isLoggedIn): void
    {
        /**
         * @var Session $session
         */
        $session     = session();
        $sessionData = [
            'id'         => (int) $user['id'],
            'name'       => (string) $user['name'],
            'email'      => (string) $user['email'],
            'phone'      => (string) $user['phone'],
            'isLoggedIn' => $isLoggedIn,
        ];
        $session->set($sessionData);
    }

    /**
     * Logout the user and redirect to the login page.
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        session()->destroy();
        return redirect()->to('auth/login');
    }
}
