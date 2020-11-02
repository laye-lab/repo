<?php

namespace App\Http\Controllers;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use DB;
use Excel;

class ImportExcelController extends Controller
{
    function index()
    {
     $data = DB::table('tbl_customer')->orderBy('CustomerID', 'DESC')->get();
     return view('import_excel', compact('data'));
    }

    function import(Request $request)
    {
     $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);

     $data = Excel::import(new UsersImport, $request->file('select_file'));



     return back()->with('success', 'Excel Data Imported successfully.');
    }
}

