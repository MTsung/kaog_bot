<?php

class cut extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $this->setRoles('799627678700273664');
        $this->rmRoles('483324065369554976');
    }
}