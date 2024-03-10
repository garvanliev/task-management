<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $task_status = TaskStatus::get();
        $admin_users = User::where('role','admin')->get();

        return view('dashboard',['statuses'=>$task_status,'users'=>$admin_users]);
    }
}
