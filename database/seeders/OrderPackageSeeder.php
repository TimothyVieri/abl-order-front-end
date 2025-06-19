<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Menu;

class OrderPackageSeeder extends Seeder
{
    public function run()
    {
        // This seeder assumes an order with id=1 and a menu item (e.g., Kung Pao) exist.
        $order = Order::find(1);
        $kungPao = Menu::where('name', 'Spicy Kung Pao')->first();

        if ($order && $kungPao) {
            DB::table('order_packages')->insert([
                [
                    'order_id' => $order->order_id,
                    'menu_package_id' => $kungPao->menu_id,
                    'chef_id' => 1,
                    'quantity' => 2,
                    'note' => 'Birthday package',
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
