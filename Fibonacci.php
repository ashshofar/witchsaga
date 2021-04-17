<?php

class Fibonacci
{
    /**
     * @param $n
     * @return int
     */
    public function recursive($n)
    {
        if ($n == 0) {
            return 0;
        }

        if ($n == 1) {
            return 1;
        }

        return $this->recursive($n - 1) + $this->recursive($n - 2);
    }

    /**
     * @param $n
     * @return array
     */
    public function calculate($n)
    {
        $temp = [];
        for ($i=1; $i<=$n; $i++) {
            array_push($temp, $this->recursive($i));
        }

        return $temp;
    }
}