<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;

class MonthlyLogger
{
    public function __invoke(array $config) : Logger
    {
        $name = pathinfo($config['path'], PATHINFO_FILENAME);

        return new Logger($name, [$this->handler($config['path'], $config['months'])]);
    }

    private function handler(string $path, int $months) : RotatingFileHandler
    {
        return tap(new RotatingFileHandler($path, $months), function ($handler) {
            $handler
                ->setFormatter(new LineFormatter(null, 'Y-m-d H:i:s', false, true))
                ->setFilenameFormat('{filename}-{date}', RotatingFileHandler::FILE_PER_MONTH);
        });
    }
}
