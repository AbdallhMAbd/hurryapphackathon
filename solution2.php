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
$n = count($full_frames);
$gap_n = 0;
$gaps = [];
$last = false;
$largest_gap = [];
$big = 0;
$missing = 0;

for ($i = 0; $i < $n; $i++) {
    if (in_array($full_frames[$i], $frames)) {
        if ($last) {
            $gaps[$gap_n][] = $full_frames[$i - 1];
            $missing += ($check_larg = $gaps[$gap_n][1] - $gaps[$gap_n][0]) + 1;
            $largest_gap = ($check_larg >= $big) ? ($big = $check_larg) || true ? $gap_n : false : $largest_gap;
            $last = false;
        }
        $gap_n = isset($gaps[$gap_n]) ? ($gap_n + 1) : $gap_n;
    } elseif (!$last) {
        $gaps[$gap_n][] = $full_frames[$i];
        $last = true;
    }
}

$output = [
    "gaps" => $gaps,
    "largest_gap" => $gaps[$largest_gap],
    "missing_count" => $missing
];

print_r($output);
