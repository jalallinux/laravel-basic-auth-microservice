<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Support\Collection;

class AdminSeeder extends BaseSeeder
{
    public function init()
    {
        Admin::factory()->createMany($this->data()->toArray());
    }

    public function fake()
    {
        //
    }

    public function data(): Collection
    {
        return collect([
            [
                'firstname' => 'Jalal',
                'lastname' => 'LinuX',
                'email' => 'smjjalalzadeh93@gmail.com',
                'mobile' => '09177876563',
            ]
        ]);
    }
}
