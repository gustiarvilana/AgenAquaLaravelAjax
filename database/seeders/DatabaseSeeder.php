<?php

namespace Database\Seeders;

use App\Models\MasterOPS;
use App\Models\Pengeluaran;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create();
        Artisan::call('laravolt:indonesia:seed');
        $this->call([
            ops::class
        ]);
    }
}
