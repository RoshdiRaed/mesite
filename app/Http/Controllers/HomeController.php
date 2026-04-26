<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');
        $skills = Skill::all()->groupBy('group');
        $projects = Project::orderBy('order')->get();
        $books = Book::all()->groupBy('status');

        return view('home', compact('settings', 'skills', 'projects', 'books'));
    }
}
