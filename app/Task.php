<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table ='tasks';
 
    public $primaryKey = 'id';

    public $timestamps = true;
    
    public function user(){
        return $this->belongsTo('App\User');
    }

    protected $casts = [
        'assigned_to' => 'array',
        'observers' => 'array',
    ];
}
