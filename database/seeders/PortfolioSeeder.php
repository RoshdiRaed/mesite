<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // Settings
        Setting::set('about_text', "I'm a Laravel developer with a deep appreciation for clean architecture, meaningful abstractions, and code that reads like prose. I believe the backbone of every product is a robust backend.\n\nWhen I'm not designing systems and writing PHP, I'm usually in the middle of a book. I treat reading and programming with the same discipline: always improving, always questioning defaults.\n\nMy work philosophy: simplicity is the hardest thing to build.");
        Setting::set('location', 'West Bank, Palestine 🇵🇸');
        Setting::set('primary_stack', 'Laravel + Alpine.js + Livewire');
        Setting::set('experience', '4+ years shipping products');
        Setting::set('status', 'Building & open to opportunities');
        Setting::set('languages', 'Arabic · English');
        Setting::set('github_url', 'https://github.com/');
        Setting::set('linkedin_url', 'https://linkedin.com/');
        Setting::set('contact_email', 'hello@example.com');
        Setting::set('hero_title', 'Roshdi');
        Setting::set('hero_subtitle', 'Developer');
        Setting::set('hero_description', 'I build robust, elegant backends with Laravel and craft seamless APIs. Based in the West Bank — writing code, reading books, thinking deeply.');

        // Skills
        $skills = [
            ['name' => 'Laravel', 'group' => 'Backend'],
            ['name' => 'PHP 8.x', 'group' => 'Backend'],
            ['name' => 'Livewire', 'group' => 'Backend'],
            ['name' => 'Eloquent ORM', 'group' => 'Backend'],
            ['name' => 'REST APIs', 'group' => 'Backend'],
            ['name' => 'Queue & Jobs', 'group' => 'Backend'],
            ['name' => 'Events & Listeners', 'group' => 'Backend'],
            ['name' => 'Artisan CLI', 'group' => 'Backend'],
            ['name' => 'Alpine.js', 'group' => 'Frontend'],
            ['name' => 'Blade', 'group' => 'Frontend'],
            ['name' => 'Tailwind CSS', 'group' => 'Frontend'],
            ['name' => 'Inertia.js', 'group' => 'Frontend'],
            ['name' => 'Vite', 'group' => 'Frontend'],
            ['name' => 'Vue.js', 'group' => 'Frontend'],
            ['name' => 'MySQL', 'group' => 'Database & Infra'],
            ['name' => 'PostgreSQL', 'group' => 'Database & Infra'],
            ['name' => 'Redis', 'group' => 'Database & Infra'],
            ['name' => 'Docker', 'group' => 'Database & Infra'],
            ['name' => 'Linux', 'group' => 'Database & Infra'],
            ['name' => 'Nginx', 'group' => 'Database & Infra'],
            ['name' => 'GitHub Actions', 'group' => 'Database & Infra'],
            ['name' => 'Forge', 'group' => 'Database & Infra'],
            ['name' => 'SOLID', 'group' => 'Principles'],
            ['name' => 'DDD', 'group' => 'Principles'],
            ['name' => 'TDD', 'group' => 'Principles'],
            ['name' => 'Clean Architecture', 'group' => 'Principles'],
            ['name' => 'API Design', 'group' => 'Principles'],
            ['name' => 'Code Review', 'group' => 'Principles'],
            ['name' => 'Documentation', 'group' => 'Principles'],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Projects
        $projects = [
            ['name' => 'Sanad — Project Management SaaS', 'stack' => 'Laravel · Livewire · Alpine · MySQL', 'url' => '#', 'order' => 1],
            ['name' => 'Noor — E-commerce Platform', 'stack' => 'Laravel · Inertia.js · Vue · Stripe', 'url' => '#', 'order' => 2],
            ['name' => 'Maktaba — Books API', 'stack' => 'Laravel · REST API · Redis · OpenLibrary', 'url' => '#', 'order' => 3],
            ['name' => 'Multitenant CMS Boilerplate', 'stack' => 'Laravel · Tenancy for Laravel · Forge', 'url' => '#', 'order' => 4],
            ['name' => 'Open Source: laravel-audit-trail', 'stack' => 'PHP Package · Packagist · 400+ installs', 'url' => '#', 'order' => 5],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        // Books
        $books = [
            ['title' => 'A Philosophy of Software Design', 'author' => 'John Ousterhout', 'status' => 'reading', 'progress' => 70],
            ['title' => 'The Pragmatic Programmer', 'author' => 'Hunt & Thomas', 'status' => 'reading', 'progress' => 45],
            ['title' => 'The Remains of the Day', 'author' => 'Kazuo Ishiguro', 'status' => 'reading', 'progress' => 30],
            ['title' => 'Clean Code', 'author' => 'Robert C. Martin', 'status' => 'read', 'progress' => 100],
            ['title' => 'Domain-Driven Design', 'author' => 'Eric Evans', 'status' => 'read', 'progress' => 100],
            ['title' => 'The Alchemist', 'author' => 'Paulo Coelho', 'status' => 'read', 'progress' => 100],
            ['title' => 'Refactoring', 'author' => 'Martin Fowler', 'status' => 'read', 'progress' => 100],
            ['title' => 'Laravel: Up & Running', 'author' => 'Matt Stauffer', 'status' => 'read', 'progress' => 100],
            ['title' => 'Sapiens', 'author' => 'Yuval Noah Harari', 'status' => 'read', 'progress' => 100],
            ['title' => 'Structure and Interpretation of Computer Programs', 'author' => 'Abelson & Sussman', 'status' => 'want', 'progress' => 0],
            ['title' => 'The Mythical Man-Month', 'author' => 'Fred Brooks', 'status' => 'want', 'progress' => 0],
            ['title' => 'Designing Data-Intensive Applications', 'author' => 'Martin Kleppmann', 'status' => 'want', 'progress' => 0],
            ['title' => 'Working in Public', 'author' => 'Nadia Eghbal', 'status' => 'want', 'progress' => 0],
            ['title' => 'The Art of Thinking Clearly', 'author' => 'Rolf Dobelli', 'status' => 'want', 'progress' => 0],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
