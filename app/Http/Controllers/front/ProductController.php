<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function rent_products(){
       $data['products'] = Product::where('purpose_of_the_advertisement' , 'rent')->get();
        return view('front.products.rent_products' , $data);
   }
   public function sale_products(){
       $data['products'] = Product::where('purpose_of_the_advertisement' , 'sale')->get();
        return view('front.products.sale_products' , $data);
   }
}
