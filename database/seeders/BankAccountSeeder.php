<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    public function run(): void
    {
        // YÊU CẦU: Tạo tự động 50 tài khoản người dùng
        BankAccount::factory()->count(50)->create();
    }
}
