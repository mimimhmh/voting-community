<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 */
class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * @return mixed
     */
    public function isTrusted() {

        return $this->trusted;
    }


    public function voteFor(CommunityLink $link) {

        return $link->votes()->create(['user_id' => $this->id]);
    }

    /**
     * see if the login user has voted for link.
     * @param CommunityLink $link
     * @return mixed
     */
    public function votedFor(CommunityLink $link) {

        return $link->votes->contains('user_id', $this->id);
    }

}
