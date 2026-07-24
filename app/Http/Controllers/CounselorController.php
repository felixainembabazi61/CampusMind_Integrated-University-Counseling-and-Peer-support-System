<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CounselorController extends Controller
{
    public function index()
    {
        // Fetch all users with the 'counselor' role
        $counselors = User::role('counselor')->get();
        return view('counselors.index', compact('counselors'));
    }
}