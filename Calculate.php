<?php

include_once 'Validation.php';
include_once 'Fibonacci.php';

class Calculate
{
    public function __construct()
    {
        $this->validation = new Validation();
        $this->fibonacci = new Fibonacci();
    }

    /**
     * @param $post
     * @return array
     */
    public function postData($post)
    {
        $validation = $this->validation->validateData($post);

        if (!$validation['status']) {
            return $validation;
        }

        $person = $post['person'];

        $result = [];
        $tempAverage = [];
        foreach ($person as $key=>$p) {
            $born = $p['death'] - $p['age'];

            $tempKilled = $this->fibonacci->calculate($born);
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
}