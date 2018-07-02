<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Article;

class ArticleController extends Controller
{
    //
    public function showAll()
    {
        //
        $articles = Article::with([
            'user',
            'category'
        ])
            ->where('status', Article::STATUS_ACTIVE)
            ->orderBy('published_at', 'desc')
            ->get()
            ->toArray();

        $categories = Category::getListSlug();

        return view('article/show-all', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }

    public function showArticleOnCategory($category_slug)
    {
        //
        $articles = [];
        $category = Category::where('slug', $category_slug)->first();

        if(!empty($category)) {

            $articles = Article::with([
                'user',
                'category'
            ])
                ->where('category_id', $category->id)
                ->orderBy('published_at', 'desc')
                ->get()
                ->toArray();
        }

        $categories = Category::getListSlug();

        return view('article/show-all', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }

    public function showOne($id)
    {
        //
        $article = Article::with([
            'user'
        ])->find($id);

        $categories = Category::getListSlug();

        return view('article/show-one', [
            'article' => $article,
            'categories' => $categories,
        ]);
    }
}
