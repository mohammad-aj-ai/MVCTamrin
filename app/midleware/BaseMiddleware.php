<?php

namespace app\app\midleware;

interface Middleware {

    public function next() : bool;
}