<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $type
 * @property int $ischecked
 * @property int $isgroup
 * @property int|null $related
 * @property string|null $wikidata
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rssfeed> $feeds
 * @property-read int|null $feeds_count
 * @method static \Illuminate\Database\Eloquent\Builder|Entity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereIschecked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereIsgroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereRelated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereWikidata($value)
 */
	class Entity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EntityRssfeed
 *
 * @property int $id
 * @property int $entity_id
 * @property int $rssfeed_id
 * @property int $start
 * @property int $end
 * @property int|null $source 0 - category
 * 1 - title
 * 2 - description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EntityRssfeed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityRssfeed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityRssfeed query()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityRssfeed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityRssfeed whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityRssfeed whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityRssfeed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityRssfeed whereRssfeedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityRssfeed whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityRssfeed whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityRssfeed whereUpdatedAt($value)
 */
	class EntityRssfeed extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Rssfeed
 *
 * @property int $id
 * @property string $source
 * @property string $category
 * @property int $groupa
 * @property string $title
 * @property string $link
 * @property string $img
 * @property string $description
 * @property string|null $description_test
 * @property string $guid
 * @property string $pubDate
 * @property string $timestamp
 * @property string $content
 * @property string|null $tagged_at
 * @property string $lang
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Entity> $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed whereDescriptionTest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed whereGroupa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed whereGuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed wherePubDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed whereTaggedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed whereTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rssfeed whereUpdatedAt($value)
 */
	class Rssfeed extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SavedSearch
 *
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|SavedSearch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SavedSearch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SavedSearch query()
 */
	class SavedSearch extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

