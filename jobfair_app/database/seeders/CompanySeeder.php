<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::create(['name' => 'PT. Teknologi Maju']);
        Company::create(['name' => 'CV. Digital Kreatif']);
        Company::create(['name' => 'Startup Anak Bangsa']);
        Company::create(['name' => 'Google Indonesia']);
    }
}