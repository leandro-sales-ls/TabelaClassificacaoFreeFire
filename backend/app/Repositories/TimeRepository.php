<?php

namespace App\Repositories;

use App\Time;
use Illuminate\Database\Eloquent\Model;

class TimeRepository 
{
	
	public function findAll()
	{
        return  Time::all();
	}  
	
	public function find($id)
	{
		// return  Time::find
        return  Time::where('id', $id)->first();
	}  
	
}