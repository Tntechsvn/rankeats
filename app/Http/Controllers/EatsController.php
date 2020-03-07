<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
use App\Category;
use App\Myconst;
use App\Http\Controllers\ShareController;
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
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  Category::count();
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
    public function postCreateEats(Request $request){
        $create = new Category;
        $create -> update_category($request);
        return redirect()->back();
    }
    public function getEditEats($id_eat){
        $data_eat = Category::findorfail($id_eat);
        return view('admin.eats.edit_eats',compact('data_eat'));
    }
    public function postEditEats(Request $request){
        $data_eat = Category::findorfail($request->id_eat);
        $data_eat -> update_category($request);
        return redirect()->back();
    }
   
}
