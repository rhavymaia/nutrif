<?php

function converterData($data) {

    $birthday = new DateTime($data);
    $date = new DateTime();
    $diff = $birthday->diff($date);
    $months = $diff->format('%m') + 12 * $diff->format('%y');

    return $months;
}
         
        
?>
