<?php

namespace App\Controllers\Auth;

use App\Helpers\GetClientIP;
use App\Services\UserService;
use App\Helpers\SetSessionData;
use App\Services\SysOtpService;
use App\Controllers\BaseController;
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
        $this->userService = new UserService();
        $this->sysOtpService = new SysOtpService();
    }

    /**
     * Shows the login page
     *
     * @return string The rendered login page
     */
    public function index(): string
    {
        helper(["form"]);
        return view("auth/login");
    }

    /**
     * Perform user login and redirect based on the result.
     *
     * @return RedirectResponse
     */
    public function login(): RedirectResponse
    {
        $user = $this->userService->findUserByEmail($this->request->getVar("email"));
        $currentIp = $this->request->getVar("ip-address");

        if ($user && password_verify($this->request->getVar("password"), $user["password"])) {
            if ($currentIp != $user["last_login_ip"]) {
                $user["last_login_ip"] = $currentIp;
                $this->setLoginOtpSession($user);
            } else {
                $setSessionData = new SetSessionData();
                $setSessionData->create($user, true);

                return redirect()->to("mypanel/dashboard");
            }

            return redirect()->to("auth/verify-otp");
        }

        session()->setFlashdata("error", "Invalid credentials");
        return redirect()->to("auth/login");
    }

    /**
     * Sets the login OTP session data.
     *
     * @param array<string, string|int> $user The user data, with at least the keys 'id', 'name', 'email' and 'phone'.
     * @return void
     */
    private function setLoginOtpSession(array $user): void
    {
        $setSessionData = new SetSessionData();
        $setSessionData->create($user, false);

        $otp = $this->sysOtpService->generateOTP();
        $this->sysOtpService->sendOTP((string) $user["phone"], $otp);
        session()->set("otp", $otp);
    }

    /**
     * Logout the user and redirect to the login page.
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        session()->destroy();
        return redirect()->to("auth/login");
    }
}
