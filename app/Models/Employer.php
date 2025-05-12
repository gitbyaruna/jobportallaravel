<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Foreign key to User
        'position',
        'company_name',
        'department',
        'location',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }
}
