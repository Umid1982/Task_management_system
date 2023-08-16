<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory;
    protected $fillable =[
      'name',
      'user_id'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_users','team_id','user_id');
    }

    public function user_team()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
