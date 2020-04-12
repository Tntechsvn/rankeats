<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Myconst;
use App\PlanDetail;
use App\LanguageReview;
use App\Http\Controllers\ShareController;
use Validator;
class LanguageController extends Controller
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
    public function getListLanguageReviews(Request $request){
    	$keyword = $request -> keyword ? $request -> keyword : '';
        $data_lang = LanguageReview::where(function($query) use ($keyword){            
            $query->where('bad_word', 'LIKE', '%'.$keyword.'%')->orwhere('replace_word', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  $data_lang ->total();
        $count_record = count($data_lang);
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
        return view('admin.language_review.getListLanguageReviews',compact('data_lang','start', 'record', 'total_record','keyword'));
    }
    public function postCreateLanguageReview(Request $request){
    	 $this-> Validate($request,[
            'bad_word' => 'required|unique:language_reviews,bad_word',
            'replace_word' =>'required',
        ]);
    	$new_lang = new LanguageReview;
    	$new_lang -> bad_word = $request -> bad_word;
    	$new_lang -> replace_word = $request -> replace_word;
    	if($new_lang -> save()){
    		session()->put('success','create success');
    		return redirect()->back();
    	}else{
    		session()->put('error','create error');
    		return redirect()->back();
    	}
    	
    }
    public function postDeleteLanguageReview(Request $request){
    	$Arr_list = explode(',', $request->list_id);

        foreach($Arr_list as $lang_id){
            $lang_del = LanguageReview::findOrFail($lang_id);
            if($lang_del){
                $lang_del -> delete();
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Language does not exist',
                ], 200);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Delete Language Reviews success',
        ], 200);

    }
    
    
}
