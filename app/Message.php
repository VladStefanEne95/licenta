<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message', 'user_recv_id', 'project'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
