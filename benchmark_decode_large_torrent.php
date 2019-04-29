<?php
/**
 *
 * Created by PhpStorm.
 * User: Rhilip
 * Date: 2019/4/29
 * Time: 19:48
 */

include 'vendor/autoload.php';
set_time_limit(0);

$FILE_LOC = './torrent/Touhou lossless music collection v.19.torrent';

function test_nexusphp_benc($count = 1) {
    global $FILE_LOC;
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        bdec_file($FILE_LOC, 52428800);
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_ridpt_bencode($count = 1) {
    global $FILE_LOC;
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        \Rid\Bencode\Bencode::load($FILE_LOC);
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_sandfoxme_bencode($count = 1) {
    global $FILE_LOC;
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        \SandFox\Bencode\Bencode::load($FILE_LOC);
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_rych_bencode($count = 1) {
    global $FILE_LOC;
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        \Rych\Bencode\Bencode::decode(file_get_contents($FILE_LOC));
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_dsmithhayes_bencode($count = 1) {
    global $FILE_LOC;
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        $dictionary = new \Bencode\Collection\Dictionary();
        $dictionary->decode(file_get_contents($FILE_LOC));
        $buffer = $dictionary->write();
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_s9e_bencode($count = 1) {
    global $FILE_LOC;
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        \s9e\Bencode\Bencode::decode(file_get_contents($FILE_LOC));
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_nrk_bencoder($count = 1) {
    global $FILE_LOC;
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        \Bencoder\Bencode::decodeFromFile($FILE_LOC);
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_pure_bencode($count = 1) {
    global $FILE_LOC;
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        \PureBencode\Bencode::decode(file_get_contents($FILE_LOC));
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_ppokatilo_bencode($count = 1) {
    global $FILE_LOC;
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        (new \SHyx0rmZ\Bencode\Decoder())->decode(file_get_contents($FILE_LOC));
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_OPSnet_bencode_torrent($count = 1) {
    global $FILE_LOC;
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        (new OrpheusNET\BencodeTorrent\Bencode())->decodeFile($FILE_LOC);
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_akatsuki_bencode($count = 1) {
    global $FILE_LOC;
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        (new \Akatsuki\Component\Bencode\Decoder())->decode(file_get_contents($FILE_LOC));
    }
    return number_format(microtime(true) - $time_start, 3);
}

$total = 0;
$functions = get_defined_functions();
$line = str_pad("-",38,"-");
echo "<pre>$line\n|".str_pad("PHP BENCHMARK SCRIPT",36," ",STR_PAD_BOTH)."|\n$line\nStart : ".date("Y-m-d H:i:s")."\nServer : {$_SERVER['SERVER_NAME']}@{$_SERVER['SERVER_ADDR']}\nPHP version : ".PHP_VERSION."\nPlatform : ".PHP_OS. "\n$line\n";
foreach ($functions['user'] as $user) {
    if (preg_match('/^test_/', $user)) {
        $total += $result = $user();
        echo str_pad($user, 25) . " : " . $result ." sec.\n";
    }
}
echo str_pad("-", 38, "-") . "\n" . str_pad("Total time:", 25) . " : " . $total ." sec.</pre>";
