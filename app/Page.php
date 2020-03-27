<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class Page extends Model
{
    use Sluggable,SluggableScopeHelpers;
    protected $fillable = ['slug'];

    public function sluggable():array
	{
		return [
			'slug' => [
				'source' => 'title'
			]
		];
	}
	public function update_page($request){
		if($this -> page_title != $request -> page_title){
			$this -> page_title = $request -> page_title;
			$this -> slug = SlugService::createSlug(Page::class, 'slug', $request -> page_title);
		}
		
		$this -> page_content = $request -> page_content;
		$this -> ordinarily = $this -> count() + 1;		
		$this -> save();
		return $this;
	}
}
