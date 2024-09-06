<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Exception;

class CategoryController extends Controller
{
    function CategoryPage()
    {
        return view('pages.dashboard.category-page');
    }

    function CategoryList(Request $request)
    {
        $user_id = $request->header('id');
        return Category::where('user_id', '=', $user_id)->get();
    }

    function CategoryCreate(Request $request)
    {
        $user_id = $request->header('id');
        $name = $request->input('name');
        return Category::create([
            'name' => $name,
            'user_id' => $user_id
        ]);
    }
    function CategoryUpdate(Request $request)
    {
        $user_id = $request->header('id');
        $category_id = $request->input('id');
        $name = $request->input('name');
        return Category::where('id', '=', $category_id)->where('user_id', '=', $user_id)->update([
            'name' => $name
        ]);
    }
    function CategoryDelete(Request $request)
    {
        $user_id = $request->header('id');
        $category_id = $request->input('id');
        return Category::where('id', '=', $category_id)->where('user_id', '=', $user_id)->delete();
    }

    function CategoryById(Request $request)
    {
        try {

            $user_id = $request->header('id');
            $category_id = $request->query('id');
            $category = Category::where('id', '=', $category_id)->where('user_id', '=', $user_id)->first();
            return response()->json([
                'status' => 'success',
                'message' => 'Request Successful',
                'data' => $category,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed',
            ], 200);
        }
    }
}
