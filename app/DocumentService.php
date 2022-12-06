<?php

namespace App;
use GuzzleHttp\Client;
use Storage;

/**
 * Handle storage and pull of the files for printing
 */
class DocumentService
{
    public function __construct(
        private string $baseUri,
        private string $key)
    {
    }

    private function sanitizeFile($filename)
    {
        return preg_replace( '/[^a-z0-9.]+/', '-', strtolower( $filename ) );
    }

    /**
     * Fetch the latest files for printing from web service
     */
    public function downloadFiles(): null|string
    {
        $client = new Client();
        $url = rtrim($this->baseUri, "/") . "/api/print/job?key={$this->key}";
        $response = $client->get($url);

        $data = json_decode((string)$response->getBody());

        if ($job = $data->job) {

            $fileName = $this->sanitizeFile(strtolower($job->filename));
            $directory = $this->sanitizeFile(strtolower($job->printer->name));

            Storage::disk('printing')->put($directory . "/" . $fileName, base64_decode($job->file));
            return $fileName;
        }

        return null;
    }
}
