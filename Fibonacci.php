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

    /**
     * @param $post
     * @return array
     */
    public function postData($post)
    {
        $validation = $this->validateData($post);

        if (!$validation['status']) {
            return $validation;
        }

        $person = $post['person'];

        $result = [];
        $tempAverage = [];
        foreach ($person as $key=>$p) {
            $born = $p['death'] - $p['age'];

            $tempKilled = $this->calculate($born);
            $killed = array_sum($tempKilled);

            $resultPerson[$key]['age'] =  $p['age'];
            $resultPerson[$key]['death'] = $p['death'];
            $resultPerson[$key]['born'] = $born;
            $resultPerson[$key]['tempKilled'] = implode(" + ", $tempKilled);
            $resultPerson[$key]['killed'] = $killed;

            array_push($tempAverage, $killed);
        }

        $sanitizeAverage = array_filter($tempAverage);
        $result['person'] = $resultPerson;
        $result['average'] = array_sum($sanitizeAverage) / count($sanitizeAverage);
        $result['status'] = TRUE;

        return $result;
    }

    /**
     * @param $post
     * @return array
     */
    public function validateData($post)
    {
        $person = $post['person'];
        $result['status'] = TRUE;

        // Check negative value
        foreach ($person as $p) {
            if ($p['death'] < 1 || $p['age'] < 1) {
                $result['status'] = FALSE;
                $result['message'] = 'Age of death or Year of death cannot be smaller than one';
                $result['average'] = -1;
            }

            if ($p['death'] < $p['age'] || $p['death'] === $p['age']) {
                $result['status'] = FALSE;
                $result['message'] = 'Year of death cannot be smaller or equal than Age of death';
                $result['average'] = -1;
            }

            if ($p['death'] - $p['age'] > 35) {
                $result['status'] = FALSE;
                $result['message'] = 'Cannot execute more than 35 recursive process';
                $result['average'] = -1;
            }
        }

        return $result;
    }
}