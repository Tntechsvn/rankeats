<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Page;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class UpdateSlugPage extends Command
{
   
    protected $signature = 'haipit:update:slug';

    protected $description = 'update slug page';

    public function handle():void
    {
    	//chạy lệnh ./artisan haipit:update:slug
       /* xóa bảng page*/
    	$delete_all_page = DB::table('pages')->delete();
        /*thêm thông tin page*/

        $array_pages = array(' About Us', 'Privacy Policy','Terms of Use','Advertise');
        $i=1;
        foreach ($array_pages as $page)
        {
            DB::table('pages')->insert([
                'page_content'      => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor lobortis tortor sit amet auctor. Praesent pretium, leo eget luctus tempor, lectus erat vulputate libero, in viverra dolor velit quis ante. Vivamus viverra pulvinar sollicitudin. Vivamus dictum orci sed lorem venenatis quis rutrum risus dictum. Ut non enim elit. In consectetur, nibh sed iaculis pellentesque, nisi ligula egestas enim, sagittis fermentum nulla nisl sit amet velit. Aliquam erat volutpat. Suspendisse ac mi tortor, at vestibulum augue. Suspendisse ut nisl quam, euismod scelerisque urna. Donec non leo et nisi tempus fermentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec gravida sodales est vitae tincidunt.',
                'page_title'   => $page,
                'ordinarily' => $i,
                'slug' => SlugService::createSlug(Page::class, 'slug', $page),
                'created_at'=> now(),
            ]);
            $i++;
        }
    }
}
