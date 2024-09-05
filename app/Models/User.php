<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name',
        'email',
        'password',
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


    //获取用户头像
    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    //关联微博表
    public function statuses()  {
        return $this->hasMany(Status::class);

    }

    //取出用户发布的微博
    public function feed() {
        return $this->statuses()->orderBy('created_at','desc');

    }

    //一个用户有多个粉丝
    public function followers() {
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }

    //一个用户可以关注多个人
    public function followings() {
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }

    //关注
    public function follow($user_ids) {
        if(! is_array($user_ids)){
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids,false);

    }

    //取消关注
    public function unfollow($user_ids){
        if ( ! is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }

    //是否关注
    public function isFollowing($user_id){
        return $this->followings->contains($user_id);
    }
}
