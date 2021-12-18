<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CategoryController extends Controller
{

    public function index()
    {
         $data['categories'] = Category::latest()->paginate(200);
//        $data['categories'] = Category::select('id',
//            'image',
//            'created_at',
//            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
//            'description_' . LaravelLocalization::getCurrentLocale() . ' as description',
//        )->latest()->get();
        return view('Dashboard.Categories.index', $data);
    }


    public function create()
    {
        $data['latest_categories'] = Category::orderBy('id', 'desc')->take(5)->get();
        return view('Dashboard.Categories.create', $data);
    }

    public function store(CategoryRequest $request)
    {
        $request_data = $request->except([ 'image']);

        if ($request->image) $request_data['image'] =  uploaded($request->image, 'category');
         $category= Category::create($request_data);
        return redirect()->route('categories.index')->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (!Category::find($id)) {
            return redirect()->route('categories.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $data['latest_categories'] = Category::orderBy('id', 'desc')->take(5)->get();
        $data['category'] = Category::find($id);
        return view('Dashboard.Categories.edit', $data);
    }


    public function update(CategoryRequest $request, $id)
    {
        $request_data = $request->except('image');

        if ($request->image) {
            File::delete('public/uploads/categories/' . $request->image);

            $request_data['image'] = uploaded($request->image, 'category');
        }
//        $category->update($request_data);

        Category::find($id)->update($request_data);
        return redirect()->route('categories.index')->with('success', 'تم تعديل القسم بنجاح');
    }


    public function destroy(Request $request)
    {
        $category = Category::find($request->id);

        if (!$category) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, Category is not exists !!']);
        try {
            File::delete('uploads/categories/' . $request->image);
            $category->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
        return redirect()->route('categories.index');
    }


}
