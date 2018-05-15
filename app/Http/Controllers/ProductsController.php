<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Product;
use App\SearchStatistic;

class ProductsController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
	//
	}

	//
	public function search(Request $request){
		if (!$request->isMethod('post'))
			return response()->json(['error' => 'Unauthorized'], 401, ['X-Header-One' => 'Not Allowed']);

		$keyword = strtolower($request->input('keyword'));
		if($keyword=="")
			return response()->json(['error' => 'Ingresar palabra a buscar'], 500, ['X-Header-One' => 'Require Params']);

		$results = Product::findByKeyword($keyword, 50);
		if(!empty($results)) {
			// Save search keyword
			foreach ($results as $key => $result) {
				// Get KeywordRelated
				$relatedKeyword = SearchStatistic::getRelatedKeyword($keyword, $result->id);
				// if empty create
				if(empty($relatedKeyword)) {
					$searchStatistics = new SearchStatistic;
					$searchStatistics->product_id = $result->id;
					$searchStatistics->keyword = $keyword;
					$searchStatistics->count = 1;
					$searchStatistics->save();
				}else{
					$relatedKeyword->count = $relatedKeyword->count+1;
					$relatedKeyword->save();
				}
				$result->count_total = $result->count_total+1;
				$result->save();
			}
		}

		return response()
		->json(array('status' => 200, 'data' => $results))
		->setCallback($request->input('callback'));
	}

	public function productsStatistics(){
		$most_searched = Product::getMostSearched(20);
		$params = [
			'most_searched' => $most_searched
		];
		return view('products.statictis')->with($params);
	}
}
