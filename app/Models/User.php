<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use phpDocumentor\Reflection\Types\Boolean;

class User extends Authenticatable
{
    use HasFactory, Notifiable, hasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // relationships
    public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function friendships(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            Friendship::class,
            "A",
            "id"
        )->with("two");
    }

    public function notifications(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Notification::class, "to","id");
    }

    // helper methods
    public function friendsWith(User $user): Boolean {
        return Friendship::where("A", $this->id)
            ->where("B", $user->id)->exists();
    }

    public function requests() {
        return Notification::where("to",$this->id)->where("type",1);
    }

    public function feed() {
        $friendships = $this->friendships;
        $posts = collect();
        foreach($friendships as $friendship) {
            $friendPosts = $friendship->two->posts->load(["likes","comments","author"]);
            foreach($friendPosts as $post)
                $posts->add($post);
        }
        foreach(Auth()->user()->posts as $post)
            $posts->add($post);

        return $posts->sortByDesc("created_at");
    }
}
