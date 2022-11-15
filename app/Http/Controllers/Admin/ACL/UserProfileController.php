<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    protected $user, $profile;

    public function __construct(User $user, Profile $profile)
    {
        $this->user = $user;
        $this->profile = $profile;

    }
    public function profiles($iduser)
    {
        if (!$user = $this->user->find($iduser)) {
            return redirect()->back();
        }

        $profiles = $user->profiles()->paginate();

        return view('admin.pages.users.profiles.profiles', compact('user', 'profiles'));
    }

    public function users($iduser)
    {
        if (!$user = $this->user->find($iduser)) {
            return redirect()->back();
        }
        $profiles = $user->profiles()->paginate();
        return view('admin.pages.users.profiles.profiles', compact('user', 'profiles'));
    }
    public function profilesAvailable(Request $request, $iduser)
    {
        if (!$user = $this->user->find($iduser)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $profiles = $user->profilesAvailable($request->filter);

        return view('admin.pages.users.profiles.available', compact('user', 'profiles', 'filters'));
    }


    public function attachProfilesUser(Request $request, $iduser)
    {
        if (!$user = $this->user->find($iduser)) {
            return redirect()->back();
        }

        if (!$request->profiles || count($request->profiles) == 0) {
            return redirect()
                ->back()
                ->with('info', 'Precisa escolher pelo menos um usero');
        }

        $user->profiles()->attach($request->profiles);

        return redirect()->route('users.profiles', $user->id);
    }

    public function detachProfileUser($iduser, $idProfile)
    {
        $user = $this->user->find($iduser);
        $profile = $this->profile->find($idProfile);

        if (!$user || !$profile) {
            return redirect()->back();
        }

        $user->profiles()->detach($profile);

        return redirect()->route('users.profiles', $user->id);
    }
}
