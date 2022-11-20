<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $guarded = [];
    protected $hidden = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'expires_at',
        'last_used_at'
    ];
}
