<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = ['username'];

    /**
     * A user has many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasmany(Message::class);
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
            $this->username = 'user' . substr(uniqid(), -6);
        }
        return parent::save($options);
    }
}
