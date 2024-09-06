<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Exception;

class CustomerController extends Controller
{
    function CustomerPage()
    {
        return view('pages.dashboard.Customer-page');
    }

    function CustomerList(Request $request)
    {
        $user_id = $request->header('id');
        return Customer::where('user_id', '=', $user_id)->get();
    }

    function CustomerCreate(Request $request)
    {
        $user_id = $request->header('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        return Customer::create([
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'user_id' => $user_id
        ]);
    }
    function CustomerUpdate(Request $request)
    {
        $user_id = $request->header('id');
        $Customer_id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        return Customer::where('id', '=', $Customer_id)->where('user_id', '=', $user_id)->update([
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
        ]);
    }
    function CustomerDelete(Request $request)
    {
        $user_id = $request->header('id');
        $Customer_id = $request->input('id');
        return Customer::where('id', '=', $Customer_id)->where('user_id', '=', $user_id)->delete();
    }

    function CustomerById(Request $request)
    {
        try {

            $user_id = $request->header('id');
            $Customer_id = $request->query('id');
            $Customer = Customer::where('id', '=', $Customer_id)->where('user_id', '=', $user_id)->first();
            return response()->json([
                'status' => 'success',
                'message' => 'Request Successful',
                'data' => $Customer,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed',
            ], 200);
        }
    }
}
