<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
use App\Page;
use App\Myconst;
use Validator;
class PageController extends Controller
{

    public function getListPage(Request $request)
    {
       $keyword = $request -> keyword ? $request -> keyword : '';
        $data_pages = Page::select('pages.*')
        ->where(function($query) use ($keyword){            
            $query->where('page_title', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('ordinarily', 'asc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  Page::count();
        $count_record = count($data_pages);
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

        return view('admin.pages.getListPage', compact('start', 'record', 'total_record','data_pages','keyword'));
        
    }
    public function getCreatePage(){
    	return view('admin.pages.CreatePage');
    }
    public function postCreatePage(Request $request){
    	$this-> Validate($request,[
			'page_title' => 'required|unique:pages,page_title',
			'page_content' => 'required',
		
		]);
		$page = new Page;
    	$data = $page-> update_page($request);
    	if($data){
    		session()->put('success','success');            
    	}else{
    		session()->put('error','error');
    	}
    	return redirect()->back();
    }
    public function getEditPage(Request $request){
    	$info_page = Page::findBySlugOrFail($request -> id_page);
    	return view('admin.pages.CreatePage',compact('info_page'));

    }
    public function postEditPage(Request $request){
    	$edit_pages = Page::findBySlugOrFail($request -> id_page);

    	$this-> Validate($request,[
			'page_title' => 'required|unique:pages,page_title,'.$edit_pages->id,
			'page_content' => 'required',
		
		]);

    	$data = $edit_pages-> update_page($request);
    	if($data){
    		session()->put('success','success');            
    	}else{
    		session()->put('error','error');
    	}
    	$info_page = Page::findBySlugOrFail($data -> slug);
    	return view('admin.pages.CreatePage',compact('info_page'));

    }
    public function deletePages(Request $request){
    	$list_pages = $request->list_id;
		$arr_pages = explode(',', $list_pages);
		foreach($arr_pages as $val){
			$pages_del = Page::findOrFail($val);
			if($pages_del){
				$pages_del->delete();
				return "Success";
			}else{
				return "error";
			}
		}
		
    }
}
