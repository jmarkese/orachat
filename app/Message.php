<?php

namespace App;

use App\Session;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message'];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
