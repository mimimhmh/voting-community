<?php

namespace App;

use App\Exceptions\CommunityLinkAlreadySubmitted;
use Illuminate\Database\Eloquent\Model;

class CommunityLink extends Model
{

    protected $fillable = ['channel_id', 'title', 'link'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator() {

        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel() {

        return $this->belongsTo(Channel::class);
    }


    public function user() {

        return $this->belongsTo(User::class);
    }

    /**
     * Links -> votes(community_link_id & user_id)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes() {

        return $this->hasMany(CommunityLinkVote::class, 'community_link_id');
    }

    /**
     * @param User $user
     * @return static
     */
    public static function from(User $user) {

        $link = new static();

        $link->user_id = $user->id;

        if ($user->isTrusted())
        {
            $link->approve();
        }

        return $link;
    }

    /**
     * @param $attributes
     * @throws CommunityLinkAlreadySubmitted
     * @return bool
     */
    public function contribute($attributes) {

        if ($existing = $this->hasAlreadyBeenSubmitted($attributes['link']))
        {
            $existing->touch();

            throw new CommunityLinkAlreadySubmitted;
            //return $caller->alertLinkAlreadySubmitted();
        }

        return $this->fill($attributes)->save();
    }

    /**
     * Mark the community link as approved.
     * @return $this
     */
    public function approve() {

        $this->approved = true;

        return $this;
    }

    /**
     * @param string $link
     * @return static
     */
    private function hasAlreadyBeenSubmitted($link) {

        return static::where('link', $link)->first();
    }

    /**
     * @param $queryBuilder
     * @param $channel
     * @return mixed
     */
    public function scopeForChannel($queryBuilder, $channel) {

        if ($channel->exists)
        {
            $queryBuilder = $queryBuilder->where('channel_id', $channel->id);
        }

        return $queryBuilder;

    }
}
