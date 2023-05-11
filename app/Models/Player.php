<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    /**
     * We want to insert all columns values $guarded = [];
     */
    protected $guarded = [];
    /**
     * BelongsTo relationship in laravel is used to create the relation between two tables
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
