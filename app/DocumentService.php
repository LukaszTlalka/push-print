<?php

namespace App;
use GuzzleHttp\Client;

/**
 * Handle storage and pull of the files for printing
 */
class DocumentService
{
    public function __construct(
        private string $url,
        private string $key,
        private string $directory,
        private string $printer)
    {
    }

    /**
     * Fetch the latest files for printing from web service
     */
    public function downloadFiles(): void
    {
        die('test');

    }
}
