<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommunityLinkVote extends Model
{
    //
    protected $fillable = ['user_id', 'community_link_id'];
}
