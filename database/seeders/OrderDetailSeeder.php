<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Menu;

class OrderDetailSeeder extends Seeder
{
    public function run()
    {
        // Seeder ini berasumsi order dengan id=1 dan menu dengan id=1 & 3 sudah ada.
        $order = Order::find(1);
        $mongolianBeef = Menu::where('name', 'Mongolian Beef')->first();
        $icedTea = Menu::where('name', 'Classic Iced Tea')->first();

        if ($order && $mongolianBeef && $icedTea) {
            DB::table('order_details')->insert([
                [
                    'order_id' => $order->order_id,
                    'menu_id' => $mongolianBeef->menu_id,
                    'chef_id' => 1,
                    'quantity' => 1,
                    'note' => 'Less spicy',
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'order_id' => $order->order_id,
                    'menu_id' => $icedTea->menu_id,
                    'chef_id' => 2,
                    'quantity' => 1,
                    'note' => null,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
