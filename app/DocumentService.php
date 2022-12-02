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
        private string $key,
        private string $directory,
        private string $printerID)
    {
    }

    /**
     * Fetch the latest files for printing from web service
     */
    public function downloadFiles(): null|string
    {
        $client = new Client();
        $url = rtrim($this->baseUri, "/") . "/api/print/job?key={$this->key}&printer_id=" . $this->printerID;
        $response = $client->get($url);

        $data = json_decode((string)$response->getBody());

        //file_put_contents("/tmp/job-serialized", serialize($data));
        ///$data = unserialize(file_get_contents("/tmp/job-serialized"));

        if ($job = $data->job) {
            $fileName = preg_replace( '/[^a-z0-9.]+/', '-', strtolower( $job->filename ) );
            Storage::disk('printing')->put($this->directory . "/" . $fileName, $job->file);
            return $fileName;
        }

        return null;
    }
}
