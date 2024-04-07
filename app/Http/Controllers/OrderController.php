<?php

namespace App\Http\Controllers;

use App\Models\LineItem;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){

        $orders=Order::with('customerData')->get();
        return view('admin.orders_list',compact('orders'));
    }

    public function getLineItems(Request $request ,$id){
        $orderData = Order::where('id', $id)->with('lineitemsData')->first();
        return view('admin.lineitems_list', compact('orderData'));
    }
}

