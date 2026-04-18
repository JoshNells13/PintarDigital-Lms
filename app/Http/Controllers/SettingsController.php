<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Services\UploadService;

class SettingsController extends Controller
{
    protected $userRepository;
    protected $uploadService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UploadService $uploadService
    ) {
        $this->userRepository = $userRepository;
        $this->uploadService = $uploadService;
    }

    public function edit()
    {
        return view('settings');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|max:1024',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->uploadService->upload($request->file('avatar'), 'avatars', $user->avatar);
        }

        $this->userRepository->update($user, $data);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $this->userRepository->update(auth()->user(), [
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}
