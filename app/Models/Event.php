<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\GeneratesUuid;
use Spatie\Permission\Traits\HasRoles;


class Event extends Model
{
    use GeneratesUuid;
    use HasRoles;
    use HasFactory, SoftDeletes;

    protected $table = 'events';
    public $timestamps = true;

    protected $dates = [
        'start_time',
        'end_time'
    ];

    protected $fillable = [
        'uuid',
        'name',
        'host_id',
        'introduction',
        'location',
        'code',
        'image',
        'start_time'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function host()
    {
        return $this->belongsTo(User::class);
    }
}
