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

    public function getListBusinessReviews(Request $request){
		$keyword = $request -> keyword ? $request -> keyword : '';
        $list_reviews = Review::select('reviews.*','businesses.id','users.id','businesses.name as businesses_name','users.name as name_user','review_ratings.type_rate','review_ratings.review_id')
        ->join('review_ratings','review_ratings.review_id','=','reviews.id')
        ->join('businesses','reviews.business_id','=','businesses.id')
        ->join('users','reviews.user_id','=','users.id')
        ->where(function($query) use ($keyword){            
            $query->where('businesses.name', 'LIKE', '%'.$keyword.'%')->orwhere('users.name', 'LIKE', '%'.$keyword.'%');
        })
        ->where('review_ratings.type_rate','=',1)
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);
        $total_record =  $list_reviews->total();
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
        return view('admin.reviews.getListBusinessReviews', compact('start', 'record', 'total_record','list_reviews','keyword'));
	}
    public function getListEatReviews(Request $request){
        $keyword = $request -> keyword ? $request -> keyword : '';
        $list_reviews = Review::select('reviews.*','businesses.id','users.id','businesses.name as businesses_name','users.name as name_user','review_ratings.type_rate','review_ratings.review_id','review_ratings.category_id','categories.category_name')
        ->join('review_ratings','review_ratings.review_id','=','reviews.id')
        ->join('categories','categories.id','=','review_ratings.category_id')
        ->join('businesses','reviews.business_id','=','businesses.id')
        ->join('users','reviews.user_id','=','users.id')
        ->where(function($query) use ($keyword){            
            $query->where('businesses.name', 'LIKE', '%'.$keyword.'%')->orwhere('users.name', 'LIKE', '%'.$keyword.'%');
        })
        ->where('review_ratings.type_rate','=',2)
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);
        $total_record =  $list_reviews->total();
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
        return view('admin.reviews.getListEatReviews', compact('start', 'record', 'total_record','list_reviews','keyword'));
    }

    public function deleteReview(Request $request){
        $Arr_list = explode(',', $request->list_id);
        foreach($Arr_list as $review_id){
            $review_del = Review::findOrFail($review_id);
            if($review_del){
                $del_review_rate = Review_rating::where('review_id','=',$review_id)->delete();
                $review_del -> delete();
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Review does not exist',
                ], 200);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Delete review success',
        ], 200);
    }
    public function postReviewFrontEnd(Request $request){
        $ShareController = new ShareController;
        $description = $ShareController->badWordFilter($request -> description);
        if($description){
            return response()->json([
                'success' => false,
                'data' => $description,
                'message' => 'Please correct the words '.$description,
            ]);
        }
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
