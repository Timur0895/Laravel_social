<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'surname',
        'name',
        'email',
        'password',
        'image_path',
        'banner_path'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post() {
      return $this->hasMany(Post::class)->get();
    }

    public function getNameAndSurname()
    {
      if ($this->name && $this->surname) {
        return "{$this->name} {$this->surname}";
      }

      if ($this->name) {
        return $this->name;
      }

      return null;
    }

    public function myFriend()
    {
      return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendOf()
    {
      return $this->belongsToMany('App\Models\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends() 
    {
      return $this->myFriend()->wherePivot('accept', true)->get()
        ->merge($this->friendOf()->wherePivot('accept' , true)->get());
    }

    # запрос в друзья
    public function friendRequests()
    {
      return $this->myFriend()->wherePivot('accept', false)->get();
    }

    # запрос на ожидание друга
    public function friendRequestsPending()
    {
      return $this->friendOf()->wherePivot('accept', false)->get();
    }
    
    # есть запрос на добавление в друзья
    public function hasFriendRequestPending(User $user)
    {
      return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    } 

    # получил запрос о дружбе
    public function  hasFriendRequestReceived(User $user)
    {
      return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    # добавить друга
    public function addFriend(User $user) 
    {
      $this->friendOf()->attach($user->id);
    }

    # Принять запрос на дружбу
    public function acceptFriendRequest(User $user)
    {
      $this->friendRequests()->where('id', $user->id)->first()->pivot()->update([
        'accept' => true
      ]);
    }

    # Дружит с 
    public function isFriendWith(User $user)
    {
      return (bool) $this->friends()->where('id', $user->id)->count();
    }
  }
