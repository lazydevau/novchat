<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rssfeed extends Model
{

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'rssfeeds';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
     protected $hidden = ['pivot'];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function tags()
    {
        return $this->belongsToMany(
            Entity::class,
        );
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeWithEntities($query, $entityIds)
    {
        return $query->whereHas('tags', function($q) use ($entityIds) {
            $q->whereIn('entity_id', $entityIds);
        }, '>=', count($entityIds));
    }
    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
