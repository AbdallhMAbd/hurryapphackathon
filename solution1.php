<?php

$frames = [2,1,3,5,6,10,16,11];
$n = count($frames);

// sort frames
for($i=0; $i<$n; $i++){
    for($j=0; $j<$n-$i-1; $j++){
        if($frames[$j] > $frames[$j+1]){
            list($frames[$j], $frames[$j + 1]) = [$frames[$j + 1], $frames[$j]];
        }
    }
}

// find gaps
$gaps = [];
$largest_gap = 0;
$last_largest_gap = 0;
$missing = 0;
$ngap = 0;

for($i=0; $i<$n-1; $i++){
    $gap = ($frames[$i+1] - $frames[$i] - 1);
    if($gap > 0){
        $start = $frames[$i] + 1;
        $end = $frames[$i] + $gap;
        $gaps[] = [$start, $end];

        ($gap >= $last_largest_gap) && ($last_largest_gap = $gap) && ($largest_gap = $ngap);
        $ngap++;
        $missing += $gap;
    }
}

$output = [
    "gaps" => $gaps,
    "largest_gap" => $gaps[$largest_gap],
    "missing_count" => $missing
];
print_r($output);
