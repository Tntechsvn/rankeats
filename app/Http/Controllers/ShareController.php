<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
use App\Category;
use App\LanguageReview;
class ShareController extends Controller
{
    
    /*upload image*/
    public function saveImgBase64($param, $folder)
    {
        foreach($param as $img){
            list($extension, $content) = explode(';', $img);
            $tmpExtension = explode('/', $extension);
            preg_match('/.([0-9]+) /', microtime(), $m);
            $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
            $content = explode(',', $content)[1];
            $storage = Storage::disk('public');

            $checkDirectory = $storage->exists($folder);

            if (!$checkDirectory) {
                $storage->makeDirectory($folder);
            }

            $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');

            return $folder . '/' . $fileName;
        }
        
    }
    public function badWordFilter($data){
        $originals = LanguageReview::pluck('bad_word')->toArray();
        $data = explode(" ",$data);
        $data_intersect = array_intersect($data,$originals);
        if($data_intersect){
            $result = '"'.implode(',',$data_intersect).'"';
        }else{
             $result = null;
        }
        
        return $result;
    }
}
