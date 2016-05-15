<?php

namespace Chatty\Models;

use Illuminate\Database\Eloquent\Model;



class Like extends Model 
{
    protected $table = 'likeable';

    public function likeable()
    {
        //this is polymorphic relationships 
        
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('Chatty\Models\User', 'user_id');
    }
    
}  