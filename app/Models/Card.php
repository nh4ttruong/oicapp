<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\GeneratesUuid;
use Spatie\Permission\Traits\HasRoles;

class Card extends Model
{
    use GeneratesUuid;
    use HasRoles;
    use HasFactory;

    protected $fillable = [
        'uuid',
        'card',
        'name',
        'description',
        'x',
        'y',
        'color_name',
        'color_introduction',
        'color_location',
        'color_time',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
