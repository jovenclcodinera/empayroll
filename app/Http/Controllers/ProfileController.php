<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index() {
        $user = auth()->user();
        if (request()->has('id')) {
            $user = User::find(request()->id);
        }
        return view('profile.index', [
            'user' => $user,
            'departments' => Department::orderBy('name')->get(),
        ]);
    }

    public function updateAvatar(Request $request) {
        $request->validate([
            'avatar' => 'required|image'
        ]);

        $imageName = auth()->user()->id . '.' . $request->avatar->extension();

        if (Storage::disk('local')->exists(auth()->user()->employee->avatar_url)) {
            Storage::delete(auth()->user()->employee->avatar_url);
        }

        $path = $request->avatar->storeAs('images', $imageName);
        auth()->user()->employee->update([
            'avatar_url' => $path
        ]);

        return redirect(route('profile.index'))->with('alert', [
            'type' => 'success',
            'message' => 'Avatar successfully updated'
        ]);
    }

    public function update(Request $request) {
        $request->validate(
            [
                'editProfileName' => 'required',
                'editProfilePosition' => 'sometimes',
                'editProfileDepartment' => 'sometimes',
                'editProfileAboutMe' => 'sometimes'
            ],
            [],
            [
                'editProfileName' => 'name',
                'editProfilePosition' => 'position',
                'editProfileDepartment' => 'department',
                'editProfileAboutMe' => 'about_me',
            ]
        );

        auth()->user()->update(['name' => $request->editProfileName]);
        auth()->user()->employee()->update([
            'position' => $request->editProfilePosition,
            'department' => $request->editProfileDepartment,
            'about_me' => $request->editProfileAboutMe,
        ]);

        return redirect(route('profile.index'))->with('alert', [
            'type' => 'success',
            'message' => 'Profile successfully updated'
        ]);
    }
}
