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
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $role
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\webradio\Article> $articles
 * @property-read int|null $articles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\webradio\Communique> $communiques
 * @property-read int|null $communiques_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models\webradio{
/**
 * 
 *
 * @property int $id
 * @property string $article_title
 * @property string $article_slug
 * @property bool $isOnline
 * @property string $article_principal_image
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $content
 * @property int|null $categorie_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\webradio\Blogfile> $blogfiles
 * @property-read int|null $blogfiles_count
 * @property-read \App\Models\webradio\Categorie|null $categorie
 * @property-read \App\Models\webradio\Categorie $user
 * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereArticlePrincipalImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereArticleSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereArticleTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCategorieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereIsOnline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUserId($value)
 */
	class Article extends \Eloquent {}
}

namespace App\Models\webradio{
/**
 * 
 *
 * @property int $id
 * @property string $path
 * @property int $article_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\webradio\Article $article
 * @method static \Illuminate\Database\Eloquent\Builder|Blogfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blogfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blogfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Blogfile whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blogfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blogfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blogfile wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blogfile whereUpdatedAt($value)
 */
	class Blogfile extends \Eloquent {}
}

namespace App\Models\webradio{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\webradio\Article> $articles
 * @property-read int|null $articles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie query()
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie whereUpdatedAt($value)
 */
	class Categorie extends \Eloquent {}
}

namespace App\Models\webradio{
/**
 * 
 *
 * @property int $id
 * @property string|null $communique_email
 * @property string $communique_tel
 * @property string $communique_details
 * @property bool $isPaid
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $price
 * @property string $communique_status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\webradio\Programme> $programmes
 * @property-read int|null $programmes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\webradio\Servicefile> $servicefiles
 * @property-read int|null $servicefiles_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Communique newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Communique newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Communique query()
 * @method static \Illuminate\Database\Eloquent\Builder|Communique whereCommuniqueDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Communique whereCommuniqueEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Communique whereCommuniqueStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Communique whereCommuniqueTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Communique whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Communique whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Communique whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Communique wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Communique whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Communique whereUserId($value)
 */
	class Communique extends \Eloquent {}
}

namespace App\Models\webradio{
/**
 * 
 *
 * @property int $id
 * @property int|null $communique_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $programme_date
 * @property string $programme_hour
 * @property-read \App\Models\webradio\Communique|null $communique
 * @method static \Illuminate\Database\Eloquent\Builder|Programme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Programme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Programme query()
 * @method static \Illuminate\Database\Eloquent\Builder|Programme whereCommuniqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Programme whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Programme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Programme whereProgrammeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Programme whereProgrammeHour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Programme whereUpdatedAt($value)
 */
	class Programme extends \Eloquent {}
}

namespace App\Models\webradio{
/**
 * 
 *
 * @property int $id
 * @property string $path
 * @property int|null $communique_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\webradio\Communique|null $communique
 * @method static \Illuminate\Database\Eloquent\Builder|Servicefile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Servicefile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Servicefile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Servicefile whereCommuniqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Servicefile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Servicefile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Servicefile wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Servicefile whereUpdatedAt($value)
 */
	class Servicefile extends \Eloquent {}
}

