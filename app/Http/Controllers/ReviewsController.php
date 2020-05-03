<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Review;
use App\Myconst;
use App\Business;
use App\Review_rating;
use View;
use App\Media;
use App\TotalRate;
use App\Review_Business_Rating;
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
        $list_reviews = Review::select('reviews.*','businesses.id','users.id as user_id','businesses.name as businesses_name','users.name as name_user','review__business__ratings.type_rate','review__business__ratings.review_id')
        ->join('review__business__ratings','review__business__ratings.review_id','=','reviews.id')
        ->join('businesses','reviews.business_id','=','businesses.id')
        ->join('users','reviews.user_id','=','users.id')
        ->where(function($query) use ($keyword){            
            $query->where('businesses.name', 'LIKE', '%'.$keyword.'%')->orwhere('users.name', 'LIKE', '%'.$keyword.'%');
        })
        ->whereNull('businesses.deleted_at')
        ->whereNull('users.deleted_at')
        ->where('review__business__ratings.type_rate','=',1)
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
        $list_reviews = Review::select('reviews.*','businesses.id','users.id as user_id','businesses.name as businesses_name','users.name as name_user','review_ratings.type_rate','review_ratings.review_id','review_ratings.category_id','categories.category_name')
        ->join('review_ratings','review_ratings.review_id','=','reviews.id')
        ->join('categories','categories.id','=','review_ratings.category_id')
        ->join('businesses','reviews.business_id','=','businesses.id')
        ->join('users','reviews.user_id','=','users.id')
        ->where(function($query) use ($keyword){            
            $query->where('businesses.name', 'LIKE', '%'.$keyword.'%')->orwhere('users.name', 'LIKE', '%'.$keyword.'%');
        })
        ->where('review_ratings.type_rate','=',2)
        ->whereNull('businesses.deleted_at')
        ->whereNull('users.deleted_at')
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
                $del_review_rate_business = Review_Business_Rating::where('review_id','=',$review_id)->delete();

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
        $user_id = Auth::user()->id;
        /*create review */
        /*check đã review món chưa, nếu rồi thì trả về đã review*/
        $check_reviews_business = Review_rating::where('user_id',$user_id)->where('id_rate_from',$request -> business_id)
                                                ->where('category_id',$request -> category_id)
                                                ->where('type_rate',2)->count();
        if($check_reviews_business > 0){
            return response()->json([
                'success' => true,
                'message' =>  'You have already rated this EAT',
            ]);
        }

        $reviews_business = new Review;        
        $response = $reviews_business -> update_review($request,$user_id);
        $data = $response->getData();
        $data_business = Business::find($request->business_id);

        if(count($data_business -> locations)){
            $city_id = $data_business->locations->first()->IdCity;
            $state_id = $data_business->locations->first()->IdState;
        }else{
            $city_id = null;
        }
        //$city_id = $data_business->location->IdCity;

        /*create review eat*/
        if($request -> category_id){
            /*img review eat*/
            if($request -> image !=null){
                foreach($request -> image as $img){
                    $base64String = $img;
                    $ShareController = new ShareController;
                    $media = new Media;
                    $media -> type_media = 'image';
                    $media -> url =  $ShareController->saveImgReviewBase64($base64String, 'uploads');
                    $media -> id_user = $user_id;
                    /*type = 2 ảnh review của món, type = 1 ảnh review của business*/
                    $media -> type = 2;
                    $media -> save();
                    $arr_image_gallery[] = $media -> id;
                }
            }else{
                $arr_image_gallery[] = null;
            }
           $review_eat = new Review;
           $review_eat -> user_id = $user_id;
           $review_eat -> business_id = $request -> business_id;
           $review_eat -> description = $request -> description;
           $review_eat -> list_id_image =  $arr_image_gallery;

           if($review_eat -> save()){
                /*update review rating*/
                $review_rating = new Review_rating;
                $review_rating -> user_id = $user_id;
                $review_rating -> review_id = $review_eat -> id;
                $review_rating -> id_rate_from = $review_eat -> business_id;
                $review_rating -> category_id = $request -> category_id;
                $review_rating -> type_rate = 2;
                $review_rating -> rate = $request -> rate;
                $review_rating -> save();
                /*total_review*/
                $check_total_rate = TotalRate::where('business_id','=',$request -> business_id)->where('category_id','=',$request -> category_id)->count();
                if($check_total_rate > 0){
                    $update_total_rate = TotalRate::where('business_id','=',$request -> business_id)->where('category_id','=',$request -> category_id)->first();
                    $new_total_rate = $update_total_rate -> total_rate + $request -> rate;
                    $new_total_vote = $update_total_rate -> total_vote + 1;
                    $update_total_rate -> total_rate = $new_total_rate;
                    $update_total_rate -> total_vote = $new_total_vote;
                    $update_total_rate -> save();

                }else{
                    foreach($data_business->business_cate as $id_cate){
                        if($request -> category_id == $id_cate->cate_id){
                            $rate = $request -> rate;
                            $vote = 1;
                        }else{
                            $rate = 0;
                            $vote = 0;
                        }
                        $total_review = new TotalRate;
                        $total_review -> business_id = $request -> business_id;
                        $total_review -> category_id = $id_cate->cate_id;
                        $total_review -> city = $city_id;
                        $total_review -> state = $state_id;
                        $total_review -> type_rate = 2;
                        $total_review -> total_rate = $rate;
                        $total_review -> total_vote = $vote;
                        $total_review -> save();
                    }
                    
                }
            }
        }
       
        /*end create reviews*/
        $info_business = Business::findOrfail($request -> business_id);
        $list_reviews = $info_business->review_rating()->where('type_rate','=',1)->orderBy('created_at','desc')->paginate(Myconst::PAGINATE_ADMIN);

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
