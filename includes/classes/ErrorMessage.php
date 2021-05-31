<?php

class ErrorMessage
{
    public static function show($error)
    {
        exit("<span class='error-banner'>$error</span>");
    }
}