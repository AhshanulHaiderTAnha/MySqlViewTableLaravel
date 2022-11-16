<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ViewUserData;

class ViewUserDataController extends Controller
{
    public function index()
    {
        $users = ViewUserData::select("*") ->get()->toArray();
        dd($users);
    }
}
