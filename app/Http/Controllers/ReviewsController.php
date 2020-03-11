<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Review;
use App\Myconst;
class ReviewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function getListReviews(Request $request){
		$keyword = $request -> keyword ? $request -> keyword : '';
        $list_reviews = Review::select('reviews.*')
        /*->where(function($query) use ($keyword){            
            $query->where('name', 'LIKE', '%'.$keyword.'%')->orwhere('name', 'LIKE', '%'.$keyword.'%');
        })*/
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  Review::select('reviews.*')->count();
        $count_record = count($list_reviews);

        if(isset($request -> page)){
            if($request -> page < 2){
                $start = 1;             
                $record = $count_record;
            }else{
                $start = ($request -> page * Myconst::PAGINATE_ADMIN - Myconst::PAGINATE_ADMIN) + 1;
                $record = ($request -> page * Myconst::PAGINATE_ADMIN - Myconst::PAGINATE_ADMIN) + $count_record;
            }
        }else{
            $start = 1;
            $record = $count_record;
        }

        return view('admin.reviews.getListReviews', compact('start', 'record', 'total_record','list_reviews','keyword'));
	}
}
