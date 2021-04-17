<?php

class Validation
{
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