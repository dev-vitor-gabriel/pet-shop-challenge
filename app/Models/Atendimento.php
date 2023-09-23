<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    use HasFactory;

    protected $table = "tb_atendimento";

    protected $fillable = [
        'id_pet_tba',
    ];

    public static function getAll() {
        $data = Atendimento::select([
            'id_atendimento_tba',
            'des_pet_tbp',
            'name',
            'tb_atendimento.created_at',
            'tb_atendimento.updated_at'
        ])
        ->join('tb_pet', 'tb_pet.id_pet_tbp', '=', 'tb_atendimento.id_pet_tba')
        ->join('users', 'users.id', '=', 'tb_pet.id_cliente_tbp')
        ->get();

        return response()->json($data);
    }

    public static function getById(Int $id = null) {
        if($id) {
            $data = Atendimento::select([
                'id_atendimento_tba',
                'des_pet_tbp',
                'name',
                'tb_atendimento.created_at',
                'tb_atendimento.updated_at'
            ])
            ->join('tb_pet', 'tb_pet.id_pet_tbp', '=', 'tb_atendimento.id_pet_tba')
            ->join('users', 'users.id', '=', 'tb_pet.id_cliente_tbp')
            ->where('id_pet_tbp', $id)
            ->get();
        }else{
            $data = Atendimento::select([
                'id_atendimento_tba',
                'des_pet_tbp',
                'name',
                'tb_atendimento.created_at',
                'tb_atendimento.updated_at'
            ])
            ->join('tb_pet', 'tb_pet.id_pet_tbp', '=', 'tb_atendimento.id_pet_tba')
            ->join('users', 'users.id', '=', 'tb_pet.id_cliente_tbp')
            ->get();
        }
        return response()->json($data);
    }

    public static function updateReg(Int $id_atendimento, $obj) {
        Atendimento::where('id_atendimento_tba', $id_atendimento)
        ->update([
            'id_pet_tba' => $obj->id_pet_tba
        ]);
    }

    public static function deleteReg($id_atendimento) {
        Atendimento::where('id_atendimento_tba', $id_atendimento)
        ->delete();
    }
}
