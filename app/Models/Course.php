<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'description', 'start_time', 'end_time', 'room_id'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
