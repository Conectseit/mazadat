<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PageImageRequest;
use App\Http\Requests\Dashboard\PageRequest;
use App\Models\Page;
use App\Models\Category;
use App\Models\PageImage;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index()
    {
        $data['pages'] = Page:: latest()->get();
        return view('Dashboard.pages.index', $data);
    }


    public function create()
    {
        $data['categories'] = Category::all();
        return view('Dashboard.pages.create', $data);
    }

    public function store(PageRequest $request)
    {
        $request_data = $request->except(['main_image']);

//        if ($request->main_image) $request_data['main_image'] = uploaded($request->main_image, 'page');

        if ($request->hasFile('main_image')) {
            $request_data['main_image'] = uploaded($request->main_image, 'page');
        }
        Page::create($request_data);
        return redirect()->route('pages.index')->with('message', translated('add', 'page'));
    }




    public function edit($id)
    {
        if (!Page::find($id)) {
            return redirect()->route('pages.index')->with('class', 'danger')->with('message', trans('messages.messages.try_2_access_not_found_content'));
        }
        $data['page'] = Page::find($id);

        return view('Dashboard.pages.edit', $data);
    }


    public function update(PageRequest $request, Page$page)
    {
        $request_data = $request->except('main_image');
        if ($request->hasFile('main_image')) {
            if (!is_null($page->main_image)) unlink('uploads/pages/' . $page->main_image);
            $request_data['main_image'] = uploaded($request->main_image, 'page');
        }

        $page->update($request_data);

        return redirect()->route('pages.index')->with('message', trans('messages.messages.updated_successfully'));
    }

    public function show($id)
    {
        $data['page'] = Page::find($id);
        $data['page_images'] = PageImage::where(['page_id' => $id])->get();
        return view('Dashboard.pages.show', $data);
    }

    public function addImage(PageImageRequest $request)
    {
        $request_data = $request->except(['image']);

        if ($request->hasFile('image')) {
            $request_data['image'] = uploaded($request->image, 'page');
        }
        PageImage::create($request_data +['description_ar'=>$request->description_ar,'description_en'=>$request->description_en]);
        return redirect()->route('pages.index')->with('message', translated('add', 'page'));
    }

    public function deleteImage(Request $request)
    {
        $pageimage = PageImage::find($request->id);

        if (!$pageimage) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, image is not exists !!']);
        try {
            $pageimage->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }

    public function destroy(Request $request, Page$page)
    {
        $page = Page::find($request->id);
        if (!$page) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, page is not exists !!']);
        try {
            if (!is_null($page->main_image)) unlink('uploads/pages/' . $page->main_image);
            $page->delete();

            return response()->json(['deleteStatus' => true, 'message' => translated('delete','user')]);

        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }




}
