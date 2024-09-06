<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;

use Exception;

class ProductController extends Controller
{
    function ProductPage()
    {
        return view('pages.dashboard.product-page');
    }

    function ProductList(Request $request)
    {
        $user_id = $request->header('id');
        return Product::where('user_id', '=', $user_id)->get();
    }

    function ProductCreate(Request $request)
    {
        $user_id = $request->header('id');
        $img = $request->file('img');
        $t = time();
        $file_name = $img->getClientOriginalName();
        $img_name = "{$user_id}-{$t}-{$file_name}";
        $img_url = "uploads/{$img_name}";

        //upload files
        $img->move(public_path('uploads'), $img_name);

        $name = $request->input('name');
        $price = $request->input('price');
        $unit = $request->input('unit');
        $category_id = $request->input('category_id');
        return Product::create([
            'name' => $name,
            'price' => $price,
            'unit' => $unit,
            'img_url' => $img_url,
            'category_id' => $category_id,
            'user_id' => $user_id
        ]);
    }
    function ProductUpdate(Request $request)
    {
        $user_id = $request->header('id');
        $Product_id = $request->input('id');
        $category_id = $request->input('category_id');
        $name = $request->input('name');
        $price = $request->input('price');
        $unit = $request->input('unit');

        if($request->hasFile('img'))
        {
            $img = $request->file('img');
            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$user_id}-{$t}-{$file_name}";
            $img_url = "uploads/{$img_name}";
    
            //upload files
            $img->move(public_path('uploads'), $img_name);
            $filePath = $request->input("file_path");
            File::delete($filePath);

            return Product::where('id', '=', $Product_id)->where('user_id', '=', $user_id)->update([
            'name' => $name,
            'price' => $price,
            'unit' => $unit,
            'img_url' => $img_url,
            'category_id' => $category_id,

            ]);
            
        }
        else
        {
    
        return Product::where('id', '=', $Product_id)->where('user_id', '=', $user_id)->update([
            'name' => $name,
            'price' => $price,
            'unit' => $unit,
            'category_id' => $category_id,
        ]);
        }
        
        
    }
    function ProductDelete(Request $request)
    {
        $user_id = $request->header('id');
        $Product_id = $request->input('id');
        $filePath = $request->input("file_path");
        File::delete($filePath);

        return Product::where('id', '=', $Product_id)->where('user_id', '=', $user_id)->delete();
    }

    function ProductById(Request $request)
    {
        $user_id = $request->header('id');
        $Product_id = $request->input('id');
        return Product::where('id', '=', $Product_id)->where('user_id', '=', $user_id)->first();
    }
}
