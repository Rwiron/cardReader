<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('auth.search');
    }

    public function fetchUserInfo(Request $request, $cardInfo)
    {
        $user = User::where('card_info', $cardInfo)->first();

        if (!$user) {
            return response()->json(['error' => 'No user found for this card information']);
        }

        return response()->json([
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'photo' => $user->photo, // Ensure the photo URL/path is correct and accessible
        ]);
    }
}
