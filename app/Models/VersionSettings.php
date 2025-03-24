<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VersionSettings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'software_name',
        'version_number',
        'release_date',
        'is_enabled',
        'is_visible',
        'change_log',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'release_time' => 'datetime:Y-m-d H:i:s',
        'is_enabled' => 'boolean',
        'is_visible' => 'boolean'
    ];

}
