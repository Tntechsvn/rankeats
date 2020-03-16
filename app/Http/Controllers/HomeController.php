<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Business;
use App\Review;
use App\Myconst;
use View;
use Auth;
class HomeController extends Controller
{
    public function __construct(){
        $category = Category::All();
        view()->share(['category'=>$category]);
    }

    public function home(){
        return view('layouts.index');
    }

    public function search(Request $request){
        $keyword = $request -> keyword ? $request -> keyword : '';
        $list_cate = Category::join('businesses_categories','cate_id','=','categories.id')
        ->where(function($query) use ($keyword){            
            $query->where('category_name', 'LIKE', '%'.$keyword.'%');
        })
        ->groupBy('businesses_categories.business_id')
        ->paginate(2);       
        $arr_business_id = $list_cate ->pluck('business_id');
        $data_business = $this -> getbusinessCate($arr_business_id);
       // return $data_business;
        return view('layouts.search',compact('data_business','list_cate'));
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
        $business_id = Auth::user()->business()->first()->id;
        /*list reviews for business*/
        $list_reviews = Review::select('reviews.*')
        /*->where(function($query) use ($keyword){            
            $query->where('name', 'LIKE', '%'.$keyword.'%')->orwhere('name', 'LIKE', '%'.$keyword.'%');
        })*/
        ->where('business_id','=',$business_id)
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);
        /*info restaurant*/
        $info_business = Auth::user()->business()->first();
        /*category*/
        $category = Category::All();
        return view('layouts_profile.business-management',compact('list_reviews','info_business','category'));
    }



}
