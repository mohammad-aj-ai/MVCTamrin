<?php

namespace app\app\midleware;

use app\app\midleware\Middleware;

class CheckLogin implements Middleware {

    private function check() {
        
    }

    public function next() : bool
    {
        return true;
    }
}