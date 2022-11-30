<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\DocumentService;

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
        $services = $this->getServices();

        do {
            $services->map(fn($service) => $service->downloadFiles());
        } while($this->option('watch') && !sleep(1));

        return Command::SUCCESS;
    }

    private function getServices()
    {
        $serviceConfigs = collect(config('services.documentServices'))
            ->filter(fn($sConfig) => $sConfig['url']);

        $services = collect();
        foreach ($serviceConfigs as $sConfig) {
            $services->push(new DocumentService(
                $sConfig['url'],
                $sConfig['key'],
                $sConfig['directory'],
                $sConfig['printer']
            ));
        }
        return $services;
    }
}
