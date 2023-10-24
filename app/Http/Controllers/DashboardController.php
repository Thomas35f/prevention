<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Models\Company;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function create()
    {
        $companies = Company::all();
        $lessons = Lesson::all();

        return view('dashboard')->with([
            'companies' => $companies,
            'lessons' => $lessons
        ]);
    }
}
