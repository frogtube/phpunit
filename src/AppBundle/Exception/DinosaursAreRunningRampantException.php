<?php

namespace AppBundle\Exception;


class DinosaursAreRunningRampantException extends \Exception
{
    protected $message = "You cannot put dino into an enclosure without security! They will escape!";

}