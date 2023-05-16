<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //************************************************************

        // division 1 = Corporate => Company 1 = Common Office

        // division 2 = Factory => Company 2 = TIL // Company 3 = FAL 
        // Company 4 = NCL

        // division 3 = Fabric => Company 5 = TIL 
        // Company 6 = NCL

        //********************************************************************

        // Corporate Division =1
        Department::create([
            'company_id' => 1,
            'name' => 'Accounts - FAL'
        ]);
        Department::create([
            'company_id' => 1,
            'name' => 'Accounts - NCL'
        ]);
        Department::create([
            'company_id' => 1,
            'name' => 'Accounts - TIL'
        ]);
        Department::create([
            'company_id' => 1,
            'name' => 'Audit'
        ]);
        Department::create([
            'company_id' => 1,
            'name' => 'Commercial'
        ]);
        Department::create([
            'company_id' => 1,
            'name' => 'Compliance'
        ]);
        Department::create([
            'company_id' => 1,
            'name' => 'Corporate Affairs'
        ]);
        Department::create([
            'company_id' => 1,
            'name' => 'Cost Control'
        ]);
        Department::create([
            'company_id' => 1,
            'name' => 'Human Resource Management'
        ]);
        Department::create([
            'company_id' => 1,
            'name' => 'IT'
        ]);
        Department::create([
            'company_id' => 1,
            'name' => 'Legal Affairs'
        ]);
        Department::create([
            'company_id' => 1,
            'name' => 'Merchandising - FAL'
        ]);
        Department::create([
            'company_id' => 1,
            'name' => 'Merchandising - NCL'
        ]);
        Department::create([
            'company_id' => 1,
            'name' => 'Merchandising - TIL'
        ]);
        Department::create([
            'company_id' => 1,
            'name' => 'MIS'
        ]);
        Department::create([
            'company_id' => 1,
            'name' => 'Product Design'
        ]);
        Department::create([
            'company_id' => 1,
            'name' => 'Supply Chain Management'
        ]);
        //********************************************************************
        // Factory Division => Company 2 = TIL 
        Department::create([
            'company_id' => 2,
            'name' => 'Accounts'
        ]);
        Department::create([
            'company_id' => 2,
            'name' => 'CAD'
        ]);
        Department::create([
            'company_id' => 2,
            'name' => 'Compliance'
        ]);
        Department::create([
            'company_id' => 2,
            'name' => 'Cutting'
        ]);

        Department::create([
            'company_id' => 2,
            'name' => 'Finishing'
        ]);
        Department::create([
            'company_id' => 2,
            'name' => 'HR, Admin & Welfare'
        ]);
        Department::create([
            'company_id' => 2,
            'name' => 'IE'
        ]);
        Department::create([
            'company_id' => 2,
            'name' => 'IT & MIS'
        ]);
        Department::create([
            'company_id' => 2,
            'name' => 'Lab'
        ]);
        Department::create([
            'company_id' => 2,
            'name' => 'Maintenance'
        ]);
        Department::create([
            'company_id' => 2,
            'name' => 'MCD/ Store'
        ]);
        Department::create([
            'company_id' => 2,
            'name' => 'Planning'
        ]);
        Department::create([
            'company_id' => 2,
            'name' => 'Quality'
        ]);
        Department::create([
            'company_id' => 2,
            'name' => 'Sample'
        ]);
        Department::create([
            'company_id' => 2,
            'name' => 'Sewing'
        ]);

        //********************************************************************

        // Factory Division => Company 2 = FAL 
        Department::create([
            'company_id' => 3,
            'name' => 'Accounts'
        ]);
        Department::create([
            'company_id' => 3,
            'name' => 'CAD'
        ]);
        Department::create([
            'company_id' => 3,
            'name' => 'Compliance'
        ]);
        Department::create([
            'company_id' => 3,
            'name' => 'Cutting'
        ]);

        Department::create([
            'company_id' => 3,
            'name' => 'Fabric Merchandising'
        ]);

        Department::create([
            'company_id' => 3,
            'name' => 'Finishing'
        ]);
        Department::create([
            'company_id' => 3,
            'name' => 'HR, Admin & Welfare'
        ]);
        Department::create([
            'company_id' => 3,
            'name' => 'IE'
        ]);
        Department::create([
            'company_id' => 3,
            'name' => 'IT & MIS'
        ]);
        Department::create([
            'company_id' => 3,
            'name' => 'Lab'
        ]);
        Department::create([
            'company_id' => 3,
            'name' => 'Maintenance'
        ]);
        Department::create([
            'company_id' => 3,
            'name' => 'MCD/ Store'
        ]);
        Department::create([
            'company_id' => 3,
            'name' => 'Planning'
        ]);
        Department::create([
            'company_id' => 3,
            'name' => 'Quality'
        ]);
        Department::create([
            'company_id' => 3,
            'name' => 'Sample'
        ]);
        Department::create([
            'company_id' => 3,
            'name' => 'Sewing'
        ]);

        //********************************************************************
        // Factory Division => Company 4 = NCL
        //********************************************************************
        Department::create([
            'company_id' => 4,
            'name' => 'IE'
        ]);
        Department::create([
            'company_id' => 4,
            'name' => 'Planning'
        ]);
        Department::create([
            'company_id' => 4,
            'name' => 'Maintenance'
        ]);
        Department::create([
            'company_id' => 4,
            'name' => 'Cutting'
        ]);
        Department::create([
            'company_id' => 4,
            'name' => 'Audit'
        ]);
        Department::create([
            'company_id' => 4,
            'name' => 'Finishing'
        ]);
        Department::create([
            'company_id' => 4,
            'name' => 'IT & MIS'
        ]);
        Department::create([
            'company_id' => 4,
            'name' => 'Merchandising'
        ]);
        Department::create([
            'company_id' => 4,
            'name' => 'Production'
        ]);
        Department::create([
            'company_id' => 4,
            'name' => 'Quality'
        ]);
        Department::create([
            'company_id' => 4,
            'name' => 'Store'
        ]);
        Department::create([
            'company_id' => 4,
            'name' => 'Technical'
        ]);
        Department::create([
            'company_id' => 4,
            'name' => 'HR, Admin & Welfare'
        ]);
        Department::create([
            'company_id' => 4,
            'name' => 'Compliance'
        ]);


        //********************************************************************
        // Fabric Division => Company 5 = TIL
        //********************************************************************
        Department::create([
            'company_id' => 5,
            'name' => 'Accounts'
        ]);
        Department::create([
            'company_id' => 5,
            'name' => 'AOP'
        ]);
        Department::create([
            'company_id' => 5,
            'name' => 'Batch'
        ]);
        Department::create([
            'company_id' => 5,
            'name' => 'Circular knitting'
        ]);

        Department::create([
            'company_id' => 5,
            'name' => 'Dyeing'
        ]);
        Department::create([
            'company_id' => 5,
            'name' => 'Fabric Merchandiser'
        ]);
        Department::create([
            'company_id' => 5,
            'name' => 'Knitting'
        ]);
        Department::create([
            'company_id' => 5,
            'name' => 'Garments Wash'
        ]);
        Department::create([
            'company_id' => 5,
            'name' => 'IT & MIS'
        ]);
        Department::create([
            'company_id' => 5,
            'name' => 'Maintenance'
        ]);
        Department::create([
            'company_id' => 5,
            'name' => 'Mechanical Finishing'
        ]);
        Department::create([
            'company_id' => 5,
            'name' => 'Physical Lab'
        ]);
        Department::create([
            'company_id' => 5,
            'name' => 'Planning'
        ]);
        Department::create([
            'company_id' => 5,
            'name' => 'Pretreatment'
        ]);
        Department::create([
            'company_id' => 5,
            'name' => 'Quality'
        ]);
        Department::create([
            'company_id' => 5,
            'name' => 'Sample'
        ]);
        Department::create([
            'company_id' => 5,
            'name' => 'Store'
        ]);

        //********************************************************************
        // Fabric Division => Company 6 = NCL BSCIC
        //********************************************************************
        Department::create([
            'company_id' => 6,
            'name' => 'HR, Admin & Accounts'
        ]);
        Department::create([
            'company_id' => 6,
            'name' => 'Dyeing Finishing'
        ]);
        Department::create([
            'company_id' => 6,
            'name' => 'Dyeing'
        ]);
        Department::create([
            'company_id' => 6,
            'name' => 'knitting'
        ]);
        Department::create([
            'company_id' => 6,
            'name' => 'Labratory'
        ]);
    }
}
