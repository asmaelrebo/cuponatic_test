<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public $timestamps = false;

	public function search_statistics() {
		return $this->hasMany('App\SearchStatistic', 'product_id');
	}

	public static function findByKeyword($keyword, $limit) {
		$products = Product::where('title', 'like', "%$keyword%")
						->orWhere('description', 'like', "%$keyword%")
						->orWhere('tags', 'like', "%$keyword%")
						->take($limit)
						->get();
		return $products;
	}

	public static function getMostSearched($limit=20, $limit_related=5) {
		return Product::where('count_total', '>', 0)
				->with([ 'search_statistics' => function($query) use ($limit_related) {
					$query->orderBY('count', 'desc');
				}])
				->orderBy('count_total', 'desc')
				->take($limit)
				->get();
	}
}