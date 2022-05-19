<?php

namespace Database\Seeders;

use App\Models\UserAccessKey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserAccessKeyTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserAccessKey::create([
            'access_key' => Str::random(15)
        ]);
    }
}
