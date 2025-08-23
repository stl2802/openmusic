<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bb;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin.index');
    }
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    public function bbs()
    {
        $bbs = BB::all();
        return view('admin.bbs',compact('bbs'));
    }
    public function logs()
    {
        $filePath = storage_path('logs\laravel.log');

        if (file_exists($filePath)) {
            return response()->download($filePath, 'laravel.log');
        } else {
            return response()->json(['error' => 'Лог-файл не найден'], 404);
        }
    }
}
