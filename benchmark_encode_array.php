<?php
/**
 *
 * Created by PhpStorm.
 * User: Rhilip
 * Date: 2019/4/29
 * Time: 19:50
 */

include 'vendor/autoload.php';
set_time_limit(0);

$STRING = 'd4:infod6:lengthi364e4:name8:test.rare3:inti1548400939e4:listl5:UTF-83:GBKe6:string13:uTorrent/3130e';

function test_nexusphp_benc($count = 100000) {
    global $STRING;
    $array = bdec($STRING);
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        benc($array);
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_ridpt_bencode($count = 100000) {
    global $STRING;
    $array = \Rid\Bencode\Bencode::decode($STRING);
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        \Rid\Bencode\Bencode::encode($array);
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_sandfoxme_bencode($count = 100000) {
    global $STRING;
    $array = \SandFox\Bencode\Bencode::decode($STRING);
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        \SandFox\Bencode\Bencode::encode($array);
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_rych_bencode($count = 100000) {
    global $STRING;
    $array = \Rych\Bencode\Bencode::decode($STRING);
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        \Rych\Bencode\Bencode::encode($array);
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_dsmithhayes_bencode($count = 100000) {
    global $STRING;
    $dictionary = new \Bencode\Collection\Dictionary();
    $dictionary->decode($STRING);
    $array = $dictionary->write();
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        (new \Bencode\Collection\Dictionary($array))->encode();
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_s9e_bencode($count = 100000) {
    global $STRING;
    $array = \s9e\Bencode\Bencode::decode($STRING);
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        \s9e\Bencode\Bencode::encode($array);
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_nrk_bencoder($count = 100000) {
    global $STRING;
    $array = \Bencoder\Bencode::decode($STRING);
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        \Bencoder\Bencode::encode($array);
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_pure_bencode($count = 100000) {
    global $STRING;
    $array = \PureBencode\Bencode::decode($STRING);
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        \PureBencode\Bencode::encode($array);
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_ppokatilo_bencode($count = 100000) {
    global $STRING;
    $array = (new \SHyx0rmZ\Bencode\Decoder())->decode($STRING);
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        (new \SHyx0rmZ\Bencode\Encoder())->encode($array);
    }
    return number_format(microtime(true) - $time_start, 3);
}

function test_akatsuki_bencode($count = 100000) {
    global $STRING;
    $array = (new \Akatsuki\Component\Bencode\Decoder())->decode($STRING);
    $time_start = microtime(true);
    for ($i=0; $i < $count; $i++) {
        (new \Akatsuki\Component\Bencode\Encoder())->encode($array);
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
