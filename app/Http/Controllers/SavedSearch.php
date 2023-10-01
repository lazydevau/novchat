<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedSearch extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $savedSearches = $user->savedSearches;

        return view('saved-searches.index', compact('savedSearches'));
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'notifiable_id')->where('notifiable_type', Search::class);
    }

}
