<?php

namespace App\Models\Auth;

use App\Models\Traits\Uuid;
use Illuminate\Support\Str;
use Cog\Laravel\Ban\Traits\Bannable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\Auth\Traits\Scope\UserScope;
use App\Models\Auth\Traits\Method\UserMethod;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Auth\Traits\SendUserPasswordReset;
use App\Models\Auth\Traits\Attribute\UserAttribute;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Auth\Traits\Relationship\UserRelationship;
use App\Notifications\Frontend\Auth\UserNeedsPasswordReset;

/**
 * Class User.
 */
class User extends Authenticatable implements BannableContract
{
        use Bannable;
    use HasRoles,
        Notifiable,
        SendUserPasswordReset,
        SoftDeletes,
        UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope,
        Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'avatar_type',
        'avatar_location',
        'password',
        'password_changed_at',
        'active',
        'confirmation_code',
        'confirmed',
        'timezone',
        'last_login_at',
        'last_login_ip',
        'dob',
        'phone',
        'show_image',
        'fcm_token'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $dates = ['last_login_at', 'deleted_at'];

    /**
     * The dynamic attributes from mutators that should be returned with the user object.
     * @var array
     */
    protected $appends = ['full_name'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
        'confirmed' => 'boolean',
    ];

    protected $with = [
        'profile'
    ];

    /**
     * Required for the WebDevEtc\BlogEtc package.
     * Enter your own logic (e.g. if ($this->id === 1) to
     *   enable this user to be able to add/edit blog posts
     *
     * @return bool - true = they can edit / manage blog posts,
     *        false = they have no access to the blog admin panel
     */
    public function canManageBlogEtcPosts()
    {
        // Enter the logic needed for your app.
        // Maybe you can just hardcode in a user id that you
        //   know is always an admin ID?

        if ($this->id === 2 && $this->email === "executive@executive.com"
        ||$this->id === 1 && $this->email === "admin@admin.com"
        ||$this->id === 3729 && $this->email === "info@calgaryspeeddating.com" ||$this->id === 14009 && $this->email === "danyalawaan@gmail.com") {
            // return true so this user CAN edit/post/delete
            // blog posts (and post any HTML/JS)
            
            return true;
        }
        //$2y$10$UBzVcIZRX4YDZ96iYZ39KOqNqq140dLIcZ6.l32W0stDYaihWImmi

        // otherwise return false, so they have no access
        // to the admin panel (but can still view posts)

        return false;
    }

    public function createApiToken()
    {
        $token = Str::random(64);
        $this->api_token = $token;
        $this->save();
        return $token;
    }

    public function sendPasswordResetNotification($token)
    {

        $url = $token;

        $this->notify(new UserNeedsPasswordReset($url));
    }
}
