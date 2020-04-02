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
use App\Vote;
use App\Page;
use App\State;
use App\City;
use App\Country;

class HomeController extends Controller{

    public function __construct(){

        $Country = Country::where('code','=','US')->first();
        $state =  $Country->states()->get();

        $this->user = Auth::user();
        $category = Category::where('status','=',1)->get();
        $all_page = Page::all();
        view()->share(['category'=>$category,'all_page'=>$all_page,'user'=> $this->user,'state'=>$state]);
    }

    public function home(){
        $category = Category::where('status','=',1)->take(9)->get();
        return view('layouts.index',compact('category'));
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
            })->get();
            /*$data = Category::select('categories.*')
            ->where('category_name', 'LIKE', "%{$query}%")
            ->where('status','=',1)
            ->get();*/
            $output = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%;">';
            if(count($data)>0){
                foreach($data as $row)
                {
                    if($row->city_name){
                        $text = $row->city_name.' or '.$row->state_name;
                    }else{
                        $text = $row->state_name;
                    }

                    $output .= '<li class="location_name form-search-val">'.$text.'</li>';             
                }
            }else{
                $output .= '<li><a>'."Do Not Exist In The System".'</a></li>';   
            }
            
            $output .= '</ul>';
            echo $output;
        }
    }
    public function search(Request $request){
        $keyword = $request -> keyword ? $request -> keyword : '';
        $city = $request -> city ? $request -> city : $request -> state;
        $state_search = $request -> state ? $request -> state : '';


        $data_business_sponsored =  Business::select('categories.category_name','categories.status','businesses_categories.business_id','businesses.*','locations.city','locations.state')
        ->JoinLocation()->JoinBusinessesCategory()->JoinCategory()
        ->where(function($query) use ($keyword,$city,$state_search){            
            $query->where('category_name', 'LIKE', '%'.$keyword.'%')->where('city','LIKE', '%'.$city.'%')->orwhere('category_name', 'LIKE', '%'.$keyword.'%')->Where('state','LIKE', '%'.$state_search.'%');
        })
        ->where('status','=',1)
        ->groupBy('businesses_categories.business_id')->take(2)->get();
        /*list all Results*/

        $data_business = Business::select('categories.category_name','categories.status','businesses_categories.business_id','businesses.*','locations.city','locations.state')
        ->JoinLocation()->JoinBusinessesCategory()->JoinCategory()
        ->where(function($query) use ($keyword,$city,$state_search){            
            $query->where('category_name', 'LIKE', '%'.$keyword.'%')->where('city','LIKE', '%'.$city.'%')->orwhere('category_name', 'LIKE', '%'.$keyword.'%')->Where('state','LIKE', '%'.$state_search.'%');
        })
        ->where('status','=',1)
        ->groupBy('businesses_categories.business_id')
        ->paginate(Myconst::PAGINATE_ADMIN);
//return $data_business;
        $category_search = Category::where('category_name','=',$keyword)->first();

        return view('layouts.search',compact('data_business','data_business_sponsored','keyword','city','state_search','category_search'));
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


        $output = '<option value="" disabled selected >Select City</option>';
        if(count($data)>0){
            foreach($data as $row)
            {
                $output .= '<option value="'.$row->name.'" >'.$row->name.'</option>';             
            }
        }
        echo $output;
    }

}
public function sign_up(){
    $Country = Country::where('code','=','US')->first();
    $state =  $Country->states()->get();
    return view('layouts.register',compact('state'));
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
 $category = Category::where('status','=',1)->get();

 return view('layouts_profile.info-management',compact('info_business','category'));
}
public function advertise(){
    $plan_details = new PlanDetail;
    return view('layouts.advertise', compact('plan_details'));
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
    $data_business = Auth::user()->businesses()->paginate(Myconst::PAGINATE_ADMIN);
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
    if(Auth()){
        $user_id = Auth::id();
        /*list reviews for business*/
        $list_reviews = Review::select('reviews.*')
        ->where('user_id','=',$user_id)
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        return view('layouts_profile.eat-review',compact('list_reviews'));
    }else{
        return view('layouts.index');
    }
    
}
/*single_restaurent*/
public function single_business(Request $request){
    $info_business = Business::findOrfail($request -> id_business);
    $list_reviews = $info_business->review()->paginate(Myconst::PAGINATE_ADMIN);
    return view('layouts.single-business',compact('info_business','list_reviews'));
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

public function vote_ajax(Request $request){
    $user = Auth::user();
    $vote = Vote::select('*')
    ->where('user_id','=',$user->id)
    ->where('business_id','=',$request->business)
    ->first();
    $data_business = Business::find($request->business);
    $city_id = $data_business->location->IdCity;
    if($vote){
        return response()->json([
            'success' => false,
            'message' => "Would you like to change your vote?"
        ]);
    }else{
        $check_vote_city = Vote::where('user_id','=',$user->id)->where('type_vote','=',1)->where('city_id','=',$city_id)->first();
        if($check_vote_city ){
             $delete = Vote::where('user_id','=',$user->id)->where('type_vote','=',1)->where('city_id','=',$city_id)->delete();
             $new_vote = new Vote;
             $new_vote -> user_id = $user->id;
             $new_vote -> business_id = $data_business->id;
             $new_vote -> state_id = $data_business->location->IdState;
             $new_vote -> city_id = $city_id;

             /*vote = 1 vote cho business bằng 2 vote cho eat*/
             $new_vote -> type_vote = 1;
             $new_vote -> save();

             return response()->json([
                'success' => true
            ]);

        }else{
            
            $new_vote = new Vote;
            $new_vote -> user_id = $user->id;
            $new_vote -> business_id = $data_business->id;
            $new_vote -> state_id = $data_business->location->IdState;
            $new_vote -> city_id = $city_id;
            
            /*vote = 1 vote cho business bằng 2 vote cho eat*/
            $new_vote -> type_vote = 1;
            $new_vote -> save();

            return response()->json([
                'success' => true
            ]);
        }
        
    }

}


public function eat_rank(){
    return view('layouts_profile.eat-rank');
}
public function business_rank(){
    return view('layouts_profile.business-rank');
}
public function business_review(){
    return view('layouts_profile.business-review');
}
public function my_businesses(){
    $info_business = Auth::user()->business()->first();
    return view('layouts_profile.my-businesses',compact('info_business'));
}

public function ajaxcitystate(Request $request){
    $state_id = $request->id;

    $citys = City::select('cities.*')
    ->where('state_id','=',$state_id)->get();
    // dd($city);
    // $data = $state->cities()->get();

    $output = '<option value="" selected >Select City</option>';
    if(count($citys)>0){
        foreach($citys as $city){
            $output .= '<option value="'.$city->name.'" >'.$city->name.'</option>';             
        }
    }

    return response()->json([
        'success' => true,
        'data' => $output
    ]);

}



}
