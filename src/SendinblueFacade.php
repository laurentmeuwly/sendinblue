<?php

namespace LMeuwly\Sendinblue;

use Illuminate\Support\Facades\Facade;

class SendinblueFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sendinblue';
    }
}
