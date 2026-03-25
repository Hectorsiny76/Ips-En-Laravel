<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Create our dummy data (In the future, this will be a database query like Student::latest()->take(5)->get())
        $recentStudents = [
            ['id' => 1, 'name' => 'Alice Johnson', 'grade' => '10th', 'status' => 'Active'],
            ['id' => 2, 'name' => 'Bob Smith', 'grade' => '11th', 'status' => 'Active'],
            ['id' => 3, 'name' => 'Charlie Davis', 'grade' => '9th', 'status' => 'Pending'],
        ];

        // 2. Return the view, and pass the data array to it
        // The key 'students' is the variable name we will use inside our Blade file
        return view('dashboard', [
            'students' => $recentStudents
        ]);
    }
}
