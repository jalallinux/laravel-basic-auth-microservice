<?php

namespace Database\Seeders;

class SettingSeeder extends BaseSeeder
{
    public function init()
    {
        //
    }

    public function fake()
    {
        settings()->group('custom-group')->set([
            $this->faker->unique()->slug(2) => $this->faker->sentence,
            $this->faker->unique()->slug(2) => $this->faker->numerify('###-###'),
        ]);
    }
}
