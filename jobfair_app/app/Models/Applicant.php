<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'applicant_id',
        'full_name',
        'email',
        'phone_number',
        'address',
        'school_name',
        'major',
        'graduation_year',
        'last_education',
        'skills',
        'portfolio_link',
        'portfolio_file_path',
        'personal_summary',
        'photo_path', 
        'cv_path',    
        'zip_path',
        'company_id',
        'position_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}