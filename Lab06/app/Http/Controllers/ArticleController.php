<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $results = Article::orderBy('created_at', 'desc')->take(15)->get();
        return response()->json($results);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request): JsonResponse
    {
        $article = new Article();
        $article->title = $request->input('title');
        $article->url = $request->input('url');
        $article->save();
        return response()->json($article);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        Article::where('id', $id)->increment('views');
        $article = Article::where('id', $id)->get();
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, $id): JsonResponse
    {
        $newTitle = $request->input('title');
        $newUrl = $request->input('url');
        Article::where('id', $id)->update(['title' => $newTitle, 'url' => $newUrl]);
        $article = Article::where('id', $id)->get();
        return response()->json($article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): void
    {
        Article::destroy($id);
    }
}
