<?php

namespace App\Constants;

use ReflectionClass;

class JobApplicationStatus
{
    const PENDING = 'pending';
    const ACCEPTED = 'accepted';
    const REJECTED = 'rejected';

    public static function getConstants()
    {
        $object = new ReflectionClass(__CLASS__);
        return $object->getConstants();
    }
}