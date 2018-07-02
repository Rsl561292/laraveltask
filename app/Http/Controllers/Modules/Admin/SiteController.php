<?php

namespace App\Http\Controllers\Modules\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    //
    public function showIndex()
    {
        //

        return view('modules\admin\site\show-index');
    }
}
