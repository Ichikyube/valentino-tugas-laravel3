<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
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
    protected $stable = "pengguna";

    protected static function boot() {
        parent::boot();
        static::creating(function(User $pengguna) {
            $pengguna->password = Hash::make($pengguna->password);
        });
        static::updating(function (User $pengguna) {
            if($pengguna->isDirty(["password"])) {
                $pengguna->password = Hash::make($pengguna->password);
            }
        });
    }
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

    public function post()
    {
        return $this->hasMany(Post::class);
    }

	// user has many comments
	public function comments()
	{
		return $this->hasMany('App\Comments','from_user');
	}

	public function can_post()
	{
		$role = $this->role;
		if($role == 'author' || $role == 'admin')
		{
			return true;
		}
		return false;
	}

	public function is_admin()
	{
		$role = $this->role;
		if($role == 'admin')
		{
			return true;
		}
		return false;
	}
}
