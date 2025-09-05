<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;
class ArticleController extends Controller
{
     public function index()
    {
        $articles = Article::with('author')->latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(StoreArticleRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;
            $data['meta_title'] = $request->input('meta_title');
            $data['meta_description'] = $request->input('meta_description');


            if ($request->hasFile('image')) {
                $data['image_path'] = $request->file('image')->store('articles', 'public');
            }

            $data['is_published'] = (bool) $request->boolean('is_published');

            Article::create($data);

            return redirect()->route('admin.articles.index')->with('success','Article created successfully.');
        } catch (Throwable $e) {
            Log::error('Article store failed: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->withErrors('Something went wrong. Please try again.')->withInput();
        }
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id ?? $article->user_id;
            $data['meta_title'] = $request->input('meta_title');
            $data['meta_description'] = $request->input('meta_description');

            if ($request->hasFile('image')) {
                if ($article->image_path) Storage::disk('public')->delete($article->image_path);
                $data['image_path'] = $request->file('image')->store('articles', 'public');
            }

            $data['is_published'] = (bool) $request->boolean('is_published');

            $article->update($data);

            return redirect()->route('admin.articles.index')->with('success','Article updated successfully.');
        } catch (Throwable $e) {
            Log::error('Article update failed: '.$e->getMessage());
            return back()->withErrors('Update failed.')->withInput();
        }
    }

    // public function destroy(Article $article)
    // {
    //     try {
    //         if ($article->image_path) Storage::disk('public')->delete($article->image_path);
    //         $article->delete();
    //         return redirect()->route('admin.articles.index')->with('success','Article deleted.');
    //     } catch (Throwable $e) {
    //         Log::error('Article delete failed: '.$e->getMessage());
    //         return back()->withErrors('Delete failed.');
    //     }
    // }


  

    public function destroy(Article $article)
    {
        try {
            // soft delete (image ko abhi mat delete karen; forceDelete pe hi actual delete)
            $article->delete();
            return redirect()->route('admin.articles.index')->with('success','Article moved to Trash.');
        } catch (\Throwable $e) {
            \Log::error('Article soft delete failed: '.$e->getMessage());
            return back()->withErrors('Delete failed.');
        }
    }

    public function trash(Request $request)
    {
        $articles = Article::onlyTrashed()->latest('deleted_at')->paginate(10);
        return view('admin.articles.trash', compact('articles'));
    }

    public function restore($id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->restore();
        return redirect()->route('admin.articles.trash')->with('success','Article restored.');
    }

    public function forceDelete($id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);
        try {
            if ($article->image_path) \Storage::disk('public')->delete($article->image_path);
            $article->forceDelete();
            return redirect()->route('admin.articles.trash')->with('success','Article permanently deleted.');
        } catch (\Throwable $e) {
            \Log::error('Article force delete failed: '.$e->getMessage());
            return back()->withErrors('Permanent delete failed.');
        }
    }



}
