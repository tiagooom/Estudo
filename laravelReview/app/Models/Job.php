<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model {

    use HasFactory;

    protected $table = 'job_listings';
    //protected $fillable = ['employer_id', 'title', 'salary'];
    protected $guarded = [];

    public function Employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, foreignPivotKey: "job_listing_id");
    }
}