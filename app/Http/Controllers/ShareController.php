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
    /*img review*/
     public function saveImgReviewBase64($param, $folder)
    {
        list($extension, $content) = explode(';', $param);
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
    /*loc tu xau*/
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
     // function to geocode address, it will return false if unable to geocode address
    public function geocode($address = null){
        
        $key = "AIzaSyDFcWBzDgQB3BwTypguTAGeptF1cnQ1lHQ";

        // url encode the address
        $address = urlencode($address);
         
        // google map geocode api url
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$key}";
     
        // get the json response
        $resp_json = file_get_contents($url);
         
        // decode the json
        $resp = json_decode($resp_json, true);
        // response status will be 'OK', if able to geocode given address 
        if($resp['status']=='OK'){
     
            // get the important data
            $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
            $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
             
            // verify if data is complete
            if($lati && $longi && $formatted_address){
             
                // put the data in the array
                $data_arr = array();            
                 
                array_push(
                    $data_arr, 
                        $lati, 
                        $longi, 
                        $formatted_address
                    );
                 
                return $data_arr;
                 
            }else{
                return false;
            }
             
        }
     
        else{
           return $resp['results'];
        }
    }
}
