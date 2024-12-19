<?php

namespace Traits;

use RuntimeException;
use Throwable;

trait ErrorLogger
{

    protected string $logDirectory = __DIR__ . '/../writable/logs/';

    protected function logMessage(string $message, string $level = 'info')
    {

        if (!is_dir($this->logDirectory)) {
            if (!mkdir($this->logDirectory, 0777, true) && is_dir($this->logDirectory)) {
                throw new RuntimeException("No se pudo crear el directorio de logs: {$this->logDirectory}");
            }
        }

        $logFilge = $this->logDirectory . 'log-' . date('Y-m-d') . '.log';

        $timestamp = date('Y-m-d H:i:s');
        $formattedMessage = "[$timestamp] [$level]". PHP_EOL . $message . PHP_EOL;

        file_put_contents($logFilge, $formattedMessage, FILE_APPEND);
    }

    private function getThrowableMessage(Throwable $error) {
        $message = 'Message:' . $error->getMessage() . PHP_EOL;
        $message .= 'Archivo:' . $error->getFile() . ' in line ' . $error->getLine() . PHP_EOL;
        $message .= 'Trace:' . $error->getTraceAsString();
        
        return $message;
    }

    public function logError(string|Throwable $error)
    {
        if (is_string($error)) {
            $this->logMessage($error, 'ERROR');
        } else {
            $message = 
            $this->logMessage($this->getThrowableMessage($error), 'ERROR');
        }
    }

    public function logWarning(string|Throwable $error)
    {
        if (is_string($error)) {
            $this->logMessage($error, 'WARNING');
        } else {
            $this->logMessage($this->getThrowableMessage($error), 'WARNING');
        }
    }

    public function logInfo(string|Throwable $error)
    {
        if (is_string($error)) {
            $this->logMessage($error, 'INFO');
        } else {
            $this->logMessage($this->getThrowableMessage($error), 'INFO');
        }
    }
}
