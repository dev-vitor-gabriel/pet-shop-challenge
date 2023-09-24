<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;


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
        'is_admin',
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

    public static function getAll($id_user)
    {
        $data = User::select(['*']);
        if ($id_user != null) {
            $data = $data->where('users.id', $id_user);
        }
        $data = $data->get();

        return response()->json($data);
    }

    public static function updateReg(Int $id, $obj, $id_user)
    {
        $data = User::where('id', $id);
        if ($id_user != null) {
            $data = $data->where('users.id', $id_user);
        }
        $arrayColumns = [];
        if (isset($obj->name))
            $arrayColumns['name'] = $obj->name;
        if (isset($obj->email))
            $arrayColumns['email'] = $obj->email;
        if (isset($obj->password))
            $arrayColumns['password'] = Hash::make($obj->password);
        if (isset($obj->is_admin))
            $arrayColumns['is_admin'] = $obj->is_admin ?? false;
        $data = $data->update($arrayColumns);
        return $data;
    }

    public static function deleteReg($id, $id_user)
    {
        $data = User::where('id', $id);
        if ($id_user != null) {
            $data = $data->where('users.id', $id_user);
        }
        $data = $data->delete();

        return $data;
    }

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
}
