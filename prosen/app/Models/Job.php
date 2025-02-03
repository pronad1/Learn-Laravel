<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model{
    use HasFactory;
    protected $table='job_listing';

    protected $fillable = [ 'title','salary'];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}