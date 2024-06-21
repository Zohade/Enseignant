<?php

namespace App\Services;

use Xenolope\Quahog\Client as ClamAVClient;
use Socket\Raw\Factory as SocketFactory;

class ClamAVScanner
{
    protected $clamav;

    public function __construct()
    {
        $factory = new SocketFactory();
        $socket = $factory->createClient('tcp://127.0.0.1:3310');
        $this->clamav = new ClamAVClient($socket);
    }

    public function scanFile($filePath)
    {
        $result = $this->clamav->scanFile($filePath);

        // Debugging: Log the result
        error_log(print_r($result, true));

        if ($result->isOk()) {
            return true;
        }

        return $result->getReason();
    }
}