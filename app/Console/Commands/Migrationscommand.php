<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Migrationscommand extends Command
{
    protected $signature = 'Migrations';
    protected $description = 'Run migrations fresh and seed the admin';

    public function handle()
    {
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed --class=AdminSeeder');
        $this->info('Migrations and AdminSeeder executed successfully.');
    }
}
