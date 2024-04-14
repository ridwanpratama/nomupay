<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\UserService;

class ProfileController extends BaseController
{
    private UserService $userService;

    /**
     * Constructor for initializing the userService.
     */
    public function __construct()
    {
        $this->userService = new UserService();
    }

    /**
     * Retrieves the user profile for the currently logged in user.
     *
     * @return view The view for the user's profile with the profile data
     */
    public function index(): string
    {
        $profile = $this->userService->findUserProfileByUserId(session()->get('id'));

        return view('profile/index', compact('profile'));
    }
}
