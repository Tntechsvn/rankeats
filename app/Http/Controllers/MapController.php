<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Myconst;
use App\PlanDetail;
use Arr;
use Str;
use Config;
use File;
use Validator;

class MapController extends Controller
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
    public function getMapSetting(){
        $c = Config::get('keymap');
        //return $c['keymap'] ;
        $c = json_decode(json_encode($c));
        return view('admin.google_map.setKeyMap', compact('c'));
    }
    public function postMapSetting(Request $request){
        $this-> Validate($request,[
            'keymap' => 'required',          
        ],
        [
            'keymap.required'=>'The Key Map id field is required',
            
        ]);

       
        $c = Config::get('keymap');
        $c['keymap'] = $request -> keymap;

        $arr = (array)$c;
        $data = var_export($arr, 1);
        if(File::put(base_path() . '/config/keymap.php', "<?php\n return $data ;")) {
            return redirect()->back();
        }
    }
    
}
