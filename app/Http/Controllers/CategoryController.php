<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Category;

class CategoryController extends Controller
{

    public function import()
    {
        try{
            //Fetch Category list from bizzbox removing test data.
            $data = DB::connection("sqlsrv")->SELECT("SELECT PK_mscItemCategory, itemgroup, description FROM dbo.mscItemCategory");

            foreach($data as $key => $val)
            {
                $categoryExist = DB::table('category') -> where('category_no', $val -> PK_mscItemCategory) -> first();

                if($categoryExist)
                { continue; }

                $category = new Category;
                $category -> category_no = $val -> PK_mscItemCategory;
                $category -> name = $val -> description;
                $category -> description = $val -> description;
                $category -> code = $val -> itemgroup;
                $category -> created_at = now();
                $category -> updated_at = now();
                $category -> save();
            }

            return response() -> json(['data' => 'Success'], 200);
        }catch(\Throwable $th){
            return response() -> json(['message' => $th -> getMessage()], 500);
        }
    }
}
