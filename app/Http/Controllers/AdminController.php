<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function admin()
    {
        return view('pages.admin.⚡dashboard')->layout('layouts.admin');
    }
}
