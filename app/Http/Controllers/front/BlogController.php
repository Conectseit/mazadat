<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Auction;
use App\Models\Blog;
use App\Models\Category;
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
        $data['pages'] = Blog::all();
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

        $data['page_details'] = Blog::where('id',$id)->first();

        $description= 'description_'.app()->getLocale();
        $data['description'] =  $data['page_details']->$description ;

        $data['related_pages'] = Blog::where('category_id',$data['page_details']->category->id)->take(3)->get();

        return view('front.general.page_details', $data);
    }


}
