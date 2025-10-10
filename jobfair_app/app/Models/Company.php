<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }

    public function positions()
    {
        return $this->hasMany(Position::class);
    }
}