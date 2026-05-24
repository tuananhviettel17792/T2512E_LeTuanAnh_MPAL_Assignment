<?php

namespace Database\Factories;

use App\Models\BankAccount;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BankAccountFactory extends Factory
{
    protected $model = BankAccount::class;

    public function definition(): array
    {
        $ho = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Hoàng', 'Huỳnh', 'Phan', 'Vũ', 'Võ', 'Đặng', 'Bùi', 'Đỗ', 'Hồ', 'Ngô', 'Dương', 'Lý'];
        $dem = ['Văn', 'Thị', 'Minh', 'Đức', 'Thành', 'An', 'Bảo', 'Ngọc', 'Tuấn', 'Quang', 'Xuân', 'Hải', 'Phương', 'Anh'];
        $ten = ['Anh', 'Bình', 'Chi', 'Dũng', 'Em', 'Phong', 'Giang', 'Hương', 'Khanh', 'Linh', 'Minh', 'Nam', 'Oanh', 'Phúc', 'Quân', 'Sơn', 'Tâm', 'Uyên', 'Vinh', 'Yến'];
        $randomHo = $this->faker->randomElement($ho);
        $randomDem = $this->faker->randomElement($dem);
        $randomTen = $this->faker->randomElement($ten);
        $fullName = "{$randomHo} {$randomDem} {$randomTen}";
        $slugName = Str::slug($fullName, '');
        $randomString = $this->faker->numerify('#####');
        $email = "{$slugName}{$randomString}@" . $this->faker->randomElement(['gmail.com', 'yahoo.com', 'hotmail.com']);
        $prefix = $this->faker->randomElement(['090', '091', '039']);
        $phone = $prefix . $this->faker->numerify('#######');

        return [
            'account_number' => $this->faker->unique()->numerify('##########'),
            'full_name'      => $fullName,
            'email'          => $email,
            'phone'          => $phone,
            'balance'        => $this->faker->numberBetween(0, 500000000),
            'status'         => $this->faker->randomElement(['active', 'inactive', 'banned']),
        ];
    }
}
