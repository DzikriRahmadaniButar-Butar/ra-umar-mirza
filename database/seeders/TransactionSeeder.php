<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use Illuminate\Support\Carbon;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Transaction::create([
                'payment_id'    => rand(1, 5),
                'user_id'       => rand(1, 2),
                'payment_date'  => Carbon::now()->subDays(rand(1, 30)),
                'amount_paid'   => rand(100000, 500000),
            ]);
        }
    }
}
