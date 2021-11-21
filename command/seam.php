<?php

class seam extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $this->setRoles('483324065369554976');
        $this->rmRoles('799627678700273664');
    }
}