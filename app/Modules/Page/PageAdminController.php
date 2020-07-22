<?php

namespace App\Modules\Page;




use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

class PageAdminController extends AdminController {

	public function index(){
		return response()->json([
			'type' => 'script',
			'src' => '/app/Modules/Page/dist/ModulePageList.umd.min.js',
			'data' => [
				'items' => []
			]
		]);
	}

	public function edit(){
		return response()->json([
			'type' => 'script',
			'src' => '/app/Modules/Page/dist/ModulePageEdit.umd.min.js',
			'data' => [
				'item' => Page::find( \Request::query('id', 0) ) ?? new Page(),
			]
		]);
	}

	public function getParents(){
		return response()->json([
			'parents' => Page::with('children:id,parent_id,name')->select(['id', 'name'])->where('parent_id', 0)->get()
		]);
	}

	public function save(Request $request){


		if($request->hasFile('file')){
			$img = uniqid() . '.' . $request->file('file')->extension();
			$request->file('file')->move(base_path('assets/pages/'), $img);
			$request->merge(['image' => $img]);
		}


		$request->validate([
			'name' => 'required|min:3',
			'alias' => 'required|unique:pages,alias,' . $request->post('id')
		]);

		$page = Page::updateOrCreate(['id' => $request->post('id')], $request->post());

		return response()->json(['item' => $page]);
	}

}