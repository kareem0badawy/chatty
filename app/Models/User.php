<?php

namespace Chatty\Models;

use Chatty\Models\Status;
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


    public function statuses()
    {
        return $this->hasMany('Chatty\Models\Status', 'user_id');
    }

    public function likes()
    {
        return $this->hasMany('Chatty\Models\Like', 'user_id');
    }
    
    public function friendsOfMine()
    {
        return $this->belongsToMany('Chatty\Models\User', 'friends', 'user_id', 'friend_id');
    }


    public function friendsOf()
    {
        return $this->belongsToMany('Chatty\Models\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()->
             merge($this->friendsOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequestes()
    {
         return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestesPending()
    {
        return $this->friendsOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestesPending(User $user)
    {
        return (bool) $this->friendRequestesPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestesReceived(User $user)
    {
        return (bool) $this->friendRequestes()->where('id', $user->id)->count();
    }

    public function addFriend(User $user)
    {
        $this->friendsOf()->attach($user->id);
    }

    public function acceptFriendRequestes(User $user)
    {
        $this->friendRequestes()->where('id', $user->id)->first()->pivot
        ->update([
            'accepted' => true,

            ]);
    }

    public function isFriendWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    public function hasLikedStatus(Status $status)
    {
        return (bool) $status->likes
            ->where('likeable_id', $status->id)
            ->where('likeable_type', get_class($status))
            ->where('user_id', $this->id)
            ->count();
    }
}
