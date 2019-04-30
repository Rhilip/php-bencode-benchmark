<?php
/**
 * Created by PhpStorm.
 * User: Rhilip
 * Date: 2019/4/30
 * Time: 12:14
 */

include 'vendor/autoload.php';
set_time_limit(0);

$STRING = 'd4:infod6:lengthi364e4:name8:test.rare3:inti1548400939e4:listl5:UTF-83:GBKe6:string13:uTorrent/3130e';

echo 'Raw Sting:' . $STRING . PHP_EOL;

echo PHP_EOL .  'NexusPHP(benc.php)'. PHP_EOL;
print_r(bdec($STRING));

echo PHP_EOL .  'RidPT(Bencode.php)'. PHP_EOL;
print_r(\Rid\Bencode\Bencode::decode($STRING));

echo PHP_EOL .  'sandfoxme/bencode'. PHP_EOL;
print_r(\SandFox\Bencode\Bencode::decode($STRING));

echo PHP_EOL .  'rych/bencode'. PHP_EOL;
print_r(\Rych\Bencode\Bencode::decode($STRING));

echo PHP_EOL .  'dsmithhayes/bencode'. PHP_EOL;
$dictionary = new \Bencode\Collection\Dictionary();
$dictionary->decode($STRING);
$buffer = $dictionary->write();
print_r($buffer);

echo PHP_EOL .  's9e/Bencode'. PHP_EOL;
print_r(\s9e\Bencode\Bencode::decode($STRING));

echo PHP_EOL .  'nrk/bencoder'. PHP_EOL;
print_r(\Bencoder\Bencode::decode($STRING));

echo PHP_EOL .  'pure-bencode/pure-bencode'. PHP_EOL;
print_r(\PureBencode\Bencode::decode($STRING));

echo PHP_EOL .  'ppokatilo/bencode'. PHP_EOL;
print_r((new \SHyx0rmZ\Bencode\Decoder())->decode($STRING));

echo PHP_EOL .  'akatsuki/bencode'. PHP_EOL;
print_r((new \Akatsuki\Component\Bencode\Decoder())->decode($STRING));
