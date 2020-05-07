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
use App\User;
use App\Bookmark;
use App\Vote;
use App\Page;
use App\State;
use App\City;
use App\Country;
use App\Review_rating;
use DB;
use App\ReviewReaction;
use Carbon\Carbon;
use App\Media;
use App\TotalRate;
use App\Review_Business_Rating;
use App\Http\Controllers\ShareController;
class HomeController extends Controller{

    public function __construct(){

        $Country = Country::where('code','=','US')->first();
        $state =  $Country->states()->get();

        $this->ad = new Advertisement();
        $this->user = Auth::user();
        $category = Category::where('status','=',1)->get();
        $all_page = Page::all();
        view()->share(['category'=>$category,'all_page'=>$all_page,'user'=> $this->user,'state'=>$state]);
    }

    public function home(){
        $ads_active_home = Advertisement::home()->active()->take(3)->get();
        $category = Category::where('status','=',1)->take(6)->get();
        return view('layouts.index',compact('category', 'ads_active_home'));
    }
    public function fetchCategory(Request $request){
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = Category::select('categories.*')
            ->where('category_name', 'LIKE', "%{$query}%")
            ->where('status','=',1)
            ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            if(count($data)>0){
                foreach($data as $row)
                {
                    $output .= '<li class="category_name form-search-val">'.$row->category_name.'</li>';             
                }
            }else{
                $output .= '<li><a>'."Do Not Exist In The System".'</a></li>';   
            }
            
            $output .= '</ul>';
            echo $output;
        }
    }
    /*fetchCityState*/
    public function fetchCityState(Request $request){
        if($request->get('query'))
        {
            $keyword = $request->get('query');

            $data = Country::select('countries.*','states.name as state_name','cities.name as city_name')
            ->leftjoin('states','states.country_id','=','countries.id')
            ->leftjoin('cities','cities.state_id','=','states.id')
            ->where('code','=','US')
            ->where(function($query) use ($keyword){            
                $query->where('cities.name','LIKE', '%'.$keyword.'%')->orwhere('states.name', 'LIKE', '%'.$keyword.'%');
            })->take(50)->get();
            /*$data = Category::select('categories.*')
            ->where('category_name', 'LIKE', "%{$query}%")
            ->where('status','=',1)
            ->get();*/
            $data_state = Country::select('countries.*','states.name as state_name')
            ->leftjoin('states','states.country_id','=','countries.id')
            ->where('code','=','US')
            ->where(function($query) use ($keyword){            
                $query->where('states.name', 'LIKE', '%'.$keyword.'%');
            })->take(20)->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%;">';
            if(count($data_state)>0){
                foreach($data_state as $row_state)
                {
                    $output .= '<li class="location_name form-search-val" data-city="" data-state="'.$row_state->state_name.'">'.$row_state->state_name.'</li>';
                }
            }

            if(count($data)>0){
                foreach($data as $row)
                {
                    if($row->city_name){
                        $text = $row->city_name.', '.$row->state_name;
                    }else{
                        $text = $row->city_name;
                    }

                    $output .= '<li class="location_name form-search-val" data-city="'.$row->city_name.'" data-state="'.$row->state_name.'">'.$text.'</li>';             
                }
            }
            if(count($data) == 0 && count($data_state) == 0){

                $output .= '<li><a>'."Do Not Exist In The System".'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }


    public function search(Request $request){
        $keyword = $request -> keyword ? $request -> keyword : '';
        if($keyword == "" || $keyword == null){
            session()->put('error','Please enter the keyword to search for EAT');
            return redirect()->back();
        }
        $city = $request -> city ? $request -> city : '';
        $state_search = $request -> state ? $request -> state : '';

        if($city != ''){
            $text_city_state = $city.', '.$state_search;
        }else{
            $text_city_state = $state_search;
        }
        $category_search = Category::where('category_name','=',$keyword)->first();
        if(!$category_search){
            return redirect()->back();
        }

        /*fix search*/
        $data_business_sponsored =  Business::select('categories.category_name','categories.status','businesses_categories.business_id','businesses.*','advertisements.status as status_adv','states.name as name_state','cities.name as name_city','advertisements.deleted_at as adv_deleted_at','advertisements.active_date','advertisements.active_date','advertisements.expiration_date', DB::raw(' total_rates.total_rate/total_rates.total_vote as total_rate_eat '))
        ->JoinBusinessesCategory()->JoinCategory()->JoinTotalRating()
        ->JoinAdvertisement()->JoinState()->JoinCity()
        ->where(function($query) use ($keyword,$city,$state_search){  
             if($city != ''){        
                $query->where('category_name', '=', $keyword)->where('cities.name','LIKE', '%'.$city.'%')->orwhere('category_name', '=', $keyword)->Where('states.name','LIKE', '%'.$state_search.'%');
            }else{
                $query->where('category_name', '=', $keyword)->Where('states.name','LIKE', '%'.$state_search.'%');
            }
        })
        ->where(function($query) use ($category_search){ 
                $query->whereNull('total_rates.category_id')->orwhere('total_rates.category_id','=',$category_search->id);
        })
        ->whereNull('advertisements.deleted_at')
        ->whereNotNull('businesses.activated_on')
        ->where('categories.status','=',1)
        ->where('advertisements.active_date', '<=', Carbon::now())
        ->where('advertisements.expiration_date', '>=', Carbon::now())
        ->where('advertisements.status','=',2)
        ->groupBy('businesses_categories.business_id')->take(2)->get();
        /*list all Results FROM review_ratings WHERE type_rate = 2*/

        $data_business = Business::select('categories.category_name','categories.status','businesses_categories.business_id','businesses.*','locations.city','locations.state', DB::raw(' total_rates.total_rate/total_rates.total_vote as total_rate_eat '))
        ->JoinLocation()->JoinBusinessesCategory()->JoinCategory()->JoinTotalRating()
        ->where(function($query) use ($keyword,$city,$state_search){    
            if($city != ''){
                $query->where('category_name', '=', $keyword)->where('locations.city','LIKE', '%'.$city.'%')->orwhere('category_name', '=', $keyword)->where('locations.state','LIKE', '%'.$state_search.'%');
            }else{
                $query->where('category_name', '=', $keyword)->where('locations.state','LIKE', '%'.$state_search.'%');
            }
        })
       ->where(function($query) use ($category_search){ 
                $query->whereNull('total_rates.category_id')->orwhere('total_rates.category_id','=',$category_search->id);
        })
        ->where('categories.status','=',1)
        ->whereNotNull('businesses.activated_on')
        ->groupBy('businesses.id')       
        ->orderBy('total_rate_eat','desc')
        ->paginate(Myconst::PAGINATE_ADMIN);
        return view('layouts.search',compact('data_business','data_business_sponsored','keyword','city','state_search','text_city_state','category_search'));
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
        $user = Auth::user();
        $list_reviews = Review_Business_Rating::where('review__business__ratings.user_id','=',$user->id)
               ->join('businesses','businesses.id','=','review__business__ratings.id_rate_from')
               ->where('type_rate','=',1)
               ->whereNull('businesses.deleted_at')
               ->orderBy('review__business__ratings.created_at', 'desc')
               ->paginate(Myconst::PAGINATE_ADMIN);
        $data_business = $user->businesses()->paginate(Myconst::PAGINATE_ADMIN);
        return view('layouts_profile.myprofile',compact('user','list_reviews','data_business'));
    }

    public function mysetting(){
        $Country = Country::where('code','=','US')->first();
        $state =  $Country->states()->get();
        return view('layouts_profile.setting',compact('state'));
    }
    /*ajaxCity*/
    public function ajaxCity(Request $request){
       if($request->get('name_state'))
       {
            $name_state = $request->get('name_state');
            $state = State::select('states.*','countries.code')
            ->join('countries','countries.id','=','states.country_id')
            ->where('code','=','US')
            ->where('states.name','=',$name_state)->first();
            $data = $state->cities()->get();


            $output = '';
            $selected = "";
            if(count($data)>0){
                foreach($data as $key => $row)
                {
                    ($key == 0) ? $selected ="selected" : $selected="";
                    $output .= '<option '.$selected.' value="'.$row->name.'" >'.$row->name.'</option>';             
                }
            }
            echo $output;
        }else{
            $output = '<option value="" disabled selected >Select City</option>';
            echo $output;
        }

}
/*ajaxEatBusiness*/
public function ajaxEatBusiness(Request $request){
    $info_business = Business::find($request -> business_id);
    $category = Category::where('status','=',1)->get();

    $output = '<option value="" selected="selected" >select eat</option>';
    $selected = '';
    if($info_business){
        $list_busi_cate = $info_business->business_category->pluck('id')->toArray();
        foreach ($category as $data_cate){
            $selected = (in_array($data_cate -> id, $list_busi_cate)) ? 'selected' : '';
            $output .= '<option value="'.$data_cate->id.'" '.$selected.' >'.$data_cate->category_name.'</option>';
        }
        return $output;
    }
}
public function sign_up(){
    $Country = Country::where('code','=','US')->first();
    $state =  $Country->states()->get();
    return view('layouts.register',compact('state'));
}
public function sign_in(){
    if(Auth::check()){
        return redirect()->back();
    }else{
        return view('layouts.login');
    }
    
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
    ->whereNull('businesses.deleted_at')
    ->orderBy('created_at', 'desc')
    ->paginate(Myconst::PAGINATE_ADMIN);
    return view('layouts_profile.review-management',compact('list_reviews'));
}

public function info_management(){
 /*info restaurant*/
 $info_business = Auth::user()->business()->first();
 /*category*/
 $category = Category::where('status','=',1)->get();

 return view('layouts_profile.info-management',compact('info_business','category'));
}
public function advertise(){
    $ads_active_home = Advertisement::home()->active()->take(3)->get();
    $plan_details = new PlanDetail;
    return view('layouts.advertise', compact('plan_details','ads_active_home'));
}

public function privacy_policy(){
    return view('layouts.privacy-policy');
}
/*getPages*/
public function getPages(Request $request){
    $info_page = Page::findBySlugOrFail($request -> id_page);
    return view('layouts.pages',compact('info_page'));
}
/*end getPages*/
public function contact(){
    return view('layouts.contact');
}

public function create_business(){
    $category = Category::where('status','=',1)->get();
    return view('layouts.create_business',compact('category'));
}

public function add_business(){
    return view('layouts_profile.add_business');
}
public function business_management(){
    return view('layouts_profile.business-management');
}
public function bookmark(){
    $user = Auth::user();
    $data_business = Auth::user()->businesses()->paginate(Myconst::PAGINATE_ADMIN);
    return view('layouts_profile.bookmark',compact('data_business','user'));
}

public function my_eat(){
    $user = Auth::user();
    $info_business = Auth::user()->business()->get();
    return view('layouts_profile.my-eat',compact('info_business','user'));
}
/*create_advertise*/
public function create_advertise(){
    $user = Auth::user();
    $business_id = Auth::user()->business()->first()->id;
    $plan_details = new PlanDetail;
    $advertisement = Advertisement::where('business_id','=',$business_id)->get();
    return view('layouts_profile.create-advertise',compact('plan_details','advertisement','user'));
}
public function eat_reviews(Request $request){
    $user = Auth::user();
        $user_id = Auth::id();
        /*list reviews for business*/
        $list_review_eats = Review_rating::where('review_ratings.user_id','=',$user_id)
       ->join('businesses','businesses.id','=','review_ratings.id_rate_from')
       ->where('type_rate','=',2)
       ->whereNull('businesses.deleted_at')
       ->orderBy('review_ratings.created_at', 'desc')
       ->paginate(Myconst::PAGINATE_ADMIN);

        return view('layouts_profile.eat-review',compact('list_review_eats','user'));
   
    
}
public function business_review(){
        $user = Auth::user();
       $user_id = Auth::id();
       /*list reviews for business*/
       $list_reviews = Review_Business_Rating::where('review__business__ratings.user_id','=',$user_id)
       ->join('businesses','businesses.id','=','review__business__ratings.id_rate_from')
       ->where('type_rate','=',1)
       ->whereNull('businesses.deleted_at')
       ->orderBy('review__business__ratings.created_at', 'desc')
       ->paginate(Myconst::PAGINATE_ADMIN);
    return view('layouts_profile.business-review',compact('list_reviews','user'));
}
/*single_restaurent*/
public function single_business(Request $request){
    $info_business = Business::findOrfail($request -> id_business);
    $list_reviews = $info_business->Review_Business_Rating()
       ->join('users','users.id','=','review__business__ratings.user_id')
       ->where('type_rate','=',1)
       ->whereNull('users.deleted_at')
       ->orderBy('review__business__ratings.created_at', 'desc')
       ->paginate(Myconst::PAGINATE_ADMIN);
    $list_review_eats = $info_business-> Review_rating()
       ->join('users','users.id','=','review_ratings.user_id')
       ->where('type_rate','=',2)
       ->whereNull('users.deleted_at')
       ->orderBy('review_ratings.created_at', 'desc')
       ->paginate(Myconst::PAGINATE_ADMIN);

    return view('layouts.single-business',compact('info_business','list_reviews','list_review_eats'));
}
public function ajax_bookmark(Request $request){
    $data = $request->toArray();
    $check;
    $user = Auth::user();
    if(!$user){
        return response()->json([
            'success' => false,
            'message' => "You need to log-in to proceed",
        ]);
    }
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
public function ajax_unvoted(Request $request){
    $user = Auth::user();
    $data_business = Business::find($request->business_id);
    $city_id = $data_business->getIdCity();
    /*delete vote business*/
    $delete_vote = Vote::select('*')
    ->where('user_id','=',$user->id)
    ->where('type_vote','=',2)
    ->where('city_id','=',$city_id)
    ->where('business_id','=',$request->business_id)
    ->where('category_id','=',$request->category_id)
    ->delete();
    return response()->json([
        'message' => "You have 1 vote remaining!!!",
        'city_id' => $city_id
    ]);
}
public function vote_ajax(Request $request){
    $user = Auth::user();
    
    $data_business = Business::find($request->business);
    $city_id = $data_business->getIdCity();
    $cate_id = $request -> category_id;

    /**/
    if($cate_id){
        $check_vote_city_eat = Vote::where('user_id','=',$user->id)->where('category_id','=',$cate_id)->where('type_vote','=',2)->where('city_id','=',$city_id)->first();

        if($check_vote_city_eat ){
            $id_voted = $check_vote_city_eat->business_id;
            $delete = Vote::where('user_id','=',$user->id)->where('category_id','=',$cate_id)->where('type_vote','=',2)->where('city_id','=',$city_id)->delete();

            $new_vote = new Vote;
            $new_vote -> user_id = $user->id;
            $new_vote -> business_id = $data_business->id;
            $new_vote -> category_id = $cate_id;
            if($data_business->getIdState()){
                $new_vote -> state_id = $data_business->getIdState();
            }else{
                $new_vote -> state_id = null;
            }
            if($city_id){
                $new_vote -> city_id = $city_id;
            }else{
                $new_vote -> city_id = null;
            }
            /*vote = 1 vote cho business bằng 2 vote cho eat*/
            $new_vote -> type_vote = 2;
            $new_vote -> save();
            /*kiểm tra xem đã vote cho nhà hàng chưa*/
            // $check_vote_business  = Vote::where('user_id','=',$user->id)->where('business_id','=',$data_business -> id)->where('type_vote','=',1)->where('city_id','=',$city_id)->first();
            // if(!$check_vote_business){
            //     $new_vote_business = new Vote;
            //     $new_vote_business -> user_id = $user->id;
            //     $new_vote_business -> business_id = $data_business->id;
            //     $new_vote_business -> state_id = $data_business->location->IdState;
            //     $new_vote_business -> city_id = $city_id;

            //     /*vote = 1 vote cho business bằng 2 vote cho eat*/
            //     $new_vote_business -> type_vote = 1;
            //     $new_vote_business -> save();
            // }
            return response()->json([
                    'success' => true,
                    'city_id' => $city_id,
                    'id_voted' => $id_voted
                ]);
        }else{

            $new_vote = new Vote;
            $new_vote -> user_id = $user->id;
            $new_vote -> business_id = $data_business->id;
            $new_vote -> category_id = $cate_id;
            if($data_business->getIdState()){
                $new_vote -> state_id = $data_business->getIdState();
            }else{
                $new_vote -> state_id = null;
            }

            if($city_id){
                $new_vote -> city_id = $city_id;
            }else{
                $new_vote -> city_id = null;
            }

            /*vote = 1 vote cho business bằng 2 vote cho eat*/
            $new_vote -> type_vote = 2;
            $new_vote -> save();

             /*kiểm tra xem đã vote cho nhà hàng chưa*/
            // $check_vote_business  = Vote::where('user_id','=',$user->id)->where('business_id','=',$data_business -> id)->where('type_vote','=',1)->where('city_id','=',$city_id)->first();
            // if(!$check_vote_business){
            //     $new_vote_business = new Vote;
            //     $new_vote_business -> user_id = $user->id;
            //     $new_vote_business -> business_id = $data_business->id;
            //     $new_vote_business -> state_id = $data_business->location->IdState;
            //     $new_vote_business -> city_id = $city_id;

            //     /*vote = 1 vote cho business bằng 2 vote cho eat*/
            //     $new_vote_business -> type_vote = 1;
            //     $new_vote_business -> save();
            // }
            return response()->json([
                'success' => true,
                'city_id' => $city_id
            ]);

        }
    }
            /**/

        


}
/*knight*/
public function voteReviewEat_ajax(Request $request){
    $ShareController = new ShareController;
    $description = $ShareController->badWordFilter($request -> description);
    if($description){
        return response()->json([
            'success' => false,
            'data' => $description,
            'message' => 'Please correct the words '.$description,
        ]);
    }

    $Category_type = $request -> Category_type;
    $user = Auth::user();
    $user_id = $user->id;
    $vote = Vote::select('*')
    ->where('user_id','=',$user->id)
    ->where('business_id','=',$request->business)
    ->where('type_vote','=',2)
    ->first();
    $data_business = Business::find($request->business);
    $city_id = $data_business->getIdCity();

        $check_vote_city = Vote::where('user_id','=',$user->id)->where('type_vote','=',2)->where('city_id','=',$city_id)->first();
        if($check_vote_city ){
            $delete = Vote::where('user_id','=',$user->id)->where('type_vote','=',2)->where('city_id','=',$city_id)->delete();
            foreach($Category_type as $cate_id){
                $new_vote = new Vote;
                $new_vote -> user_id = $user->id;
                $new_vote -> business_id = $data_business->id;
                $new_vote -> category_id = $cate_id;
                if($data_business->getIdState()){
                    $new_vote -> state_id = $data_business->getIdState();
                }else{
                    $new_vote -> state_id = null;
                }
               
                if($city_id){
                    $new_vote -> city_id = $city_id;
                }else{
                    $new_vote -> city_id = null;
                }
                

                /*vote = 1 vote cho business bằng 2 vote cho eat*/
                $new_vote -> type_vote = 2;
                $new_vote -> save();
                /*reviews eats*/
                 /*img review eat*/
                // if($request -> image !=null){
                //     foreach($request -> image as $img){
                //         $base64String = $img;
                //         $ShareController = new ShareController;
                //         $media = new Media;
                //         $media -> type_media = 'image';
                //         $media -> url =  $ShareController->saveImgReviewBase64($base64String, 'uploads');
                //         $media -> id_user = $user_id;
                //         /*type = 2 ảnh review của món, type = 1 ảnh review của business*/
                //         $media -> type = 2;
                //         $media -> save();
                //         $arr_image_gallery[] = $media -> id;
                //     }
                // }else{
                //     $arr_image_gallery[] = null;
                // }
                // $new_review = new Review;
                // $new_review -> user_id = $user_id;
                // $new_review -> business_id = $request -> business;
                // $new_review -> description = $request -> description;
                // $new_review -> list_id_image = $arr_image_gallery;

                // if($new_review -> save()){
                //     /*update review rating*/
                //     $review_rating = new Review_rating;
                //     $review_rating -> user_id = $user_id;
                //     $review_rating -> review_id = $new_review -> id;
                //     $review_rating -> id_rate_from = $new_review -> business_id;
                //     $review_rating -> category_id = $cate_id;
                //     $review_rating -> type_rate = 2;
                //     $review_rating -> rate = $request -> rate;
                //     $review_rating -> save();
                //     /*total_review*/
                //     $check_total_rate = TotalRate::where('business_id','=',$new_review -> business_id)->where('category_id','=',$cate_id)->count();
                //     if($check_total_rate > 0){
                //         $update_total_rate = TotalRate::where('business_id','=',$new_review -> business_id)->where('category_id','=',$cate_id)->first();
                //         $new_total_rate = $update_total_rate -> total_rate + $request -> rate;
                //         $new_total_vote = $update_total_rate -> total_vote + 1;
                //         $update_total_rate -> total_rate = $new_total_rate;
                //         $update_total_rate -> total_vote = $new_total_vote;
                //         $update_total_rate -> save();

                //     }else{
                //        foreach($data_business->business_cate as $id_cate){
                //         if($cate_id == $id_cate->cate_id){
                //             $rate = $request -> rate;
                //             $vote = 1;
                //         }else{
                //             $rate = 0;
                //             $vote = 0;
                //         }
                //         $total_review = new TotalRate;
                //         $total_review -> business_id = $request -> business;
                //         $total_review -> category_id = $id_cate->cate_id;
                //         $total_review -> city = $city_id;
                //         $total_review -> state = $data_business->getIdState();
                //         $total_review -> type_rate = 2;
                //         $total_review -> total_rate = $rate;
                //         $total_review -> total_vote = $vote;
                //         $total_review -> save();
                //     }
                //     }
                    


                // }
            }
                   
            // $info_business = Business::findOrfail($request->business);
            // $list_review_eats = $info_business->review_rating()->where('type_rate','=',2)->paginate(Myconst::PAGINATE_ADMIN);
            // $data = "";
            // $view = View::make('layouts.ajax_list_review', ['list_review_eats' => $list_review_eats]);
            // $data .= (string) $view;
            $message = 'You have voted and successfully evaluated';
            // return redirect()->back();
            return response()->json([
                'success' => true,
                // 'data' => $data,
                'message' =>  $message
            ]);

        }else{
            foreach($Category_type as $cate_id){
                $new_vote = new Vote;
                $new_vote -> user_id = $user->id;
                $new_vote -> business_id = $data_business->id;
                $new_vote -> category_id = $cate_id;
                if($data_business->getIdState()){
                    $new_vote -> state_id = $data_business->getIdState();
                }else{
                    $new_vote -> state_id = null;
                }
               
                if($city_id){
                    $new_vote -> city_id = $city_id;
                }else{
                    $new_vote -> city_id = null;
                }

                /*vote = 1 vote cho business bằng 2 vote cho eat*/
                $new_vote -> type_vote = 2;
                $new_vote -> save();
                /*reviews eats*/
            //     if($request -> image !=null){
            //         foreach($request -> image as $img){
            //             $base64String = $img;
            //             $ShareController = new ShareController;
            //             $media = new Media;
            //             $media -> type_media = 'image';
            //             $media -> url =  $ShareController->saveImgReviewBase64($base64String, 'uploads');
            //             $media -> id_user = $user_id;
            //             /*type = 2 ảnh review của món, type = 1 ảnh review của business*/
            //             $media -> type = 2;
            //             $media -> save();
            //             $arr_image_gallery[] = $media -> id;
            //         }
            //     }else{
            //         $arr_image_gallery[] = null;
            //     }
            //     $new_review = new Review;
            //     $new_review -> user_id = $user_id;
            //     $new_review -> business_id = $request -> business;                
            //     $new_review -> description = $request -> description;
            //     $new_review -> list_id_image = $arr_image_gallery;

            //     if($new_review -> save()){
            //         /*update review rating*/
            //         $review_rating = new Review_rating;
            //         $review_rating -> user_id = $user_id;
            //         $review_rating -> review_id = $new_review -> id;
            //         $review_rating -> id_rate_from = $new_review -> business_id;
            //         $review_rating -> category_id = $cate_id;
            //         $review_rating -> type_rate = 2;
            //         $review_rating -> rate = $request -> rate;
            //         $review_rating -> save();
            //         /*total_review*/
            //         $check_total_rate = TotalRate::where('business_id','=',$new_review -> business_id)->where('category_id','=',$cate_id)->count();
            //         if($check_total_rate > 0){
            //             $update_total_rate = TotalRate::where('business_id','=',$new_review -> business_id)->where('category_id','=',$cate_id)->first();
            //             $new_total_rate = $update_total_rate -> total_rate + $request -> rate;
            //             $new_total_vote = $update_total_rate -> total_vote + 1;
            //             $update_total_rate -> total_rate = $new_total_rate;
            //             $update_total_rate -> total_vote = $new_total_vote;
            //             $update_total_rate -> save();

            //         }else{
            //             foreach($data_business->business_cate as $id_cate){
            //                 if($cate_id == $id_cate->cate_id){
            //                     $rate = $request -> rate;
            //                     $vote = 1;
            //                 }else{
            //                     $rate = 0;
            //                     $vote = 0;
            //                 }
            //                 $total_review = new TotalRate;
            //                 $total_review -> business_id = $request -> business;
            //                 $total_review -> category_id = $id_cate->cate_id;
            //                 $total_review -> city = $city_id;
            //                 $total_review -> state = $data_business->getIdState();
            //                 $total_review -> type_rate = 2;
            //                 $total_review -> total_rate = $rate;
            //                 $total_review -> total_vote = $vote;
            //                 $total_review -> save();
            //             }
            //         }
            //     }
            }
            // $info_business = Business::findOrfail($request->business);
            // $list_review_eats = $info_business->review_rating()->where('type_rate','=',2)->paginate(Myconst::PAGINATE_ADMIN);
            // $data = "";
            // $view = View::make('layouts.ajax_list_review', ['list_review_eats' => $list_review_eats]);
            // $data .= (string) $view;
            $message = 'You have voted and successfully evaluated';
            // return redirect()->back();
            return response()->json([
                'success' => true,
                // 'data' => $data,
                'message' =>  $message
            ]);
        }

}
public function ReviewEat_ajax(Request $request){
    $ShareController = new ShareController;
    $description = $ShareController->badWordFilter($request -> description);
    if($description){
        return response()->json([
            'success' => false,
            'data' => $description,
            'message' => 'Please correct the words '.$description,
        ]);
    }

    $Category_type = $request -> Category_type;
    $user = Auth::user();
    $user_id = $user->id;
    $vote = Vote::select('*')
    ->where('user_id','=',$user->id)
    ->where('business_id','=',$request->business)
    ->where('type_vote','=',2)
    ->first();
    $data_business = Business::find($request->business);
    $city_id = $data_business->getIdCity();

        $check_vote_city = Vote::where('user_id','=',$user->id)->where('type_vote','=',2)->where('city_id','=',$city_id)->first();
        if($check_vote_city ){
            // $delete = Vote::where('user_id','=',$user->id)->where('type_vote','=',2)->where('city_id','=',$city_id)->delete();
            foreach($Category_type as $cate_id){
                // $new_vote = new Vote;
                // $new_vote -> user_id = $user->id;
                // $new_vote -> business_id = $data_business->id;
                // $new_vote -> category_id = $cate_id;
                // if($data_business->getIdState()){
                //     $new_vote -> state_id = $data_business->getIdState();
                // }else{
                //     $new_vote -> state_id = null;
                // }
               
                // if($city_id){
                //     $new_vote -> city_id = $city_id;
                // }else{
                //     $new_vote -> city_id = null;
                // }
                

                // /*vote = 1 vote cho business bằng 2 vote cho eat*/
                // $new_vote -> type_vote = 2;
                // $new_vote -> save();
                /*reviews eats*/
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
                $new_review = new Review;
                $new_review -> user_id = $user_id;
                $new_review -> business_id = $request -> business;
                $new_review -> description = $request -> description;
                $new_review -> list_id_image = $arr_image_gallery;

                if($new_review -> save()){
                    /*update review rating*/
                    $review_rating = new Review_rating;
                    $review_rating -> user_id = $user_id;
                    $review_rating -> review_id = $new_review -> id;
                    $review_rating -> id_rate_from = $new_review -> business_id;
                    $review_rating -> category_id = $cate_id;
                    $review_rating -> type_rate = 2;
                    $review_rating -> rate = $request -> rate;
                    $review_rating -> save();
                    /*total_review*/
                    $check_total_rate = TotalRate::where('business_id','=',$new_review -> business_id)->where('category_id','=',$cate_id)->count();
                    if($check_total_rate > 0){
                        $update_total_rate = TotalRate::where('business_id','=',$new_review -> business_id)->where('category_id','=',$cate_id)->first();
                        $new_total_rate = $update_total_rate -> total_rate + $request -> rate;
                        $new_total_vote = $update_total_rate -> total_vote + 1;
                        $update_total_rate -> total_rate = $new_total_rate;
                        $update_total_rate -> total_vote = $new_total_vote;
                        $update_total_rate -> save();

                    }else{
                       foreach($data_business->business_cate as $id_cate){
                        if($cate_id == $id_cate->cate_id){
                            $rate = $request -> rate;
                            $vote = 1;
                        }else{
                            $rate = 0;
                            $vote = 0;
                        }
                        $total_review = new TotalRate;
                        $total_review -> business_id = $request -> business;
                        $total_review -> category_id = $id_cate->cate_id;
                        $total_review -> city = $city_id;
                        $total_review -> state = $data_business->getIdState();
                        $total_review -> type_rate = 2;
                        $total_review -> total_rate = $rate;
                        $total_review -> total_vote = $vote;
                        $total_review -> save();
                    }
                    }
                    


                }
            }
                   
            $info_business = Business::findOrfail($request->business);
            $list_review_eats = $info_business->review_rating()->where('type_rate','=',2)->paginate(Myconst::PAGINATE_ADMIN);
            $data = "";
            $view = View::make('layouts.ajax_list_review', ['list_review_eats' => $list_review_eats]);
            $data .= (string) $view;
            $message = 'You have voted and successfully evaluated';
            // return redirect()->back();
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' =>  $message
            ]);

        }else{
            foreach($Category_type as $cate_id){
                // $new_vote = new Vote;
                // $new_vote -> user_id = $user->id;
                // $new_vote -> business_id = $data_business->id;
                // $new_vote -> category_id = $cate_id;
                // if($data_business->getIdState()){
                //     $new_vote -> state_id = $data_business->getIdState();
                // }else{
                //     $new_vote -> state_id = null;
                // }
               
                // if($city_id){
                //     $new_vote -> city_id = $city_id;
                // }else{
                //     $new_vote -> city_id = null;
                // }

                // /*vote = 1 vote cho business bằng 2 vote cho eat*/
                // $new_vote -> type_vote = 2;
                // $new_vote -> save();
                /*reviews eats*/
                dd($request -> image);
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
                $new_review = new Review;
                $new_review -> user_id = $user_id;
                $new_review -> business_id = $request -> business;                
                $new_review -> description = $request -> description;
                $new_review -> list_id_image = $arr_image_gallery;

                if($new_review -> save()){
                    /*update review rating*/
                    $review_rating = new Review_rating;
                    $review_rating -> user_id = $user_id;
                    $review_rating -> review_id = $new_review -> id;
                    $review_rating -> id_rate_from = $new_review -> business_id;
                    $review_rating -> category_id = $cate_id;
                    $review_rating -> type_rate = 2;
                    $review_rating -> rate = $request -> rate;
                    $review_rating -> save();
                    /*total_review*/
                    $check_total_rate = TotalRate::where('business_id','=',$new_review -> business_id)->where('category_id','=',$cate_id)->count();
                    if($check_total_rate > 0){
                        $update_total_rate = TotalRate::where('business_id','=',$new_review -> business_id)->where('category_id','=',$cate_id)->first();
                        $new_total_rate = $update_total_rate -> total_rate + $request -> rate;
                        $new_total_vote = $update_total_rate -> total_vote + 1;
                        $update_total_rate -> total_rate = $new_total_rate;
                        $update_total_rate -> total_vote = $new_total_vote;
                        $update_total_rate -> save();

                    }else{
                        foreach($data_business->business_cate as $id_cate){
                            if($cate_id == $id_cate->cate_id){
                                $rate = $request -> rate;
                                $vote = 1;
                            }else{
                                $rate = 0;
                                $vote = 0;
                            }
                            $total_review = new TotalRate;
                            $total_review -> business_id = $request -> business;
                            $total_review -> category_id = $id_cate->cate_id;
                            $total_review -> city = $city_id;
                            $total_review -> state = $data_business->getIdState();
                            $total_review -> type_rate = 2;
                            $total_review -> total_rate = $rate;
                            $total_review -> total_vote = $vote;
                            $total_review -> save();
                        }
                    }
                }
            }
            $info_business = Business::findOrfail($request->business);
            $list_review_eats = $info_business->review_rating()->where('type_rate','=',2)->paginate(Myconst::PAGINATE_ADMIN);
            $data = "";
            $view = View::make('layouts.ajax_list_review', ['list_review_eats' => $list_review_eats]);
            $data .= (string) $view;
            $message = 'You have voted and successfully evaluated';
            // return redirect()->back();
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' =>  $message
            ]);
        }

}

public function getRankBusiness(){
    $keyword = 'new ad';

            $data = Country::select('countries.*','states.name as state_name','cities.name as city_name')
            ->leftjoin('states','states.country_id','=','countries.id')
            ->leftjoin('cities','cities.state_id','=','states.id')
            ->where('code','=','US')
            ->where(function($query) use ($keyword){            
                $query->where('cities.name','LIKE', '%'.$keyword.'%')->orwhere('states.name', 'LIKE', '%'.$keyword.'%');
            })->take(20)->get();
            /*$data = Category::select('categories.*')
            ->where('category_name', 'LIKE', "%{$query}%")
            ->where('status','=',1)
            ->get();*/
            $data_state = Country::select('countries.*','states.name as state_name')
            ->leftjoin('states','states.country_id','=','countries.id')
            ->where('code','=','US')
            ->where(function($query) use ($keyword){            
                $query->where('states.name', 'LIKE', '%'.$keyword.'%');
            })->take(20)->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%;">';
            if(count($data_state)>0){
                foreach($data_state as $row_state)
                {
                    $output .= '<li class="location_name form-search-val" data-city="" data-state="'.$row_state->state_name.'">'.$row_state->state_name.'</li>';
                }
            }

            if(count($data)>0){
                foreach($data as $row)
                {
                    if($row->city_name){
                        $text = $row->city_name.', '.$row->state_name;
                    }else{
                        $text = $row->city_name;
                    }

                    $output .= '<li class="location_name form-search-val" data-city="'.$row->city_name.'" data-state="'.$row->state_name.'">'.$text.'</li>';             
                }
            }
            if(count($data) == 0 && count($data_state) == 0){

                $output .= '<li><a>'."Do Not Exist In The System".'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
                                    
                                
}
/*end knight*/

public function eat_rank(){
    $user = Auth::user();
    $list_vote_eat = Auth::user()->votes()->where('type_vote',2)->get();
    return view('layouts_profile.eat-rank',compact('list_vote_eat','user'));
}
public function business_rank(){
    $user = Auth::user();
    $list_vote_business = Auth::user()->votes()->groupBy('business_id')->get();

    return view('layouts_profile.business-rank',compact('list_vote_business','user'));
}

public function my_businesses(Request $request){
    $user = Auth::user();
    $new = new Business;
    $check =  $new ->checkListMyBusiness($request->business_id);
    if($check){
        $info_business = Business::findOrfail($request->business_id);
        $reviews = $info_business->Review_Business_Rating()->join('users','users.id','=','review__business__ratings.user_id')
                                               ->where('type_rate','=',1)
                                               ->whereNull('users.deleted_at')
                                               ->paginate(Myconst::PAGINATE_ADMIN);

        return view('layouts_profile.my-businesses',compact('info_business','user','reviews'));
    }else{
        session()->put('error','You do not own this business');
        return redirect()->back();
    }
}

public function ajaxcitystate(Request $request){
    $state_id = $request->id;
    // dd($state_id);
    $citys = City::select('cities.*')
    ->where('state_id','=',$state_id)->get();

    $output = '<option value="" selected >Select City</option>';
    if(count($citys)>0){
        foreach($citys as $city){
            // dd($city->name);
            $output .= '<option value="'.$city->id.'" >'.$city->name.'</option>';             
        }
    }

    return response()->json([
        'success' => true,
        'data' => $output
    ]);

}

public function reaction_review(Request $request){

    $user = Auth::user();
    if(!$user){
        return response()->json([
            'success' => false,
            'message' => "You need to login!!!"
        ]);
    }else{

        $reaction = ReviewReaction::where('user_id','=',$user->id)->where('review_id','=',$request->review_id)->first();
        if($reaction){
            $reaction_update = ReviewReaction::where('user_id',$user->id)
                                                ->where('review_id',$request->review_id)
                                                ->update(['type' => $request->type]);
        }else{
            $new_reaction = new ReviewReaction;
            $new_reaction -> user_id = $user->id;
            $new_reaction -> review_id = $request->review_id;
            $new_reaction -> type = $request->type;
            $new_reaction -> save();
        }
        return response()->json([
            'success' => true
        ]);  
    }

    
}

// review popup

    public function review_search(Request $request)
    {
        $business = Business::find($request->id);
        $category_id = $request->category_id;
        $category_name = Category::find($category_id)->category_name;
        $reviews = $business->review_rating()->join('users','users.id','=','review_ratings.user_id')
                                             ->where('type_rate','=',2)
                                             ->where('category_id','=',$category_id)
                                             ->whereNull('users.deleted_at')
                                             ->orderBy('review_ratings.created_at', 'desc')
                                             ->paginate(Myconst::PAGINATE_ADMIN);
         
    
                                           
        if(count($reviews) == 0){
            return response()->json([
            'success' => false,
            'message' => "Don't have review for"
        ]);
        }
        $data = "";
        $view = View::make('layouts.review-popup', ['reviews' => $reviews, 'business' => $business,'category_name' => $category_name ]);
        $data .= (string) $view;
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
// show photo popup

    public function show_photo(Request $request)
    {
        $user_id = $request->user_id;
        $data_img = Media::where('id_user',$user_id )->where('type',2)->get();
        if($data_img->count() > 0){
            $data = "";
            foreach ($data_img as $value) {
                $item= asset('').'storage/'.$value -> url;
                $data .= '<li class="" data-responsive="">
                                <a href="javascript:;" class="lightbox">
                                    
                                    <img width="210" height="145" src="'.$item.'" class="pic" >
                                </a>       
                            </li>';
            }
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }else{
            return response()->json([
                'success' => false
            ]);
        }

    }


    public function userProfile($id)
    {   
        if(Auth::id() == $id){
            return redirect()->route('myprofile');
        }
        $user = User::find($id);
        
        // dd($target_user);
        if ($user) {
            $list_reviews = Review_Business_Rating::where('review__business__ratings.user_id','=',$id)
               ->join('businesses','businesses.id','=','review__business__ratings.id_rate_from')
               ->where('type_rate','=',1)
               ->whereNull('businesses.deleted_at')
               ->orderBy('review__business__ratings.created_at', 'desc')
               ->paginate(Myconst::PAGINATE_ADMIN);
            
            $data_business = $user->businesses()->paginate(Myconst::PAGINATE_ADMIN);
            return view('layouts_profile.myprofile', compact('user','list_reviews','data_business'));
        }else {
            return abort(404);
        }
    }

    public function userBusinessReview($id)
    {   
        if(Auth::id() == $id){
            return redirect()->route('business_review');
        }
        $user = User::find($id);
        
        // dd($target_user);
        if ($user) {
           $list_reviews = Review_Business_Rating::where('review__business__ratings.user_id','=',$id)
               ->join('businesses','businesses.id','=','review__business__ratings.id_rate_from')
               ->where('type_rate','=',1)
               ->whereNull('businesses.deleted_at')
               ->orderBy('review__business__ratings.created_at', 'desc')
               ->paginate(Myconst::PAGINATE_ADMIN);
            return view('layouts_profile.business-review',compact('list_reviews','user'));

        }else {
            return abort(404);
        }
    }

    public function userEatReviews($id)
    {   
        if(Auth::id() == $id){
            return redirect()->route('eat_reviews');
        }
        $user = User::find($id);
        
        // dd($target_user);
        if ($user) {
           $list_review_eats = Review_rating::where('review_ratings.user_id','=',$id)
                                               ->join('businesses','businesses.id','=','review_ratings.id_rate_from')
                                               ->where('type_rate','=',2)
                                               ->whereNull('businesses.deleted_at')
                                               ->orderBy('review_ratings.created_at', 'desc')
                                               ->paginate(Myconst::PAGINATE_ADMIN);

            return view('layouts_profile.eat-review',compact('list_review_eats','user'));
            
        }else {
            return abort(404);
        }
    }

    public function userBusinessRank($id)
    {   
        if(Auth::id() == $id){
            return redirect()->route('business_rank');
        }
        $user = User::find($id);
        
        // dd($target_user);
        if ($user) {
           $list_vote_business = $user->votes()->where('type_vote',1)->get();

            return view('layouts_profile.business-rank',compact('list_vote_business','user'));
            
        }else {
            return abort(404);
        }
    }

    public function userEatRank($id)
    {   
        if(Auth::id() == $id){
            return redirect()->route('eat_rank');
        }
        $user = User::find($id);
        
        // dd($target_user);
        if ($user) {
            $list_vote_eat = $user->votes()->where('type_vote',2)->get();
            return view('layouts_profile.eat-rank',compact('list_vote_eat','user'));
            
        }else {
            return abort(404);
        }
    }


    // search state

        /*fetchCityState*/
    public function searchstate(Request $request){
        if($request->get('query'))
        {
            $keyword = $request->get('query');

            $data = Country::select('countries.*','states.name as state_name','states.id as state_id')
            ->leftjoin('states','states.country_id','=','countries.id')
            ->where('code','=','US')
            ->where(function($query) use ($keyword){            
                $query->where('states.name', 'LIKE', '%'.$keyword.'%');
            })->get();
            /*$data = Category::select('categories.*')
            ->where('category_name', 'LIKE', "%{$query}%")
            ->where('status','=',1)
            ->get();*/
            $output = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%;">';
            if(count($data)>0){
                foreach($data as $row)
                {
                    

                    $output .= '<li class="state_name form-search-val" data-state="'.$row->state_id.'">'.$row->state_name.'</li>';             
                }
            }else{
                $output .= '<li><a>'."Do Not Exist In The System".'</a></li>';   
            }
            
            $output .= '</ul>';
            echo $output;
        }
    }
        public function searchcity(Request $request){
            // return response()->json([
            //     'data' => $request->state_id
            // ]); 
            
            if($request->get('query'))
            {
                $keyword = $request->get('query');

                $data = Country::select('countries.*','cities.name as city_name','cities.id as city_id')
                ->leftjoin('states','states.country_id','=','countries.id')            
                ->leftjoin('cities','cities.state_id','=','states.id')
                ->where('state_id','=',$request->get('state_id'))
                ->where('code','=','US')
                ->where(function($query) use ($keyword){            
                    $query->where('cities.name', 'LIKE', '%'.$keyword.'%');
                })->get();

                $output = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%;">';
                if(count($data)>0){
                    foreach($data as $row)
                    {
                        $output .= '<li class="city_name form-search-val" data-city="'.$row->city_id.'">'.$row->city_name.'</li>';             
                    }
                }else{
                    $output .= '<li><a>'."Do Not Exist In The System".'</a></li>';   
                }
                
                $output .= '</ul>';
                echo $output;
            }


        }
        public function ajaxPagination(Request $request){
            $business = Business::find($request->business_id);
            $limit =Myconst::PAGINATE_ADMIN;
            $page = $request->page;
            $category_id = $request->category_id;
            $offset = ($page - 1)*$limit;
            if($category_id == null){
                $reviews = $business->Review_Business_Rating()->join('users','users.id','=','review__business__ratings.user_id')
                                               ->where('type_rate','=',1)
                                               ->whereNull('users.deleted_at')
                                               ->offset($offset)->limit($limit)
                                               ->paginate($limit);
            }else{
                $reviews = $business->review_rating()->join('users','users.id','=','review_ratings.user_id')
                                             ->where('type_rate','=',2)
                                             ->where('category_id','=',$category_id)
                                             ->whereNull('users.deleted_at')
                                             ->orderBy('review_ratings.created_at', 'desc')
                                             ->offset($offset)->limit($limit)
                                             ->paginate($limit);
            }
            
            $data = "";
            $view = View::make('layouts.review-popup', ['reviews' => $reviews]);
            $data .= (string)$view;                                 

            return response()->json([
                'data' => $data
            ]); 
        }

}