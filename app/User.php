<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','person_id','type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function canManageBlogEtcPosts()
    {
        // Enter the logic needed for your app.
        // Maybe you can just hardcode in a user id that you
        //   know is always an admin ID?
        if ($this->type === 'root')
        {
           return true;
           // return true so this user CAN edit/post/delete
           // blog posts (and post any HTML/JS)
        }
        // otherwise return false, so they have no access
        // to the admin panel (but can still view posts)
        return false;
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function is_admin()
    {
        return ($this->type == 'root')?true:false;
    }
}
