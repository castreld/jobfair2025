<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'name', 'minimum_education'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function majors()
    {
        return $this->belongsToMany(Major::class);
    }
}