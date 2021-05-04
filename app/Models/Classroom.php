<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    //use HasFactory;
    protected $fillable = 
    [
        'user_id',
        'title',
        'description',
        'enter_code',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_classrooms');
    }
    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
