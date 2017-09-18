<?php

namespace App;

use App\Session;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message'];

    public function appsession()
    {
        return $this->belongsTo(AppSession::class);
    }
}
