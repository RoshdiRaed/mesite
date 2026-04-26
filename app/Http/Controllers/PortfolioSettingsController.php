<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use Illuminate\Http\Request;

class PortfolioSettingsController extends Controller
{
    // Settings
    public function hero()
    {
        $settings = Setting::pluck('value', 'key');
        return view('dashboard.portfolio.hero', compact('settings'));
    }

    public function about()
    {
        $settings = Setting::pluck('value', 'key');
        return view('dashboard.portfolio.about', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $data = $request->except('_token');
        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }
        return back()->with('success', 'Settings updated successfully.');
    }

    // Skills
    public function skills()
    {
        $skills = Skill::all()->groupBy('group');
        return view('dashboard.portfolio.skills', compact('skills'));
    }

    public function addSkill(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'group' => 'required|string|max:255',
        ]);
        Skill::create($request->all());
        return back()->with('success', 'Skill added.');
    }

    public function updateSkill(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'group' => 'required|string|max:255',
        ]);
        $skill->update($request->all());
        return back()->with('success', 'Skill updated.');
    }

    public function deleteSkill(Skill $skill)
    {
        $skill->delete();
        return back()->with('success', 'Skill removed.');
    }

    // Projects
    public function projects()
    {
        $projects = Project::orderBy('order')->get();
        return view('dashboard.portfolio.projects', compact('projects'));
    }

    public function addProject(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stack' => 'required|string|max:255',
            'url' => 'nullable|url',
        ]);
        $order = Project::max('order') + 1;
        Project::create(array_merge($request->all(), ['order' => $order]));
        return back()->with('success', 'Project added.');
    }

    public function updateProject(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stack' => 'required|string|max:255',
            'url' => 'nullable|url',
        ]);
        $project->update($request->all());
        return back()->with('success', 'Project updated.');
    }

    public function deleteProject(Project $project)
    {
        $project->delete();
        return back()->with('success', 'Project removed.');
    }

    // Library
    public function library()
    {
        $books = Book::all()->groupBy('status');
        return view('dashboard.portfolio.library', compact('books'));
    }

    public function addBook(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'status' => 'required|in:reading,read,want',
            'progress' => 'nullable|integer|min:0|max:100',
        ]);
        Book::create($request->all());
        return back()->with('success', 'Book added.');
    }

    public function updateBook(Request $request, Book $book)
    {
        $book->update($request->only('progress', 'status'));
        return back()->with('success', 'Book updated.');
    }

    public function deleteBook(Book $book)
    {
        $book->delete();
        return back()->with('success', 'Book removed.');
    }
}
