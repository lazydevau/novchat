<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedSearch extends Model
{
    use HasFactory;

    protected $fillable = [
        'query', 'entities'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sendNotifications($feeds)
    {
        foreach ($this->users as $user) {
            $newFeeds = collect();
            foreach ($feeds as $feed) {
                // Check if the feed was not previously sent to the user
                if (!$user->feeds()->where('id', $feed->id)->exists()) {
                    $user->feeds()->attach($feed);
                    $newFeeds->push($feed);
                }
            }
            if ($newFeeds->isNotEmpty()) {
                $user->notify(new NewFeedMatch($this->query, $newFeeds));
            }
        }
    }

}
