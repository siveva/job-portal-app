<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'location',
        'salary',
        'job_type',
        'requirements',
        'deadline',
        'education',
        'yrOfexp',
        'eligibility'
    ];

    protected $casts = [
        'deadline'  =>  'datetime'
    ];
    
    public function employer()
    {
        return $this->belongsTo(User::class,'employer_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function categories()
    {
        // return $this->belongsToMany(Category::class, 'category_job_listings');
        return $this->belongsToMany(Category::class, 'category_job_listings')->withTimestamps();

    }
    
}
