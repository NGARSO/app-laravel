<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['message', 'recipient_id', 'sent_at'];

    public function recipient()
{
    return $this->belongsTo(User::class);
}
}
