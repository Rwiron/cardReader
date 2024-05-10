<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yoeunes\Toastr\Facades\Toastr;

class CardController extends Controller
{
    /**
     * Display the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        return view('auth.register');  // ensure this view path is correct
    }

    /**
     * Handle the registration of a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'card_info' => 'required|string|max:255', // Validation rule for card info
        ]);

        if ($validator->fails()) {
            // Use Toastr to display error messages
            foreach ($validator->errors()->all() as $error) {
                Toastr::error($error);
            }
            return redirect()->back()->withInput();
        }

        // Handle file upload
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $imageName);
            $photoPath = "/images/" . $imageName;
        }

        // Create and save the user
        $user = new User();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->photo = $photoPath ?? null;  // Store the path of the photo
        $user->card_info = $request->card_info; // Save the card info
        $user->save();

        // Use Toastr to notify about successful registration
        Toastr::success('Account created successfully!');

        return redirect()->route('register');  // Adjust the redirection as necessary
    }
}