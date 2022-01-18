<?php

use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



function is_watched_auction($id)
{
    $user = auth()->user();
    $watched = \App\Models\WatchedAuction::where('auction_id', $id)->where('user_id', $user->id)->first();
    if ($watched) {
        return true;
    }
    return false;
}

function checkIsUserWatch($auction)
{
    return DB::table('watched_auctions')->where(['user_id' => auth()->id(), 'auction_id' => $auction->id]);
}



function removePhoneZero($number, $country_code): string
{
    $_replaced = Str::replaceFirst('0','', $number);

    $replaced = Str::replaceFirst('966','', $_replaced);

    return ($number && $number[0] == 9) ? $number : $country_code.$replaced;
}




function responseJson($status, $message, $data = null)
{
    $response = ['status' => $status, 'message' => $message, 'data' => $data,];
    return response()->json($response);
}


function direction() { return app()->isLocale('ar') ? 'rtl' : 'ltr'; }
function floating($right, $left){
    return app()->isLocale('ar') ? $right : $left;
}

function isLocalized($lang) { return LaravelLocalization::getLocalizedURL($lang); }


function str(){ return new \Illuminate\Support\Str(); }
function isNullable($text){ return (!isset($text) || $text == null || $text == '') ? trans('messages.no_value') : ucwords($text); }


function cruds()
{
    return ['sellers','categories','cities','admins','auctions'];
}

function model_count($model, $withDeleted = false)
{
    if($model == 'seller') return \App\Models\User::where('type', 'seller')->count();
    elseif ($model == 'buyer') return \App\Models\User::where('type', 'buyer')->count();
        else
    $mo = "App\\Models\\".ucwords($model);
    return $mo::count();
}

function checkIfHasRole($role, $crud, $type)
{
    if($type == 'delete') return in_array('ajax-delete-'.str()->singular($crud), $role->permissions_arr);

    return in_array($crud.'.'.$type, $role->permissions_arr);
}

function uploaded($img, $model)
{
    $filename =  $model . '_' . Str::random(12) . '_' . date('Y-m-d') . '.' . strtolower($img->getClientOriginalExtension());

    if (!file_exists(public_path('uploads/'.Str::plural($model).'/')))
        mkdir(public_path('uploads/'.Str::plural($model).'/'), 0777, true);
    $path = public_path('uploads/'.Str::plural($model).'/');
    $img = Image::make($img)->save($path . $filename);
    return $filename;


}

function settings($param)
{
    return App\Models\Setting::where('key', $param)->first()->value;
}



function random_colors()
{
    $color_array = [
        'slate-300', 'grey-300', 'brown-300', 'green-600', 'brown-600',
        'orange-300', 'orange-700', 'slate-700', 'green-300', 'teal-300',
        'blue-300', 'green-800', 'blue-600', 'blue-800', 'indigo-300', 'indigo-700',
        'purple-300', 'purple-600', 'violet-300', 'violet-600', 'pink-300', 'pink-600',
        'info-300', 'info-600', 'info-800', 'danger-300', 'danger-600'
    ];
    return $color_array[array_rand($color_array)];
}






function models($withColors = false)
{
    if($withColors)
    {
        return [
            'teal'    => 'admin',
            'blue'    => 'seller',
            'pink'    => 'buyer',
            'green'   => 'auction',
//            'orange'  => 'question',
            'grey'    => 'category',
            'yellow'  => 'contact',
            'violet'  => 'nationality',
            'danger-600'  => 'country',
            'indigo'  => 'city',

        ];
    }
//    // those models for CRUD system only;
//    return [
//        'users2'      => 'user',
//        'stack2'      => 'category',
//        'blog'        => 'post',
//        'screen-full'        => 'region',
//        'archive'       => 'city',
//        'magazine'    => 'state',
//        'user-tie'    => 'admin',
//        'statistics'  => 'permission',
//        'cart'        => 'bank',
////        'gear'        => 'contact',

        //'user'       => 'delegate',
//        'cart'        => 'product',
//        'magazine'    => 'about',
        //'statistics'  => 'classification',
        //'gear'        => 'setting',
        // 'users2'      => 'provider',
//        'statistics'  => 'service',
//        'cart' => 'project',
   // ];

//    function model_count($model, $withDeleted = false)
//    {
////        if($withDeleted)
////        {
////            if($model == 'admin') return \App\Models\Admin::onlyTrashed()->where('is_super_Admin', '!=', 1)->count();
////            $mo = "App\\Models\\".ucwords($model);
////            return $mo::onlyTrashed()->count();
////        }
////        if($model == 'admin') return \App\Models\Admin::where('is_super_Admin', '!=', 1)->count();
//
//        $mo = "App\\Models\\".ucwords($model);
//
//        return $mo::count();
//    }


}

