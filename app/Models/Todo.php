<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected  $table = 'tasks';

    // protected $fillable = [];

    /**
    * Attributes that are not mass assignable
    *
    * @var array
    */
    protected $guarded = ['id'];


     /**
    * Attributes that hidden
    *
    * @var array
    */
    protected $hidden = ['user_id'];

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


    public function ScopeMyTasks($q) {
    	return $q->where('user_id', auth()->user()->id);
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

     /**
    *
    * Get the created at attribute
    *
    * @param $val
    * @return string
    */
    public function getCreatedAtAttribute($val) {
        return $val ?  \Carbon\Carbon::parse($val)->format('Y-m-d H:i:s'): null;
    }


    /**
    *
    * Get the updated at attribute
    *
    * @param $val
    * @return string
    */
    public function getUpdatedAtAttribute($val) {
        return $val ?  \Carbon\Carbon::parse($val)->format('Y-m-d H:i:s') : null;
    }

}
