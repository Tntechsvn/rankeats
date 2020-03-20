<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

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
}
