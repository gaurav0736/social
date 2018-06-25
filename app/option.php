<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class option extends Model
{
    
     protected $fillable = [
    	'option_name', 'option_value'
    ];

    public static function form(){
    	return ['option_name'=> '',
    			'option_value'=>''
    		];
    }
}
