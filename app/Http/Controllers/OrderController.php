<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Auth; // Tidak lagi diperlukan untuk sementara

class OrderController extends Controller
{
    // Menampilkan halaman order dengan data menu
    public function create()
    {
        $menuCategories = Menu::all()->groupBy('category');
        // Mengarahkan ke view 'resources/views/order/order.blade.php'
        return view('order.order', compact('menuCategories')); // <-- Perbaikan di sini
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_type' => 'required|string|in:Dine In,Take Away,Delivery',
            'total_payment' => 'required|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*' => 'required|integer|min:1',
            'event_id' => 'nullable|string',
            'voucher_id' => 'nullable|string',
        ]);

        try {
            $payload = [
                'items' => [],
                'user_id' => 1,
                'order_type' => $validated['order_type'],
                'total_payment' => $validated['total_payment'],
                'event_id' => $request->event_id ?? null,
                'voucher_id' => $request->voucher_id ?? null,
                'reservasi_id' => null // udah aman, default null
            ];

            foreach ($validated['items'] as $menu_id => $quantity) {
                $payload['items'][] = [
                    'type' => 'menu_item',
                    'id' => (int)$menu_id,
                    'quantity' => (int)$quantity,
                    'chef_id' => 1, // bisa nanti diganti dari frontend
                    'note' => null
                ];
            }

            $response = Http::post('http://localhost:8000/orders/create_with_items', $payload);

            if ($response->successful() && $response->json('success')) {
                return back()->with('success', 'Order placed successfully!');
            }

            return back()->with('error', 'Failed to place order. Server responded with error.');
        } catch (\Exception $e) {
            return back()->with('error', 'Request failed: ' . $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        $order->load('orderDetails.menu');

        // Mengirim data pesanan ke view
        return view('order.order_detail', compact('order'));
    }
}
