<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Myconst;
use App\Country;
use App\City;
use App\State;

class LocationController extends Controller
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
    public function getListCountry(Request $request){
        $keyword = $request -> keyword ? $request -> keyword : '';
        $data_countries = Country::select('countries.*')
        ->where(function($query) use ($keyword){            
            $query->where('code', 'LIKE', '%'.$keyword.'%')->orwhere('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('name', 'asc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  $data_countries ->total();
        $count_record = count($data_countries);
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
        return view('admin.country.getListCountry',compact('data_countries','start', 'record', 'total_record','keyword'));
    }
    public function postCreateCountry(Request $request){
        $this-> Validate($request,[
            'phonecode' => 'required|unique:countries,phonecode',
            'name' => 'required|unique:countries,name',
            'code' => 'required|unique:countries,code',
            
        ]);
        $create = new Country;
        $data = $create -> update_country($request);
        return redirect()->back();

    }
    public function getEditCountry(Request $request){
        $edit_country = Country::findOrfail($request -> country_id);

        $keyword = $request -> keyword ? $request -> keyword : '';
        $data_countries = Country::select('countries.*')
        ->where(function($query) use ($keyword){            
            $query->where('code', 'LIKE', '%'.$keyword.'%')->orwhere('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('name', 'asc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  $data_countries ->total();
        $count_record = count($data_countries);
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
        return view('admin.country.getEditCountry',compact('data_countries','start', 'record', 'total_record','keyword','edit_country'));

    }
    public function postEditCountry(Request $request){
        $edit_country = Country::findOrfail($request -> country_id);
        $this-> Validate($request,[
            'name' => 'required|unique:countries,name,'.$edit_country->id,
            'code' => 'required|unique:countries,code,'.$edit_country->id,
            'phonecode' => 'required',
            
        ]);

        $edit_country -> update_country($request);
        return redirect()->back();

    }
    public function getListState(Request $request){
        $keyword = $request -> keyword ? $request -> keyword : '';
        $data_states = State::select('states.*')
        ->where(function($query) use ($keyword){            
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('name', 'asc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  $data_states ->total();
        $count_record = count($data_states);
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
        $list_country = Country::all();
        return view('admin.state.getListState',compact('data_states','start', 'record', 'total_record','keyword','list_country'));

    }
    public function postCreateState(Request $request){
        $this-> Validate($request,[
            'name' => 'required',
            'country_id' => 'required',

        ]);
        $create = new State;
        $data = $create -> update_state($request);
        return redirect()->back();
    }
    public function getEditState(Request $request){
        $edit_state= State::findOrfail($request -> state_id);
        $keyword = $request -> keyword ? $request -> keyword : '';
        $data_states = State::select('states.*')
        ->where(function($query) use ($keyword){            
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('name', 'asc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  $data_states ->total();
        $count_record = count($data_states);
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
        $list_country = Country::all();
        return view('admin.state.getEditState',compact('data_states','start', 'record', 'total_record','keyword','list_country','edit_state'));

    }
    public function postEditState(Request $request){
         $this-> Validate($request,[
            'name' => 'required',
            'country_id' => 'required',

        ]);
        $edit_state= State::findOrfail($request -> state_id);
        $data = $edit_state -> update_state($request);
        return redirect()->back();

    }
    /*city*/
    public function getListCity(Request $request){
        $keyword = $request -> keyword ? $request -> keyword : '';
        $data_city = City::select('cities.*')
        ->where(function($query) use ($keyword){            
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('name', 'asc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  $data_city ->total();
        $count_record = count($data_city);
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
        $Country = Country::where('code','=','US')->first();
        $list_state = $Country->states()->get();
        return view('admin.city.getListCity',compact('data_city','start', 'record', 'total_record','keyword','list_state'));

    }
    public function postCreateCity(Request $request){
        $this-> Validate($request,[
            'name' => 'required',
            'state_id' => 'required',
        ]);
        $create = new City;
        $data = $create -> update_city($request);
        return redirect()->back();
    }
     public function getEditCity(Request $request){
        $edit_city= City::findOrfail($request -> city_id);
        $keyword = $request -> keyword ? $request -> keyword : '';
        $data_city = City::select('cities.*')
        ->where(function($query) use ($keyword){            
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('name', 'asc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  $data_city ->total();
        $count_record = count($data_city);
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
        $list_state = State::all();
        return view('admin.city.getEditCity',compact('data_city','start', 'record', 'total_record','keyword','list_state','edit_city'));

    }
    public function postEditCity(Request $request){
         $this-> Validate($request,[
            'name' => 'required',
            'state_id' => 'required',

        ]);
        $edit_city= City::findOrfail($request -> city_id);
        $data = $edit_city -> update_city($request);
        return redirect()->back();

    }
}
