<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Partner extends Eloquent
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $collection = 'partner';
	protected $connection = 'mongodb';

	protected $fillable = [''];
	
}
