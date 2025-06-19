<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User; // Pastikan model User ada

class OrderSeeder extends Seeder
{
    public function run()
    {
        // Seeder ini berasumsi user dengan id=1 sudah ada di database.
        if (User::find(1)) {
            DB::table('orders')->insert([
                [
                    'user_id' => 1,
                    'reservasi_id' => null,
                    'event_id' => null,
                    'voucher_id' => null,
                    'order_type' => 'Dine In',
                    'total_payment' => 225000, // Contoh total, idealnya dihitung dari order_details
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
