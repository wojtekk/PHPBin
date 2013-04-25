<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

if (empty($_POST['code'])) {
    return '';
}

function HumanReadableFilesize($size) {
    $mod = 1024;

    $units = explode(' ', 'B KB MB GB TB PB');
    for ($i = 0; $size > $mod; $i++) {
        $size /= $mod;
    }

    return round($size, 2) . ' ' . $units[$i];
}

function getHumanTime($ms) {
    $s = $ms / 1000;
    $m = $s / 60;
    $h = $s / 3600;
    $d = $s / 86400;
    if ($ms >= 0.1) {
        if ($m > 1) {
            if ($h > 1) {
                if ($d > 1) {
                    return (int) $d . ' d';
                } else {
                    return (int) $h . ' h';
                }
            } else {
                return (int) $m . ' m';
            }
        } else {
            return (int) $s . ' s';
        }
    } else {
        return sprintf('%01.2f', $ms * 1000) . ' ms';
    }
}

$file = '/tmp/' . microtime() . '-' . mt_rand(1, 10000) . '.tmp.inc';

file_put_contents($file, $_POST['code']);

ob_start();

$memStart = memory_get_usage();
$memPeakStart = memory_get_peak_usage();
$start = microtime(true);

include $file;

$runTime = getHumanTime( microtime(true) - $start );
$memoryUsage = HumanReadableFilesize( memory_get_usage() - $memStart );
$memoryPeakUsage = HumanReadableFilesize( memory_get_peak_usage() - $memPeakStart );
$result = ob_get_contents();

ob_end_clean();

header("X-PHPBin-RunTime: " . $runTime );
header("X-PHPBin-MemoryPeakUsage: " . $memoryUsage . ' / ' . $memoryPeakUsage );

echo $result;
flush();

unlink($file);