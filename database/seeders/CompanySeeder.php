<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // division 1 = Corporate
        // division 2 = Factory
        // division 3 = Fabric 
        //1
        Company::create([
            'division_id' => 1,
            'name' => 'Common Office'
        ]);
        //2
        Company::create([
            'division_id' => 2,
            'name' => 'TIL'
        ]);

        //3
        Company::create([
            'division_id' => 2,
            'name' => 'FAL'
        ]);
        //4
        Company::create([
            'division_id' => 2,
            'name' => 'NCL'
        ]);
        //5
        Company::create([
            'division_id' => 3,
            'name' => 'TIL'
        ]);
        //6
        Company::create([
            'division_id' => 3,
            'name' => 'NCL'
        ]);
       
    }
}
