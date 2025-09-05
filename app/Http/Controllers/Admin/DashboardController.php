<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'articles' => Article::count(),
            'published' => Article::where('is_published', true)->count(),
            'drafts' => Article::where('is_published', false)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
