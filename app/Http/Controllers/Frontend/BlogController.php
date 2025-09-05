<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
class BlogController extends Controller
{
   public function index(Request $request)
    {
        $articles = Article::query()
            ->with('author')
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(6);

        // For AJAX pagination return only the list partial
        if ($request->ajax()) {
            return view('frontend.blog._list', compact('articles'))->render();
        }

        return view('frontend.blog.index', compact('articles'));
    }

    public function show(string $slug)
    {
        $article = Article::with('author')->where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('frontend.blog.show', compact('article'));
    }
}
