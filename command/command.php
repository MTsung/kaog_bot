<?php

interface command
{
    public function __construct($event, $discord);
	public function run();
}