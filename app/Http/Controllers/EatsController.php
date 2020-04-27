<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
use App\Category;
use App\Myconst;
use App\Business;
use App\Location;
use App\businesses_category;
use App\Review;
use App\Review_rating;
use App\Vote;
use App\Http\Controllers\ShareController;
use Validator;
class EatsController extends Controller
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

    public function getListEats(Request $request){
        $keyword = $request -> keyword ? $request -> keyword : '';
        $data_category = Category::select('categories.*')
        ->where(function($query) use ($keyword){            
            $query->where('category_name', 'LIKE', '%'.$keyword.'%');
        })
        ->where('status','=',1)
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  $data_category->total();
        $count_record = count($data_category);
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

        return view('admin.eats.list_eats', compact('start', 'record', 'total_record','data_category','keyword'));
    }
    public function getListPendingEats(Request $request){
        $keyword = $request -> keyword ? $request -> keyword : '';
        $data_category = Category::select('categories.*')
        ->where(function($query) use ($keyword){            
            $query->where('category_name', 'LIKE', '%'.$keyword.'%');
        })
        ->where('user_add','!=',1)
        ->where('status','=',0)
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);
        $total_record = Category::where('status','=',0)->count();
        $count_record = count($data_category);
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
        return view('admin.eats.getListPendingEats', compact('start', 'record', 'total_record','data_category','keyword'));
    }
    public function getListApprovedEats(Request $request){
        $keyword = $request -> keyword ? $request -> keyword : '';
        $data_category = Category::select('categories.*')
        ->where(function($query) use ($keyword){            
            $query->where('category_name', 'LIKE', '%'.$keyword.'%');
        })
        ->where('user_add','!=',1)
        ->where('status','=',1)
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);
        $total_record = Category::where('status','=',0)->count();
        $count_record = count($data_category);
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
        return view('admin.eats.getListApprovedEats', compact('start', 'record', 'total_record','data_category','keyword'));
    }
    /*approvedEat*/
    public function approvedEat($eat_id){
        $update_category = Category::findorfail($eat_id);
        $update_category -> status = 1;
        $update_category -> save();
        return redirect()->back();

    }
    public function postCreateEats(Request $request){
         $this-> Validate($request,[
            'category_name' => 'required|unique:categories,category_name',
            'description' => 'required',
        ]);
        $create = new Category;
        if($request -> image !=null){
           $base64String = $request->image;
           $ShareController = new ShareController;
           $url_img = $ShareController->saveImgBase64($base64String, 'uploads');
        }else{
            $url_img = null;
        }
        $create->category_name = $request -> category_name;
        $create->url_img = $url_img;
        $create->status = 1;
        $create->description = $request->description;
        $create->save();
        return redirect()->back();
    }
    public function getEditEats($id_eat){
        $data_eat = Category::findorfail($id_eat);
        return view('admin.eats.edit_eats',compact('data_eat'));
    }
    public function postEditEats(Request $request){
        $data_eat = Category::findorfail($request->id_eat);
        $this-> Validate($request,[
            'category_name' => 'required|unique:categories,category_name,'.$data_eat->id,
            'description' => 'required',
        ]);
        $data_eat -> update_category($request);
        return redirect()->back();
    }
    public function deleteEat(Request $request){
        $Arr_list_Eat = explode(',', $request->list_id);

        foreach($Arr_list_Eat as $eat_id){
            $eat_del = Category::findOrFail($eat_id);
            if($eat_del){
                /*delete businesses_categories*/
                $del_businesses_categories = businesses_category::where('cate_id','=',$eat_del ->id)->delete();
                /*delete review rating*/
                $list_review_rating = Review_rating::where('category_id','=',$eat_del ->id)->get();
                if(count($list_review_rating) > 0){
                    foreach ($list_review_rating as $review_rating) {
                        /*delete rivew*/
                        $del_review = Review::findorfail($review_rating->review_id);
                        if($del_review){
                            $del_review ->delete();
                        }

                        $del_review_rating = $review_rating ->delete();
                    }
                }
                /*delete vote*/
                $del_vote = Vote::where('category_id','=',$eat_del->id)->delete();

                $eat_del -> delete();
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Eat does not exist',
                ], 200);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Delete eat success',
        ], 200);
    }

    /**************************Front-end*****************************************/
    public function postCreateEatsFrontEnd(Request $request){
        
        // $this-> Validate($request,[
        //     'category_name' => 'required|unique:categories,category_name',
        //     'address' => 'required',
        //     'business_name' => 'required',
        //     'state' => 'required',
        //     'zipcode' => 'required',
        // ]);
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|unique:categories,category_name',
            'address' => 'required',
            'business_name' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
        ]);
        if($validator->fails()){
            if($validator->errors()->first('category_name') != null){
                return response()->json([
                    "state" => "error",
                    "message" => "Sorry, the EAT for this business has already been added."
                ]);
            }
        }
        /*create category*/
        $update_category = new Category;
        $id_category = $update_category -> update_category($request)->id;
        /*check business*/
        $check_business = Business::where('name','=',$request -> business_name)->count();
        if($check_business > 0){
            $update_business = Business::where('name','=',$request -> business_name)->first();
            $update_business -> business_category()->sync($id_category);
        }else{
            /*create business*/
            if($request -> address){               
                $Location = new Location;
                $location_id = $Location->update_location($request)->id;
            }else{
                $location_id = null;
            }
            $business = new Business;
            $business -> name = $request -> business_name;
            $business -> address = $request -> address;
            $business -> location_id = $location_id;
            $business -> save();
            // business_category
            $business->business_category()->sync($id_category);
        }
        // return redirect()->back();
        return response()->json([
            "state" => "success",
            "message" => "the EAT for this business add success!"
        ],200);
    }
    public function createBusinessCategory(Request $request){
       
        $business = Business::findorfail($request ->business);
        $business->business_category()->sync($request ->category_type);
        return redirect()->back();
    }
   
}
