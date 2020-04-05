<?php

$txtMapper = [
    "2" => "(",
    "1" => ")"
];

$txt = "Hello, World!";
$pairs = [
    [1,2],
    [1,2]
];

// make list from pairs
$pairsList = [];

foreach ($pairs as $index=>$pair) {
    $pairsList[] = [$pair[0], "2", $index];
    $pairsList[] = [$pair[1], "1", $index];
}

usort($pairsList, function ($a, $b) {
    if ($a[0] - $b[0] != 0) return $a[0] - $b[0];
    else {
        return strcmp($a[1], $b[1]);
    }
});

$counter = 0;
foreach ($pairsList as $item) {
    $index = $item[0];
    $type = $item[1];
    $index += $counter;
    $txt = substr_replace($txt, $txtMapper[$type], $index, 0);
    $counter++;
}

echo $txt;
echo "\n";