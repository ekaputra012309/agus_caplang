<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use RealRashid\SweetAlert\Facades\Alert;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'update_password_current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = $request->user();

        // Check if the current password is correct
        if (!Hash::check($validatedData['update_password_current_password'], $user->password)) {
            return Redirect::back()->withErrors(['update_password_current_password' => 'The provided password does not match your current password.']);
        }

        // Update the password
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        // Redirect back with a success status
        Alert::success('Success', 'Password updated successfully.');
        return redirect()->route('profile.edit');
    }
}
