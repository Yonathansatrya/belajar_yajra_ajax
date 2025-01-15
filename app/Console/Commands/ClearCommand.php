<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearCommand extends Command
{
    protected $signature = 'Clear';
    protected $description = 'Clear application cache, config, route, and view';

    public function handle()
    {
        $this->call('cache:clear');

        $this->call('config:clear');

        $this->call('route:clear');

        $this->call('view:clear');

        $this->info('All clear operations completed successfully.');
    }
}
