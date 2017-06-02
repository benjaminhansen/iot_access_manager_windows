<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunDusk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iot:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dusk command extension for access.ualr.edu';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('dusk');
    }
}
