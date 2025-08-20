<?php

$frames = [2,1,3,5,6,10,16,11];
$n = count($frames);

// sort
for ($i = 0; $i < $n; $i++) {
    for ($j = 0; $j < $n - $i - 1; $j++) {
        if ($frames[$j] > $frames[$j + 1]) {
            list($frames[$j], $frames[$j + 1]) = [$frames[$j + 1], $frames[$j]];
        }
    }
}

// find gaps
$full_frames = range($frames[0], end($frames));
$n = end($frames);
$gaps = [];
$largest_gap = [];
$last_largest_gap = 0;
$missing = 0;
$ngap = 0;
$gap_array_openned = false;

for ($i = 0; $i < $n; $i++) {
    if (in_array($full_frames[$i], $frames)) {
        if ($gap_array_openned) {
            $gaps[$ngap][] = $full_frames[$i - 1];
            $check_larg = $gaps[$ngap][1] - $gaps[$ngap][0];
            $missing += $check_larg + 1;
            $largest_gap = ($check_larg >= $last_largest_gap) ? ($last_largest_gap = $check_larg) || true ? $ngap : false : $largest_gap;
            
            $gap_array_openned = false;
        }
        $ngap = isset($gaps[$ngap]) ? ($ngap + 1) : $ngap;
    } elseif (!$gap_array_openned) {
        $gaps[$ngap][] = $full_frames[$i];
        $gap_array_openned = true;
    }
}

$output = [
    "gaps" => $gaps,
    "largest_gap" => $gaps[$largest_gap],
    "missing_count" => $missing
];

print_r($output);
