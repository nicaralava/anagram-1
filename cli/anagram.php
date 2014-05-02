<?php
use Anagram\Anagram;

require_once dirname(__DIR__) . "/vendor/autoload.php";

$file = dirname(__DIR__) . "/data/inputfile.txt";
if (isset($argv[1]) && $argv[1]) {
    $file = realpath($argv[1]);
}
echo "Read data from file: $file" . PHP_EOL;

$obj = new Anagram();
$handle = @fopen($file, "r");
if ($handle) {
    while (($word = fgets($handle, 4096)) !== false) {
        $obj->addWord(trim($word));
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}

foreach ($obj->getAllAnagrams() as $anagrams) {
    echo implode(" ", $anagrams) . PHP_EOL;
}
