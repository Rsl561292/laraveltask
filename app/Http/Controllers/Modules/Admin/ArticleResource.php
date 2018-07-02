<?php

namespace App\Http\Controllers\Modules\admin;

use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Article;

class ArticleResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $articles = Article::with([
            'category',
            'user'
        ])
            ->orderBy('updated_at', 'desc')
            ->paginate(5);

        return view('modules/admin/article/index', [
            'articles' => $articles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $article = new Article();

        if(Gate::denies('create', $article)) {

            Session::flash('flash_message', [
                'type' => 'error',
                'message' => 'You not can create new article because you not have needed right.'
            ]);

            return redirect()->back();
        }

        $categories = Category::getListId();

        return view('modules/admin/article/create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        //

        $user = Auth::user();
        $article = new Article([
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
        ]);

        if(Gate::denies('create', $article)) {

            Session::flash('flash_message', [
                'type' => 'error',
                'message' => 'You not can create new article because you not have needed right.'
            ]);

            return redirect()->back();
        }

        if($article->status == Article::STATUS_ACTIVE) {

            $article->published_at = date('Y-m-d H:i:s');
        }

        if($user->articles()->save($article)) {

            Session::flash('flash_message', [
                'type' => 'success',
                'message' => 'You success saved article with title "' . $request->input('title') . '".'
            ]);

            return redirect()->route('articles.index');
        } else {
            Session::flash('flash_message', [
                'type' => 'error',
                'message' => 'Sorry but your article don\'t saved. Please try again.'
            ]);

            return redirect()->route('articles.create')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $article = Article::find($id);

        if(Gate::denies('update', $article)) {

            Session::flash('flash_message', [
                'type' => 'error',
                'message' => 'You not can edit this article because you not have needed right.'
            ]);

            return redirect()->back();
        }

        if(!empty($article)) {

            $categories = Category::getListId();

            return view('modules/admin/article/edit', [
                'article' => $article,
                'categories' => $categories,
            ]);

        }

        Session::flash('flash_message', [
            'type' => 'error',
            'message' => 'Sorry but the article don\'t may be edit. Record with id "' . $id . '" not found.'
        ]);

        return redirect()->route('articles.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        //
        $article = Article::find($id);

        if(Gate::denies('update', $article)) {

            Session::flash('flash_message', [
                'type' => 'error',
                'message' => 'You not can edit this article because you not have needed right.'
            ]);

            return redirect()->back();
        }

        if(!empty($article)) {

            if($article->status != $request->input('status') && $article->status == Article::STATUS_ACTIVE) {

                $article->published_at = date('Y-m-d H:i:s');
            }

            $article->category_id = $request->input('category_id');
            $article->title = $request->input('title');
            $article->content = $request->input('content');

            if($article->save()) {

                Session::flash('flash_message', [
                    'type' => 'success',
                    'message' => 'You success saved your changes article with title "' . $article->title . '".'
                ]);

                return redirect()->route('articles.index');
            } else {
                Session::flash('flash_message', [
                    'type' => 'error',
                    'message' => 'Sorry but your article don\'t saved. Please try again.'
                ]);

                return redirect()->route('articles.create')->withInput();
            }
        }

        Session::flash('flash_message', [
            'type' => 'error',
            'message' => 'Sorry but the article don\'t may be updated. Record with id "' . $id . '" not found.'
        ]);

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $article = Article::find($id);

        if(Gate::denies('delete', $article)) {

            Session::flash('flash_message', [
                'type' => 'error',
                'message' => 'You not can delete this article because you not have needed right.'
            ]);

            return redirect()->back()->withInput();
        }

        if(!empty($article)) {

            $name = $article->title;

            if($article->delete()) {

                Session::flash('flash_message', [
                    'type' => 'success',
                    'message' => 'You success deleted article with title "' . $name . '".'
                ]);
            } else {
                Session::flash('flash_message', [
                    'type' => 'error',
                    'message' => 'You don\'t deleted article with title "' . $name . '". There was a system error. Please again.'
                ]);
            }

        } else {
            Session::flash('flash_message', [
                'type' => 'error',
                'message' => 'Sorry but the article don\'t delete. Record with id "' . $id . '" not found.'
            ]);
        }

        return redirect()->route('articles.index');
    }
}
