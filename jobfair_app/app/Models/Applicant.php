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
        'full_name',
        'email',
        'phone_number',
        'address',
        'major',
        'graduation_year',
        'student_id_number',
        'skills',
        'portfolio_link',
        'personal_summary',
        'photo_path',
        'cv_path',
        'company_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}