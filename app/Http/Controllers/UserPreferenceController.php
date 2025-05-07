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
            'background_image' => 'nullable|string',
            'avatar_color' => 'nullable|string',
            'background_color' => 'nullable|string',
        ]);
    
        $user = Auth::user();
    
        UserPreference::updateOrCreate(
            ['user_id' => $user->id],
            [
                'background_image' => $request->background_image,
                'avatar_color' => $request->avatar_color,
                'background_color' => $request->background_color, 
            ]
        );
    
        return redirect()->route('settings')->with('success', 'Preferences updated successfully!');
    }
    
    public function getPreference()
    {
        $user = Auth::user();
        $preference = UserPreference::where('user_id', $user->id)->first();
    
        return response()->json([
            'background_image' => $preference?->background_image,
            'avatar_color' => $preference?->avatar_color,
            'background_color' => $preference?->background_color, 
        ]);
    }
    
    
}
