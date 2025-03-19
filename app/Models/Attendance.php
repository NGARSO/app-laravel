<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['date', 'status', 'professor_id', 'course_id'];

    public function professor()
{
    return $this->belongsTo(User::class);
}

public function course()
{
    return $this->belongsTo(Course::class);
}

public function user()
{
    return $this->belongsTo(User::class, 'professor_id');
}

}
