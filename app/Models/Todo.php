<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected  $table = 'tasks';

    // protected $fillable = [];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
    *
    * @return array
    *
    */
    public static function storeRules() {
    	return [
    		'name' => ['required', 'string'],
    		'description' => ['required', 'string'],

    	];
    }


    /**
    *
    * @return array
    *
    */
    public static function updateRules($id) {
    	return [
    		'name' => ['required', 'string'],
    		'description' => ['required', 'string'],
    	];
    }
}
