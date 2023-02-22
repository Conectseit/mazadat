<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index()
    {
        $data['blogs'] = Blog:: latest()->get();
        return view('Dashboard.blogs.index', $data);
    }


    public function create()
    {
        $data['categories'] = Category::all();
        return view('Dashboard.blogs.create', $data);
    }

    public function store(BlogRequest $request)
    {

        $request_data = $request->except(['image','image2']);

        if ($request->image) $request_data['image'] = uploaded($request->image, 'blog');
        if ($request->hasFile('image2')) {
            $request_data['image2'] = uploaded($request->image2, 'blog');
        }
        Blog::create($request_data);
        return redirect()->route('blogs.index')->with('message', translated('add', 'blog'));
    }




    public function edit($id)
    {
        if (!Blog::find($id)) {
            return redirect()->route('blogs.index')->with('class', 'danger')->with('message', trans('messages.messages.try_2_access_not_found_content'));
        }
        $data['blog'] = Blog::find($id);
        return view('Dashboard.blogs.edit', $data);
    }


    public function update(BlogRequest $request, Blog$blog)
    {
        $request_data = $request->except('image','image2');
        if ($request->hasFile('image')) {
            if (!is_null($blog->image)) unlink('uploads/blogs/' . $blog->image);
            $request_data['image'] = uploaded($request->image, 'blog');
        }

        if ($request->hasFile('image2')) {
            if (!is_null($blog->image2)) unlink('uploads/blogs/' . $blog->image2);
            $request_data['image2'] = uploaded($request->image2, 'blog');
        }
        $blog->update($request_data);

        return redirect()->route('blogs.index')->with('message', trans('messages.messages.updated_successfully'));
    }



    public function destroy(Request $request, Blog$blog)
    {
        $blog = Blog::find($request->id);
        if (!$blog) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, user is not exists !!']);
        try {
            if (!is_null($blog->image)) unlink('uploads/blogs/' . $blog->image);
            $blog->delete();

            return response()->json(['deleteStatus' => true, 'message' => translated('delete','user')]);

        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }




}
