<?php

namespace App\Http\Controllers;

use App\Models\Rssfeed;
use App\Models\SavedSearch;
use Illuminate\Http\Request;

class Search extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        if ($query) {
            $rssFeeds = RssFeed::where('content', 'like', '%' . $query . '%')
                ->orWhere('title', 'like', '%' . $query . '%')
                ->get();
        } else {
            $rssFeeds = RssFeed::latest()->get();
        }

        return view('search.index', compact('rssFeeds', 'query'));
    }

    public function save(Request $request)
    {
        $query = $request->input('q');

        SavedSearch::create([
            'query' => $query,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('message', 'Search saved!');
    }

}
