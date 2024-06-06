<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserProfile;
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

    public function update()
    {
        $file = $this->request->getFile('image');

        $newName = null;

        if ($this->request->getPost('image_exist') != '') {
            $newName = $this->request->getPost('image_exist');
        } else {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
    
                $file->move(FCPATH . 'uploads/profile', $newName);
            }
        }

        if ($this->request->getPost('id') != '') {
            $id = $this->request->getPost('id');

            $userProfile = new UserProfile();

            $userProfile->update($id, [
                            'address'       => $this->request->getPost('address'),
                            'city'          => $this->request->getPost('city'),
                            'postal_code'   => $this->request->getPost('postal_code'),
                            'image'         => $newName,
                        ]);

            return redirect()->to('mypanel/profile')->with('berhasil', 'Profil berhasil di perbaharui');
        } else {
            $userProfile = new UserProfile();

            $userProfile->insert([
                'user_id'       => $this->request->getPost('user_id'),
                'address'       => $this->request->getPost('address'),
                'city'          => $this->request->getPost('city'),
                'postal_code'   => $this->request->getPost('postal_code'),
                'image'         => $newName
            ]);

            return redirect()->to('mypanel/profile')->with('berhasil', 'Profil berhasil di perbaharui');
        }
    }
}
