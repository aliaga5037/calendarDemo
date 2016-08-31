<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    public function question()
    {
        return $this->belongsTo(User::class);
    }

}
