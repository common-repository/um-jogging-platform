<?php

class UMJP_advice{

    function __construct() {

        add_action('um_profile_content_jogging_advice', array(&$this,'render'));
        $this->distance = 0;
    }


    function render() {
        if (!array_key_exists('goal', $_POST)){
            umjp_render_template('umjp-advice-template');
            wp_enqueue_style( 'umjp-advice.css' , umjp_CSS . 'umjp-advice.css' );
        } else {
            wp_enqueue_style( 'umjp-advice-output.css' , umjp_CSS . 'umjp-advice-output.css' );
            umjp_render_template('umjp-advice-output-template');
        }
    }


    function get_advice() {

        if(!array_key_exists('goal', $_POST) || !array_key_exists('amountWeek', $_POST) || !array_key_exists('intensity', $_POST)
        || !array_key_exists('interval', $_POST)) {
            return;
        }
        
        $this->goal       =   sanitize_key($_POST['goal']);
        $this->intensity  =   sanitize_key($_POST['intensity']);
        $this->interval   =   sanitize_key($_POST['interval']);
        $this->amountWeek =   sanitize_key($_POST['amountWeek']);

        if (array_key_exists('timeMin', $_POST)) {
            $this->timeMin   =   sanitize_key($_POST['timeMin']);
        }

        if (array_key_exists('distance', $_POST)) {
            $this->distance  =   sanitize_key($_POST['distance']);
        }


        if (!$this->goal || !$this->amountWeek || 
            !$this->intensity || !$this->interval) {
            return;
        }

     
        $advice = [];

        for ($i = 0; $i < $this->amountWeek; $i++) {

            array_push($advice, $this->getOneTraining());

        }

        if ($this->interval == 'true') {
            $this->applyInterval($advice);
        }

        return $advice;

    } 

////////////// apply intervals/////////////////////////////////////////////////////////////////////////////////

    function applyInterval(&$advice) {

        $cardioIntervals = [
            3 => 0.18,
            4 => 0.15,
            5 => 0.12,
            6 => 0.10,
        ];

        $vitalityIntervals = [
            3 => 0.15,
            4 => 0.13,
            5 => 0.10,
            6 => 0.08,
        ];

        $weightIntervals = [
            3 => 0.12,
            4 => 0.10,
            5 => 0.08,
            6 => 0.06,
        ];

        for ($i = 0; $i < $this->amountWeek; $i++) {

            $duration = $advice[$i]['duration'];

            if ($this->goal == 'cardio') {
                $this->intervalCreator($cardioIntervals, $duration, $advice, $i);
            }

            if ($this->goal == 'vitality') {
                $this->intervalCreator($vitalityIntervals, $duration, $advice, $i);
            }

            if ($this->goal == 'weight') {
                $this->intervalCreator($weightIntervals, $duration, $advice, $i);
            }

        }

    }

    // helper function of the applyInterval function, highly coupled to it
    function intervalCreator ($Intervals, $duration, &$advice, $i) {
        // need totalDuration because duration will get manipulated
        $totalDuration = $duration;
        $remainder = $duration;
        $advice[$i]['intervalTime'] = [];
        $advice[$i]['intervalIntensity'] = [];

        // first 4 minutes of training always with no interval
        array_push($advice[$i]['intervalTime'], 2);
        array_push($advice[$i]['intervalIntensity'], 0);

        $remainder -= 4;

        while ($remainder > 0) {

            switch(true) {
                case $totalDuration < 20:
                $random = rand(3,5);
                break;

                case $totalDuration < 30:
                $random = rand(3,6);
                break;

                case $totalDuration < 40:
                $random = rand(4,6);
                break;

                case $totalDuration < 50:
                $random = rand(4,6);
                break;

                default:
                $random = rand(5,6);
                break;
            }

            $previousRemainder = $remainder;
            $remainder -= $random * 2;

            if ($remainder > 0) {
                array_push($advice[$i]['intervalTime'], $random);
                array_push($advice[$i]['intervalIntensity'], $Intervals[$random]);
            } else {
                array_push($advice[$i]['intervalTime'], ($previousRemainder /2));
                array_push($advice[$i]['intervalIntensity'], 0);

                //if the last interval (cooldown) is very short this if block enlarges it
                if ( end($advice[$i]['intervalTime']) < 2 ) {
                    $timeDifference = (4 - end($advice[$i]['intervalTime']) * 2 );
                    $advice[$i]['duration'] += $timeDifference;
                    array_pop($advice[$i]['intervalTime']);
                    array_push($advice[$i]['intervalTime'], 2);
                }
            }
        }


    }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////    Helper functions for generating the schedules   ////////////////////////////////////

    function getOneTraining() {

        $schedule = [];

        // if there is no distance preference, a function will generate this
        if (!array_key_exists('distance', $_POST)) {
            $schedule['distance'] = $this->getDistance();
         } else {
            $schedule['distance'] = $this->distance;
         }
         $this->distance = $schedule['distance'];

         // if there is no time preference a funciton will generate this
         if (!array_key_exists('timeMin', $_POST)) {
            $schedule['duration'] = $this->getDuration();
         } else {
            $schedule['duration'] = $this->timeMin;
         }

        return $schedule;

    }


    // gets the distance when the user has no preference
    function getDistance() {

        $correction = $this->correct_Age_Gender();

        $distance =  rand(7,9);

        if (array_key_exists('timeMin', $_POST)) {
            $distance = ($this->timeMin * 0.15);
        }


        

        if (array_key_exists('timeMin', $_POST)) { 

            switch ($this->intensity) {
                case 1:
                $distance -= 0.025 * $this->timeMin;
                    break;
                case 2:
                $distance -= 0.01 * $this->timeMin;
                    break;
                case 3:
                $distance += 0.00 * $this->timeMin;
                    break;
                case 4:
                $distance += 0.015 * $this->timeMin;
                    break;
                case 5:
                $distance += 0.03 * $this->timeMin;
                    break;
                }

        } else {

            switch ($this->intensity) {
                case 1:
                $distance -= 1;
                    break;
                case 2:
                $distance -= 0.4;
                    break;
                case 3:
                $distance += 0.0;
                    break;
                case 4:
                $distance += 0.6;
                    break;
                case 5:
                $distance += 1.2;
                    break;
            }
        }


        if (array_key_exists('timeMin', $_POST)) {

            $distance *= $correction['age'];
            $distance *= ($correction['gender'] - 0.135);
        }

        // because in the case of no preferred time and distance entered there are 2 RNG corrections
        $controlFluctuation = 5;

        if(array_key_exists('timeMin', $_POST)) {
            $controlFluctuation = 0;
        }


        if ($this->goal == 'weight') {
            $distance *= rand(100, (110 - $controlFluctuation)) / 100;
        }

        if ($this->goal == 'vitality') {
            $distance *= rand(95, (105 - $controlFluctuation)) / 100;
        }

        if ($this->goal == 'cardio') {
            $distance *= rand(105, (115 - $controlFluctuation)) / 100;
        }

        return $distance;
    }




    // gets the duration when the user has no preference
    function getDuration() {

        $correction = $this->correct_Age_Gender();

        $duration = $this->distance * 7.5;

        $duration -=  ($correction['gender'] * $this->distance) / 3;

        if (1/$correction['age'] != 1) {
            $duration += (5 + (1/$correction['age']) * $this->distance);
        }

        if ($this->goal == 'weight') {
            $duration +=  0.1 * $this->distance;
            $duration +=  rand ( -40 , 40 ) / 100 * $this->distance;
        }

        if ($this->goal == 'vitality') {
            $duration -=  0.4 * $this->distance;
            $duration +=  rand ( -40 , 40 ) / 150 * $this->distance;
        }

        if ($this->goal == 'cardio') {
            $duration -=  1 * $this->distance;
            $duration +=  rand ( -40 , 40 ) / 150 * $this->distance;
        }

        switch ($this->intensity) {
            case 1:
            $duration +=  0.5 * $this->distance;    
                break;
            case 2:
            $duration +=  0.3 * $this->distance;   
                break;
            case 3:
            $duration -=  0.5 * $this->distance;   
                break;
            case 4:
            $duration -=  1 * $this->distance;  
                break;
            case 5:
            $duration -=  1.4 * $this->distance;  
                break;
        }

        return round($duration , 1);
    }



// Correction for ages and gender
// sexes correction> 1.2 more workload for males
// Age correction after 50> each year 0.975 less workload 
    function correct_Age_Gender() {

        $corrections = [
            "age" => "",
            "gender" => "",
        ];

        $gender = get_user_meta( get_current_user_id(), 'gender', true );
        if(!$gender) {
            $gender = 'female';
        }

        
        if($gender == 'female') {
            $corrections['gender'] = 1;
        } else {
            $corrections['gender'] = 1.2;   
        }

        $currentTime = date('Y-m-d');
        $aob = get_user_meta( get_current_user_id(), 'aob', true );
        if(!$aob) {
            $aob = date('Y-m-d', strtotime('-30 years'));
        }
        
        $age =  substr($currentTime, 0, 4) - substr($aob, 0, 4);

        if($age > 50) { 
            $correctionYears = $age - 50;
            $correctionAmount = 1 - $correctionYears * 0.025;
            $corrections['age'] = $correctionAmount;
        } else {
            $corrections['age'] = 1;
        }
        
        return $corrections;
    }




}