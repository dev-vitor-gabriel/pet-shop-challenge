<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = "tb_pet";

    protected $fillable = [
        'des_pet_tbp',
        'id_cliente_tbp',
        'is_ative_tbp'
    ];

    public static function getAll($id_user)
    {
        $data = Pet::select(['*']);
        if ($id_user != null) {
            $data = $data->where('id_cliente_tbp', $id_user);
        }
        $data = $data->get();
        return response()->json($data);
    }

    public static function getById(Int $id = null, $id_user)
    {
        if ($id) {
            $data = Pet::select(['*'])->where('id_pet_tbp', $id);
            if ($id_user != null) {
                $data = $data->where('id_cliente_tbp', $id_user);
            }
            $data = $data->get();
        } else {
            $data = Pet::select(['*'])->get();
        }
        return response()->json($data);
    }

    public static function updateReg(Int $id_pet, $obj, $id_user)
    {
        $data = Pet::where('id_pet_tbp', $id_pet);
        if ($id_user != null) {
            $data = $data->where('tb_pet.id_cliente_tbp', $id_user);
        }
        $data = $data->update([
            'des_pet_tbp' => $obj->des_pet_tbp
        ]);

        return $data;
    }

    public static function deleteReg($id_pet, $id_user)
    {
        $data = Pet::where('id_pet_tbp', $id_pet);
        if ($id_user != null) {
            $data = $data->where('tb_pet.id_cliente_tbp', $id_user);
        }
        $data = $data->update([
            'is_ative_tbp' => 0
        ]);

        return $data;
    }
}
