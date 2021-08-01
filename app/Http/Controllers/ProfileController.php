<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.profile.index', compact('user'));
    }

    public function update(ProfileRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::user();
        if ($validated['type'] === 'updatePassword') {
            if (Hash::check($validated['oldPassword'], $user->password)) {
                $user->update(
                    [
                        'password' => Hash::make($validated['newPassword'])
                    ]
                );
                return response()->json(
                    [
                        'status'    => 'success',
                        'message'   => 'Password Was Updated!'
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status'    => 'error',
                        'message'   => 'Password Is Incorect!'
                    ],
                    200
                );
            }
        } else if ($validated['type'] === 'updateProfile') {
            $user->update([
                'name'  => $validated['name'] ?? $user->name,
                'email' => $validated['email'] ?? $user->email
            ]);
            return response()->json(
                [
                    'status'    => 'success',
                    'message'   => 'Profile Was Updated!'
                ],
                200
            );
        }
    }
}
