<?php

namespace App\Models;

use App\Models\Order as ModelsOrder;
use App\Models\User as ModelsUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Rate;


class User extends Authenticatable implements JWTSubject

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
        'phone',
        'address',
        'addresscode',
        'dob',
        'google_id',
        'facebook_id',
        'avatar',
    ];

    //relationship with order table
    public function order(): HasMany
    {
        return $this->hasMany(ModelsOrder::class, 'id');
    }

    //relationship with rate table
    public function rate(): HasMany
    {
        return $this->hasMany(Rate::class, 'id');
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

        'remember_token',
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function updateProfile($data)
    {
        $action = User::where('id', $data['userID']);
        $result = $action->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'dob' => $data['dob'],
            'addresscode' => $data['addresscode'],

        ]);
        if ($result == 1) {
            $getdata = User::where('id', $data['userID'])->get();
            return $getdata;
        }
        return $result;
    }



    public function resetPassword($data)
    {
        $currentPassword = $data['currentPassword'];
        $newPassword = hash::make($data['newPassword']);
        $getData = User::where('id', $data['userID'])->get();

        $check = $getData->first()->getOriginal('password');
        if (Hash::check($currentPassword, $check)) {
            $result = User::where('id', $data['userID'])->update(['password' => $newPassword]);
            return $result;
        }
        return 0;
    }
}
