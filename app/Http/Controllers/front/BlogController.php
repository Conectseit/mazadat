<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Auction;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Page;
use App\Models\PageImage;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{



    public function show_blogs()
    {
        return view('front.general.show_blogs');
    }
    public function blogs()
    {
        $data['blogs'] = Blog::all();
        return view('front.general.blogs', $data);
    }

    public function pages()
    {
        $data['pages'] = Page::all();
        return view('front.general.pages', $data);
    }

    public function blog_details($id)
    {

        $data['blog_details'] = Blog::where('id',$id)->first();

        $description= 'description_'.app()->getLocale();
        $data['description'] =  $data['blog_details']->$description ;

        $data['related_blogs'] = Blog::where('category_id',$data['blog_details']->category->id)->take(3)->get();

        return view('front.general.blog_details', $data);
    }

    public function page_details($id)
    {

        $data['page_details'] = Page::where('id',$id)->first();

        $data['description'] = 'description_'.app()->getLocale();

        $data['related_pages'] = Page::where('category_id',$data['page_details']->category->id)->take(3)->get();
        $data['page_images'] = PageImage::where(['page_id' => $id])->get();


        return view('front.general.page_details', $data);
    }


}
