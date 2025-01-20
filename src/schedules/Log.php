<?php

namespace src\Schedules;

class Log
{
  private $file;

  static public function addLog($model, $func, $line, $error)
  {

    $data = date('Ydm');
    $logFile = __DIR__ . '/../../logs' . '/' . $data . '_log.text';
    if (file_exists($logFile)) $file = fopen($logFile, 'a');
    else $file = fopen($logFile, 'w');

    fwrite($file, '<<<<<<<<< Begin Error >>>>>>>>>>' . PHP_EOL);
    fwrite($file, "Model:" . $model . ", Func:" . $func . ", Line: " . $line . PHP_EOL);
    fwrite($file, 'Error:' . $error . PHP_EOL);
    fwrite($file, '<<<<<<<<< End Error >>>>>>>>>>');
    fwrite($file, PHP_EOL . PHP_EOL);

    fclose($file);
  }
}
