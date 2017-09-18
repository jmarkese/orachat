<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AppSession
 * @package App
 */
class AppSession extends Model
{
    /**
     * No mass assignable attributes on the app session.
     * @var array
     */
    protected $fillable = [];

    /**
     * A session has many app messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appmessages()
    {
        return $this->hasmany(AppMessage::class);
    }

    /**
     * Override the Eloquent Model. Save a new model to the database with a random uid string.
     *
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        if (empty($this->uid)) {
            $this->uid = $this->uid ?: openssl_random_pseudo_bytes(6);
        }
        return parent::save($options);
    }
}
