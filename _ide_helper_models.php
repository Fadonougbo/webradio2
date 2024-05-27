<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $periode_date
 * @property string $periode_hour
 * @property int $publicite_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Publicite $publicite
 * @method static \Illuminate\Database\Eloquent\Builder|Periode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Periode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Periode query()
 * @method static \Illuminate\Database\Eloquent\Builder|Periode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Periode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Periode wherePeriodeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Periode wherePeriodeHour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Periode wherePubliciteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Periode whereUpdatedAt($value)
 */
	class Periode extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $pub_email
 * @property string $pub_tel
 * @property string $pub_file
 * @property string|null $pub_detail
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $isPaid
 * @property int|null $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Periode> $periodes
 * @property-read int|null $periodes_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Publicite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Publicite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Publicite query()
 * @method static \Illuminate\Database\Eloquent\Builder|Publicite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Publicite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Publicite whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Publicite wherePubDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Publicite wherePubEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Publicite wherePubFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Publicite wherePubTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Publicite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Publicite whereUserId($value)
 */
	class Publicite extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $price
 * @method static \Illuminate\Database\Eloquent\Builder|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereUpdatedAt($value)
 */
	class Service extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Publicite> $publicites
 * @property-read int|null $publicites_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

