<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Rssfeed;
use App\Models\SavedSearch;
use App\Notifications\EntityMentionedNotification;
use App\Notifications\NewRssFeedsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Feeds extends Controller
{
    public function index()
    {
        $feeds = RSSFeed::latest()->paginate(10);
        return view('feeds.index', compact('feeds'));
    }

    public function show($id)
    {
        $feed = RSSFeed::find($id);
        return view('feeds.show', compact('feed'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        $feeds = RSSFeed::where('content', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->get();

        // Retrieve the entities mentioned in the search query
        $entities = Entity::whereIn('name', explode(' ', $query))->get();

        // Filter the feeds based on the entities mentioned in them
        foreach ($entities as $entity) {
            $feeds = $feeds->filter(function ($feed) use ($entity) {
                return stripos($feed->content, $entity->name) !== false || stripos($feed->description, $entity->name) !== false;
            });
        }

        // Save the search query if the user is logged in
        if (Auth::check()) {
            $user = Auth::user();
            $savedSearch = new SavedSearch([
                'query' => $query,
                'user_id' => $user->id,
            ]);
            $savedSearch->save();

            // Send notifications to users who saved the search
            $savedSearch->sendNotifications($feeds);
        }

        return view('feeds.search', compact('feeds', 'query'));
    }

    public function checkForEntityMentions(RSSFeed $feed)
    {
        $entities = Entity::all();

        foreach ($entities as $entity) {
            $users = $entity->users;

            foreach ($users as $user) {
                if ($user->entities->contains($entity) && $user->entities->count() <= 3) {
                    if (stripos($feed->content, $entity->name) !== false || stripos($feed->description, $entity->name) !== false) {
                        $user->notify(new EntityMentionedNotification($feed));
                    }
                }
            }
        }
    }

    public function checkForMatches()
    {
        // Get all saved searches
        $searches = Search::all();

        foreach ($searches as $search) {
            // Check if any RSS feeds match the search criteria
            $matchingFeeds = RssFeed::where('content', 'like', '%' . $search->query . '%')->get();

            if ($matchingFeeds->count() > 0) {
                // Create a new notification for the user
                $notification = $search->notifications()->create([
                    'type' => NewRssFeedsNotification::class,
                ]);

                // Send the notification to the user
                $search->user->notify(new NewRssFeedsNotification($search, $matchingFeeds));
            }
        }
    }

}
