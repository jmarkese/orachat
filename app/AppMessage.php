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
     * An app message belongs to an app session
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function appsession()
    {
        return $this->belongsTo(AppSession::class);
    }
}
