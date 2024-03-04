<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['job_seeker_id', 'job_listing_id', 'cover_letter', 'resume', 'status', 'education', 'yrOfexp', 'shortlisted'];

    public function jobSeeker()
    {
        return $this->belongsTo(User::class,'job_seeker_id','id');
    }

     public function jobListing()
    {
        return $this->belongsTo(JobListing::class);
    }

    public function seeker()
    {
        return $this->belongsTo(JobSeeker::class,'job_seeker_id','user_id');
    }
    
}
