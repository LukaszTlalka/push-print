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
    protected $signature = 'print:pull-queue {--watch}';

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
        $services = config('services.documentServices');

        do {
            dd($services);
        } while($this->option('watch') && !sleep(1));

        return Command::SUCCESS;
    }

    private function getServices()
    {

    }
}
