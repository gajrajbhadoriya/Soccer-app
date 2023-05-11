<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    // We want to insert all columns values $guarded = [];
    protected $guarded = [];

    public function players()
    {
        // Eloquent: Relationships -> hasMany used to create the relation between two tables
        return $this->hasMany(Player::class);
    }
}
