<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Article;
use App\Category;

class SiteController extends Controller
{
    //


    public function showIndex()
    {
        //

        return view('site/show-index');
    }








    //Приклади коду з уроків
    //==========================================================================================
    /*protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function showContact()
    {
        print_r($this->request->all());

        return view('site/show-contact', [
            'userName' => $this->getUserName(),
            'pageName' => 'Contact us',
            'message' => 'With this form you can contact us'
        ]);
    }*/
/*
    public function showShow(Request $request)
    {
        //print_r($request->all());

        $categories = DB::select('SELECT * FROM `tbl_categories` WHERE id=?', [
            2
        ]);
        $categories = DB::select('SELECT * FROM `tbl_categories` WHERE id= :id', [
            'id' => 2
        ]);

        //$categories = DB::table('categories')->get(); // всі записи ТБ
        //$categories = DB::table('categories')->first(); // перший запис ТБ
        //$name_categories = DB::table('categories')->value('name'); // значення вказаного поля першого запису

        DB::table('categories')->orderBy('id')->chunk(2, function($categories) {

            echo '<br/>=======================================================';
            foreach($categories as $category) {
                echo '<br/>Name => ' . $category->name . ', Description => ' . $category->description;
            }
        });// витягнення записів по частинам. Перший параметр це кількість записів за частину

        //$categories = DB::table('categories')->pluck('description', 'name');
        //$categories = DB::table('categories')->count();
        //$categories = DB::table('categories')->max('id');

        $result = DB::table('categories')->insertGetId([
            'name' => 'Test1',
            'description' => 'Test description',
        ]);


        //echo '<p>Row = ' . $name_categories . '</p>';
        //dump($categories);
        //dump($result);


        //=====================================================================
        Article::create([
            'category_id' => 1,
            'title' => 'Test record',
            'content' => 'Description test record',
            'preview_img' => '',
            'preview_text' => 'test',
            'view_count' => rand(0, 1456),
            'like_count' => rand(0, 1456),
            'published_at' => null,
            'status' => rand(1, 4),
        ]);// додає новий запис. Дані записують в поля, які об'явлені масового присвоєння

        $articles = DB::table('articles')->get();


        Category::create([
            'name' => 'Test1',
            'description' => 'Articles about sport',
        ]);

        $categories = DB::table('categories')->get();

        //========================================
        //$articles = Article::all();


        $category = Category::firstOrCreate([
            'name' => 'Holidays',
            'description' => 'Articles about holidays',
        ]);//додає запис, якщо в базі даних немає запису, в якому перше поле не співпадує із вказаним
        //значення, тобто якщо немає запису з 'name' => 'Sport'. Вказані нові дані записує в БД

        $category = Category::firstOrNew([
            'name' => 'Holidays',
            'description' => 'Articles about holidays',
        ]);//створює модель з вказаними параметрами, якщо запису з першим параметром не знайдено,
        // у іншому випадку повертає знайдений запис. Вона не записує дані в БД
        $category->save();

        /*$category = Category::find(1);
        $category->delete();

        Category::destroy([1,3,4]);//видалить записи із вказаними id
        Category::where('id', '>', 3)->destroy();//видалить всі записи по вказаній умові

        //========================================================================

        //$categories = Category::all();

        //Article::destroy(13);
        //$articles = Article::withTrashed()->get();//витягне усі записи( записи мягко видалення таккож)
        //Article::destroy([10, 12, 13]);
        //$articles = Article::onlyTrashed()->get();//вивід записі, видалених методом мягко видалення записів
        //$articles = Article::withTrashed()->restore();//витягне усі записи( записи мягко видалення таккож),
        //відновить видалені методом мягко видалення записи та поверне кількість усіх записів

       foreach($articles as $article) {
            if($article->trashed()) {
                echo 'Article with title "' . $article->name . '" -- trashed <br/>';
                //$article->restore();//відновлює запис після мягкого видалення
            } else {
                echo 'Article with title "' . $article->name . '" -- not trashed <br/>';
            }

        //$article = Article::find(13);
        //$article->forceDelete();//видаляє остаточно запис, якщо ТБ підключено до механізму
        //мягкого видалення
        //dump($articles);

        return view('site/show-contact', [
            'userName' => $this->getUserName(),
            'pageName' => 'Contact us',
            'message' => 'With this form you can contact us'
        ]);
    }*/
}
