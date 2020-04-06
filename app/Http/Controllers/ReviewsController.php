<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Review;
use App\Myconst;
use App\Business;
use App\Review_rating;
use View;
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
    public function postReviewFrontEnd(Request $request){
        // dd($request->toArray());
        $user_id = Auth::user()->id;
        $reviews = new Review;        
        $response = $reviews -> update_review($request,$user_id);
        $data = $response->getData();
        $info_business = Business::findOrfail($request -> business_id);
        $list_reviews = $info_business->review_rating()->where('type_rate','=',1)->paginate(Myconst::PAGINATE_ADMIN);
        if($data->success){
            session()->put('success',$data->message);
            $response = "";
            $view = View::make('layouts.ajax_business_review', ['list_reviews' => $list_reviews]);
            $response .= (string) $view;
            $message = 'You have voted and successfully evaluated';
            // return redirect()->back();
            return response()->json([
                'success' => true,
                'data' => $response,
                'message' =>  $message
            ]);
        }else{
            session()->put('error',$data->message);
            return redirect()->back();
        }
    }
}
