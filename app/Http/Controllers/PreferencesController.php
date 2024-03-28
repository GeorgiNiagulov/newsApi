<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Cache;

class PreferencesController extends Controller
{
    public function showPreferencesForm()
    {
        return view('preferences');
    }

    public function savePreferences(Request $request)
    {
        $validatedData = $request->validate([
            'categories' => 'required|array',
        ]);

        $categoriesJson = json_encode($validatedData['categories']);

        $user = auth()->user();

        $userPreference = UserPreference::where('user_id', $user->id)->first();

        if ($userPreference) {
            $userPreference->categories = $categoriesJson;
            $userPreference->save();
        } else {
            UserPreference::create([
                'user_id' => $user->id,
                'categories' => $categoriesJson,
            ]);
        }

        $cacheKey = 'news_for_user_' . $user->id;
        Cache::forget($cacheKey);

        return redirect('/dashboard')->with('success', 'Preferences saved successfully!');
    }

}
