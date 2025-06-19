<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
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

    // Menyimpan data pesanan baru
    public function store(Request $request)
    {
        // Validasi request
        $validated = $request->validate([
            'order_type' => 'required|string|in:Dine In,Take Away,Delivery',
            'total_payment' => 'required|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*' => 'required|integer|min:1',
            'event_id' => 'nullable|string',
            'voucher_id' => 'nullable|string',
        ]);

        // Pengecekan login dihapus untuk sementara

        try {
            DB::beginTransaction();

            // Buat order utama
            $order = Order::create([
                'user_id' => 1,
                'order_type' => $validated['order_type'],
                'total_payment' => $validated['total_payment'],
                'event_id' => $request->event_id,
                'voucher_id' => $request->voucher_id,
            ]);

            // Simpan setiap item di order_details
            foreach ($validated['items'] as $menu_id => $quantity) {
                if(Menu::find($menu_id)) {
                    $order->orderDetails()->create([
                        'menu_id' => $menu_id,
                        'quantity' => $quantity,
                        'status' => 'pending'
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('orders.success')->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to place order. Please try again. Error: ' . $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        // Menggunakan "Eager Loading" untuk memuat relasi agar lebih efisien
        // dan menghindari N+1 problem.
        $order->load('orderDetails.menu');

        // Mengirim data pesanan ke view
        return view('order.order_detail', compact('order'));
    }
}
