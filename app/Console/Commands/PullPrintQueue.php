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
            $services->map(function($service) {
                if ($fileName = $service->downloadFiles()) {
                    $this->info("New printing job available: ". $fileName);
                }
            });
        } while($this->option('watch') && !sleep(1));

        return Command::SUCCESS;
    }

    private function getServices()
    {
        $serviceConfigs = collect(config('services.documentServices'))
            ->filter(fn($sConfig) => $sConfig['base_uri']);

        $services = collect();
        foreach ($serviceConfigs as $sConfig) {
            $services->push(new DocumentService(
                $sConfig['base_uri'],
                $sConfig['key'],
                $sConfig['directory'],
                $sConfig['printer_id']
            ));
        }
        return $services;
    }
}
