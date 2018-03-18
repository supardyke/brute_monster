<?php defined('BASEPATH') OR exit('No direct script access allowed');


class BruteMonster {


    // max amount of trial
    public $max_trial = 3;
    // amount of time in milliseconds before next trial
    public $next_trial = 30;
    // bool value of the request status if it is an attack or not
    public $brute_status;

    public function _construct(){
        session_start();
    }


    public function check($email){
        // check for previous data
        if (empty($_SESSION['unique_key'])) {
            $_SESSION['unique_key'] = $email;
            $_SESSION['unique_key_count'] = 1;
        }else{
            $unique_key = $_SESSION['unique_key'];
            $unique_key_count = $_SESSION['unique_key_count'];
            if ($unique_key_count > $this->max_trial) {
                $c_time_unix = date_timestamp_get(date_create());
                if (empty($_SESSION['next_trial'])) {
                    $_SESSION['next_trial'] = $c_time_unix + $this->next_trial;
                    $this->brute_status = true;
                }else{
                    if ($c_time_unix > $_SESSION['next_trial']) {
                        $_SESSION['next_trial'] = '';
                        $_SESSION['unique_key_count'] = 1;
                        $this->brute_status = false;
                    }else{
                        $this->brute_status = true;
                    }
                }
            }else{
                $_SESSION['unique_key_count'] += 1;
                $this->brute_status = false;
            }
        }
        $brute_status = $this->brute_status;
        $_SESSION['brute_status'] = $brute_status;
        return $this->brute_status;
    }
}