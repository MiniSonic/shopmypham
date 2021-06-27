<?php


namespace App\Http\Controllers;



use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index(){

        return view('admin.index');
    }

    public function getLienhe(){

        return DB::table('lienhe')->orderBy('id', 'desc')->limit(10)->get();
    }

}
