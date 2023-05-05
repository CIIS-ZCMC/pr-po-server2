<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Department;

class DepartmentController extends Controller
{

    public function import()
    {
        try{
            $data = DB::connection("sqlsrv")->SELECT("SELECT PK_mscWarehouse, description, shortname FROM dbo.mscWarehouse");

            foreach($data as $key => $val)
            {
                $isDepartmentExist = DB::table('department') -> where('PK_warehouse', $val -> PK_mscWarehouse) -> first();

                if($isDepartmentExist)
                { continue; }

                $department = new Department;
                $department -> PK_warehouse = $val -> PK_mscWarehouse;
                $department -> name = $val -> description;
                $department -> abbreviation = $val -> shortname;
                $department -> created_at = now();
                $department -> updated_at = now();
                $department -> save();
            }

            return response() -> json(['data' => 'success'], 200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()], 200);
        }
    }
}
