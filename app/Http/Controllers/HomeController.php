<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Business;
use App\Review;
use App\Myconst;
use App\PlanDetail;
use App\Advertisement;
use View;
use Auth;
use App\Bookmark;
class HomeController extends Controller{
    public function __construct(){
        $category = Category::All();
        view()->share(['category'=>$category]);
    }

    public function home(){
        return view('layouts.index');
    }

    public function search(Request $request){
        $keyword = $request -> keyword ? $request -> keyword : '';
        $city = $request -> city ? $request -> city : '';
        $state = $request -> state ? $request -> state : '';


        $list_cate_sponsored = Category::select('categories.*','businesses_categories.business_id','businesses.id','businesses.location_id','locations.city','locations.state')->join('businesses_categories','cate_id','=','categories.id')
        ->join('businesses','businesses_categories.business_id','=','businesses.id')
        ->join('locations','businesses.location_id','=','locations.id')
        ->where(function($query) use ($keyword,$city,$state){            
            $query->where('category_name', 'LIKE', '%'.$keyword.'%')->where('city','LIKE', '%'.$city.'%')->orwhere('category_name', 'LIKE', '%'.$keyword.'%')->Where('state','LIKE', '%'.$state.'%');
        })
        ->groupBy('businesses_categories.business_id')
        ->take(2)->pluck('business_id');
        $data_business_sponsored = $this -> getbusinessCate($list_cate_sponsored);
        
        /*list all Results*/
        $list_cate = Category::select('categories.*','businesses_categories.business_id','businesses.id','businesses.location_id','locations.city','locations.state')->join('businesses_categories','cate_id','=','categories.id')
        ->join('businesses','businesses_categories.business_id','=','businesses.id')
        ->join('locations','businesses.location_id','=','locations.id')
        ->where(function($query) use ($keyword,$city,$state){            
            $query->where('category_name', 'LIKE', '%'.$keyword.'%')->where('city','LIKE', '%'.$city.'%')->orwhere('category_name', 'LIKE', '%'.$keyword.'%')->Where('state','LIKE', '%'.$state.'%');
        })
        ->groupBy('businesses_categories.business_id')
        ->paginate(Myconst::PAGINATE_ADMIN);
        $arr_business_id = $list_cate ->pluck('business_id');
        $data_business = $this -> getbusinessCate($arr_business_id);
        return view('layouts.search',compact('data_business','list_cate','data_business_sponsored','keyword','city','state'));
    }
    public function getbusinessCate($arr_id){
        $result = array();  
        foreach($arr_id as $id){
            $item = Business::findOrfail($id);
            $data['id'] = $item->id;
            $data['business_name'] = $item->name;
            $data['business_phone'] = $item ->phone;
            $data['description'] = $item ->description;
            $data['location'] = $item ->location->address;
            $data['url_img'] = $item ->url_img;
            $data['category_business'] = $item ->business_category->pluck('category_name');
            $data['classification'] = $item ->classification;
            $data['total_review'] = $item ->classification;
            $data['total_rate'] = $item ->total_rate;
            $data['total_vote'] = $item ->total_vote;
            $data['permalink'] = $item ->permalink();

            if($item->total_vote > 0){
                $rate = floor(($item->total_rate / $item->total_vote) * 2) / 2;
            }else{
                $rate = 0;
            }
            $data['rate'] = $rate;
            $result[] = $data;
        }
        return $result;
    }

    public function myprofile(){
        return view('layouts_profile.myprofile');
    }

    public function mysetting(){
        return view('layouts_profile.setting');
    }

    public function sign_up(){
        return view('layouts.register');
    }
    public function sign_in(){

        return view('layouts.login');
    }

    public function forgot_password(){
        return view('layouts.forgot_password');
    }

    public function menu_management(){
        return view('layouts_profile.menu-management');
    }

    public function review_management(){
        $business_id = Auth::user()->business()->first()->id;
        /*list reviews for business*/
        $list_reviews = Review::select('reviews.*')
        ->where('business_id','=',$business_id)
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);
        return view('layouts_profile.review-management',compact('list_reviews'));
    }

    public function info_management(){
       /*info restaurant*/
       $info_business = Auth::user()->business()->first();
       /*category*/
       $category = Category::All();

       return view('layouts_profile.info-management',compact('info_business','category'));
   }
   public function advertise(){
    return view('layouts.advertise');
}

public function privacy_policy(){
    return view('layouts.privacy-policy');
}

public function contact(){
    return view('layouts.contact');
}

public function create_business(){
    $category = Category::All();
    return view('layouts.create_business',compact('category'));
}

public function add_business(){
    return view('layouts_profile.add_business');
}
public function business_management(){
    return view('layouts_profile.business-management');
}
public function bookmark(){
    $arr_business_id = Auth::user()->bookmark->pluck('business_id');
    $data_business = $this -> getbusinessCate($arr_business_id);
    // dd($data_business);
    return view('layouts_profile.bookmark',compact('data_business'));
}
/*create_advertise*/
public function create_advertise(){
    $business_id = Auth::user()->business()->first()->id;
    $plan_details = new PlanDetail;
    $advertisement = Advertisement::where('business_id','=',$business_id)->get();
    return view('layouts_profile.create-advertise',compact('plan_details','advertisement'));
}
public function eat_reviews(){
    $user_id = Auth::user()->id;
    /*list reviews for business*/
    $list_reviews = Review::select('reviews.*')
    ->where('user_id','=',$user_id)
    ->orderBy('created_at', 'desc')
    ->paginate(Myconst::PAGINATE_ADMIN);

    return view('layouts_profile.eat-review',compact('list_reviews'));
}
/*single_restaurent*/
public function single_business(Request $request){
    $info_business = Business::findOrfail($request -> id_business);
    $list_reviews = $info_business->review()->paginate(Myconst::PAGINATE_ADMIN);
    $bookmark = Bookmark::select('*')
                ->where('user_id','=',Auth::user()->id)
                ->where('business_id','=',$request -> id_business)
                ->first();
    return view('layouts.single-business',compact('info_business','list_reviews','bookmark'));
}
public function ajax_bookmark(Request $request){
    $data = $request->toArray();
    $check;
    $user = Auth::user();
    $bookmark = Bookmark::select('*')
                ->where('user_id','=',$user->id)
                ->where('business_id','=',$request -> business)
                ->first();
    if($bookmark){
        $user->businesses()->detach([$data['business']]);
        $check = false;
    }else{
        $arr = $user->businesses()->pluck('business_id');
        $arr[] = $data['business'];
        $user->businesses()->sync($arr);
        $check = true;
    }
    return response()->json([
        'success' => true,
        'book' => $check,
    ]);
}



}
