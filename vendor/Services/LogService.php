<?php
namespace Services;

class LogService
{
    static public function addLog(array $massages): void
    {
        file_put_contents('storages/logs/logs.txt', date('[Y-m-d H:i:s] ') . print_r($massages, true) . PHP_EOL, FILE_APPEND);
    }
}