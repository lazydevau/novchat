<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Rssfeed;
use App\Notifications\EntityMentionedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedsController extends Controller
{
    public function index()
    {
        $feeds = RSSFeed::latest()->where('img', '!=', '')->paginate(20);
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
            ->paginate(20);

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

    // Create a function to generate a default image with GD library
    public static function generateDefaultImage() {
        // Set the size of the image
        $imageWidth = 300;
        $imageHeight = 75;

        // Create a new image
        $image = imagecreate($imageWidth, $imageHeight);

        // Set the background color to gray
        $bgColor = imagecolorallocate($image, 128, 128, 128);
        imagefill($image, 0, 0, $bgColor);

        // Add some text to the image
        $textColor = imagecolorallocate($image, 255, 255, 255);
        $text = "No Image";
        $font = 5;
        $textWidth = imagefontwidth($font) * strlen($text);
        $textHeight = imagefontheight($font);
        $x = ($imageWidth - $textWidth) / 2;
        $y = ($imageHeight - $textHeight) / 2;
        imagestring(
            $image,
            $font,
            $x,
            $y,
            $text,
            $textColor);

        // Output the image
        header('Content-Type: image/png');
        imagepng($image);
        imagedestroy($image);
    }

}
