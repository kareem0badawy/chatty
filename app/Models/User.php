<?php

namespace Chatty\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class User extends Model implements AuthenticatableContract
                                    
                                  
{
    use Authenticatable;

    
    protected $table = 'users';


    protected $fillable = [
                'username',
                'password',
                'email',
                'first_name',
                'last_name',
                'location'
              ];


    protected $hidden = [
                'password',
                'remember_token'
                ];

    public function getName()
    {
           if($this->first_name && $this->last_name){
                return "{$this->first_name} {$this->last_name}";
           }

            if($this->first_name){
                return $this->first_name;
           }
        return null;
    }
    public function getNameOrUsername(){
       return $this->getName() ?: $this->username;
    }

    public function getFirstNameOrUsername(){
        return $this->first_name ?: $this->username;
    }

    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=mm&s=40";
    }

}