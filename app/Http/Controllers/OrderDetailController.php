<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderDetailController extends Controller
{
    public function store(Request $request)
    {
        $response = Http::post('http://localhost:8000/order-details', [
            'order_id' => $request->order_id,
            'menu_id' => $request->menu_id,
            'chef_id' => $request->chef_id,
            'quantity' => $request->quantity,
            'note' => $request->note,
            'status' => 'PENDING'
        ]);

        return redirect('/order-details');
    }
}
