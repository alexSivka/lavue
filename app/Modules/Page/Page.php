<?php

namespace App\Modules\Page;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

	protected $table = 'pages';

	protected $fillable = [
		'active',
		'name',
		'alias',
		'text',
		'image'
	];

	protected $attributes = [
		'active' => 1,
		'name' => '',
		'alias' => '',
		'text' => ''
	];

	public function setTextAttribute($value){
		$this->attributes['text'] = $value ? $value : '';
	}

	public function children() {
		return $this->hasMany('App\Modules\Page\Page', 'parent_id', 'id');
	}
}