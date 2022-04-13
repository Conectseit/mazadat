<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Http\Requests\Dashboard\OptionDetailRequest;
use App\Models\Auction;
use App\Models\Category;
use App\Models\CategoryOption;
use App\Models\Option;
use App\Models\OptionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CategoryController extends Controller
{

    public function index()
    {
        $data['categories'] = Category:: latest()->get();
//        $data['categories'] = Category::select('id','image','created_at',
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
        $request_data = $request->except(['image']);

        if ($request->image) $request_data['image'] = uploaded($request->image, 'category');
        $category = Category::create($request_data);

// ===========================================================
        $name='name_' . app()->getLocale();
        activity()
            ->performedOn($category)
            ->causedBy(auth()->guard('admin')->user())
            ->log(' قام المشرف' . ' '.auth()->guard('admin')->user()->full_name .' '. ' باضافة قسم '. ($category->$name));
// ===========================================================


        return redirect()->route('categories.index')->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));

    }

    public function show($id)
    {
        if (!Category::find($id)) {
            return redirect()->route('categories.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $data['category'] = Category::find($id);
        $data['categories'] = Category::all();
        $data['category_auctions'] = Auction::where('category_id', $id)->get();
        $data['category_options'] = Option::where('category_id', $id)->get();
        return view('Dashboard.Categories.show', $data);
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


    public function update(CategoryRequest $request, Category $category)
    {
        $request_data = $request->except('image');
        if ($request->hasFile('image')) {
            if (!is_null($category->image)) unlink('uploads/categories/' . $category->image);
            $request_data['image'] = uploaded($request->image, 'category');
        }
        $category->update($request_data);


// ===========================================================
        $name='name_' . app()->getLocale();
        activity()
            ->performedOn($category)
            ->causedBy(auth()->guard('admin')->user())
            ->log(' قام المشرف' . ' '.auth()->guard('admin')->user()->full_name .' '. ' بتعديل قسم '. ($category->$name));

// ===========================================================

        return redirect()->route('categories.index')->with('success', trans('messages.messages.updated_successfully'));
    }


    public function destroy(Request $request, Category $category)
    {
        $category = Category::find($request->id);
        if (!$category) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, Category is not exists !!']);
        try {
            if (!is_null($category->image)) unlink('uploads/categories/' . $category->image);
//            File::delete('uploads/categories/' . $request->image);
            $category->delete();

            // ===========================================================
            $name='name_' . app()->getLocale();
            activity()
                ->performedOn($category)
                ->causedBy(auth()->guard('admin')->user())
                ->log(' قام المشرف' . ' '.auth()->guard('admin')->user()->full_name .' '. ' بحذف  قسم '. ($category->$name));
// ===========================================================

            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
//        return redirect()->route('categories.index');
    }


    public function add_option_detail(OptionDetailRequest $request)
    {
        OptionDetail::create($request->all());
        return back()->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));
    }

}
