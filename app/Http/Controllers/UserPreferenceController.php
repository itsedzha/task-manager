<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPreferenceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'background_image' => 'required|string',
        ]);

        $user = Auth::user();

        UserPreference::updateOrCreate(
            ['user_id' => $user->id],
            ['background_image' => $request->background_image]
        );

        return response()->json(['message' => 'Background preference saved successfully!']);
    }

    public function getPreference()
    {
        $user = Auth::user();
        $preference = UserPreference::where('user_id', $user->id)->first();

        return response()->json([
            'background_image' => $preference ? $preference->background_image : null,
        ]);
    }
}
