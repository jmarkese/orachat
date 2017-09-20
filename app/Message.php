<?php

namespace App;

use App\AppSession;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AppMessage
 * @package App
 */
class AppMessage extends Model
{
    /**
     * Message is the only mass assignable attribute.
     * @var array
     */
    protected $fillable = ['message'];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['created_at', 'message'];

    /**
     * An app message belongs to an app session
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
