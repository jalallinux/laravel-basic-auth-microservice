<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

abstract class BaseSeeder extends Seeder
{
    use WithFaker;

    public function __construct()
    {
        $this->faker = $this->makeFaker();
    }

    public function run()
    {
        $this->init();
        if (!!config('app.faker_run')) {
            $this->fake();
        }
    }

    abstract public function init();

    abstract public function fake();
}
