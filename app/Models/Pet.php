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

    public static function getAll() {
        $data = Pet::select(['*'])->get();
        return response()->json($data);
    }

    public static function getById(Int $id = null) {
        if($id) {
            $data = Pet::select(['*'])->where('id_pet_tbp', $id)->get();
        }else{
            $data = Pet::select(['*'])->get();
        }
        return response()->json($data);
    }

    public static function updateReg(Int $id_pet, $obj) {
        Pet::where('id_pet_tbp', $id_pet)
        ->update([
            'des_pet_tbp' => $obj->des_pet_tbp
        ]);
    }

    public static function deleteReg($id_pet) {
        Pet::where('id_pet_tbp', $id_pet)
        ->update([
            'is_ative_tbp' => 0
        ]);
    }}
