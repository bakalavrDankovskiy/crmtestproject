<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $hidden = [];
    protected $guarded = [];

    protected $casts = [
        'company' => 'array',
        'custom_fields_values' => 'array',
    ];

    protected $dateFormat = 'U';
}
