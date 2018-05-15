<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchStatistic extends Model
{
    protected $table = 'search_statistics';

	public function product() {
		return $this->belongsTo('App\Product');
	}

	public static function getRelatedKeyword($keyword, $product_id) {
		return SearchStatistic::whereKeywordAndProductId($keyword, $product_id)->first();
	}

	public static function getMostSearched($limit) {
		return SearchStatistic::orderBy('count', 'desc')->take($limit)->with('product')->get();
	}

}