<?php

namespace App\Constants;

use ReflectionClass;

class UserType
{
    const JOBSEEKER = 'job seeker';
    const ADMIN = 'admin';

    public static function getConstants()
    {
        $object = new ReflectionClass(__CLASS__);
        return $object->getConstants();
    }
}