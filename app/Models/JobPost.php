<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'company_name',
        'department',
        'location',
        'employer_id', // Foreign key to Employer
    ];

    // public function employer()
    // {
    //     return $this->belongsTo(Employer::class);
    // }
    // public function candidates()
    // {
    //     return $this->hasMany(Candidate::class);
    // }
 /**
     * Get the employer that owns the job post.
     */
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
    

    /**
     * Get the candidates that applied for the job post.
     */
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
