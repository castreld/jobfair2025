<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $company1 = Company::find(1);
        $company2 = Company::find(2);
        $company3 = Company::find(3);

        Position::create(['company_id' => $company1->id, 'name' => 'Backend Developer (Laravel)']);
        Position::create(['company_id' => $company1->id, 'name' => 'Frontend Developer (Vue)']);
        Position::create(['company_id' => $company2->id, 'name' => 'UI/UX Designer']);
        Position::create(['company_id' => $company2->id, 'name' => 'Graphic Designer']);
        Position::create(['company_id' => $company3->id, 'name' => 'Digital Marketing Specialist']);
        Position::create(['company_id' => $company3->id, 'name' => 'Mobile Developer (Flutter)']);
    }
}