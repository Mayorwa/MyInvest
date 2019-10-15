<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class agentRelation extends Model
{
    protected $table = "agent_relations";
    //
    protected $fillable = [
        'userId', 'uplineId', 'isDefault',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *s
     * @var array
     */
    protected $hidden = [
        'updated_at',
    ];
}
