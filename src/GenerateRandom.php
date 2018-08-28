<?php

namespace HandyBiteSize\DistributedRandom;

/**
 * Class GenerateRandom
 * @package DistributedRandom
 */
class GenerateRandom
{
    public $seed;

    public function __construct($seed = null)
    {
        if (!$seed || !is_long($seed))  {
            $seed = mt_rand();
        }
        $this->seed = $seed;
        mt_srand($this->seed);
    }
    /**
     * @param int $size
     * @param int $min
     * @param int $max
     * @param null $weightedMean
     * @param float|int $roundToNearest
     * @return array
     */
    public function randomArray($size = 100, $min = 0, $max = 1, $weightedMean = null, $roundToNearest = 0)
    {
        $out = array();
        for($i = 0; $i < $size; $i++) {
            $out[] = $this->random($min, $max, $weightedMean, $roundToNearest);
        }
        return $out;
    }

    /**
     * @param int $min
     * @param int $max
     * @param null $weightedMean
     * @param float|int $roundToNearest
     * @return float|int
     */
    public function random($min = 0, $max = 1, $weightedMean = null, $roundToNearest = 0)
    {
        $range = $max - $min;
        if (!$weightedMean) {
            $weightedMean = $range / 2;
        }
        $debug['mean'] = $weightedMean;
        $l = $weightedMean - $min;
        $mean = floatval($l / $range * 5);
        $variance = floatval(1);

        $r1 = mt_rand() / mt_getrandmax();
        $r2 = mt_rand() / mt_getrandmax();
        $boxMuller = sqrt(-2 * log($r1)) * cos(2 * M_PI * $r2);
        $rand = $boxMuller * sqrt($variance) + $mean;

        if ($rand < 0 || $rand > 5) {
            return $this->random($min, $max, $weightedMean, $roundToNearest);
        }
        $out = (($rand / 5) * $range) + $min;

        if ($roundToNearest) {
            $out = $this->roundToNearest($out, $roundToNearest);
        }
        return $out;
    }

    /**
     * @param $in
     * @param $round
     * @param bool $formatFraction
     * @return float|int|string
     */
    private function roundToNearest($in, $round, $formatFraction = false)
    {
        if (is_integer($in)) {
            $out = (round($in) % $round === 0) ? round($in) : round(($in + $round / 2) / $round) * $round;
        }else {
            $mod = (1/$round);
            $out =  round($in * $mod) / $mod;
            if ($formatFraction) {
                $str = explode('.', (string) $round);
                $format = strlen(array_pop($str));
                $out = number_format($out, $format, '.', '');
            }
        }
        return $out;
    }


}