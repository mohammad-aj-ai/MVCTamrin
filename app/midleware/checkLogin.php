<?php

namespace app\app\midleware;

class CheckLogin {

    public function check() {
        if(isset($_COOKIE['id']))
            return true;
    }
}