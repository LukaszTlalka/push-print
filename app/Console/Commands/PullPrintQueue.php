<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PullPrintQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'print:pull-queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull printing jobs and push to a folder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
