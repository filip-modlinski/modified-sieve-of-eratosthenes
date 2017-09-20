<?php

function primesArray($n) {
    $max = intval($n ** 0.5);
    $primes = [2 => true];

    if ($n >= 3) {
        $primes[3] = true;
        if ($n >= 5) {
            $primes[5] = true;
        }
    }

    for ($i = 6; $i < $n; $i+=6) {
        $primes[$i+1] = true;
        $primes[$i+5] = true;
    }

    if ($i+5 > $n) {
        unset($primes[$i+5]);
        if ($i+1 > $n) {
            unset($primes[$i+1]);
        }
    }

    for ($i = 5; $i <= $max; $i++) {
        if (isset($primes[$i])) {
            for ($ii = 2; $i * $ii <= $n; $ii++) {
                unset($primes[$i * $ii]);
            }
        }
    }

    return $primes;
}

function getExecTime($t1, $t2) {
    $s = substr($t2, 11) - substr($t1, 11);
    $m = (substr($t2,2,8) - substr($t1,2,8)) / 100000000;
    return $s + $m;
}

function testAlgorithm($max_num, $loops) {
    $average_time = 0;
    $quantity = 0;
    for ($i = 1; $i <= $loops; $i++) {
        $t1 = microtime();
        $primes = primesArray($max_num);
        $t2 = microtime();
        $average_time += getExecTime($t1, $t2);
    }
    if ($loops > 0) {
        $average_time /= $loops;
        $quantity = count($primes);
    }

    return ['max_num' => $max_num, 'quantity' => $quantity, 'avg_time' => $average_time];
}

echo '<pre>';
print_r(testAlgorithm(10000000, 5));
echo '</pre>';
