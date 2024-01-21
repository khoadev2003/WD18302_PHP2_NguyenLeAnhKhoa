<?php

namespace Errors;

class Error
{
    public function not()
    {
        $this->render('errors/404');
    }
}