<?php

namespace App\Repositories;

use App\Time;

class TimeRepository 
{
	
	public function findAll()
	{
        return  Time::all();
	}  
	
}