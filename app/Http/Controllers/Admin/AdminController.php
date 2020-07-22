<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Config;
use View;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');


		$theme = Config::get('admin.theme');

		View::addNamespace('theme', base_path('app/themes/' . $theme));

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('theme::index');
    }
}
