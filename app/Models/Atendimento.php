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
        'dta_atendimento_tba',
    ];

    public static function getAll($id_user) {
        $data = Atendimento::select([
            'id_atendimento_tba',
            'name',
            'des_pet_tbp',
            'dta_atendimento_tba',
            'tb_atendimento.created_at',
            'tb_atendimento.updated_at'
        ])
        ->join('tb_pet', 'tb_pet.id_pet_tbp', '=', 'tb_atendimento.id_pet_tba')
        ->join('users', 'users.id', '=', 'tb_pet.id_cliente_tbp');
        if($id_user != null){
            $data = $data->where('users.id', $id_user);
        }
        $data = $data->get();

        return response()->json($data);
    }

    public static function getById(Int $id = null, $id_user) {
        if($id) {
            $data = Atendimento::select([
            'id_atendimento_tba',
            'name',
            'des_pet_tbp',
            'dta_atendimento_tba',
            'tb_atendimento.created_at',
            'tb_atendimento.updated_at'
            ])
            ->join('tb_pet', 'tb_pet.id_pet_tbp', '=', 'tb_atendimento.id_pet_tba')
            ->join('users', 'users.id', '=', 'tb_pet.id_cliente_tbp')
            ->where('id_pet_tbp', $id);
            if($id_user != null){
                $data = $data->where('users.id', $id_user);
            }
            $data = $data->get();
        }else{
            $data = Atendimento::select([
            'id_atendimento_tba',
            'name',
            'des_pet_tbp',
            'dta_atendimento_tba',
            'tb_atendimento.created_at',
            'tb_atendimento.updated_at'
            ])
            ->join('tb_pet', 'tb_pet.id_pet_tbp', '=', 'tb_atendimento.id_pet_tba')
            ->join('users', 'users.id', '=', 'tb_pet.id_cliente_tbp');
            if($id_user != null){
                $data = $data->where('users.id', $id_user);
            }
            $data = $data->get();
        }
        return response()->json($data);
    }

    public static function updateReg(Int $id_atendimento, $obj, $id_user) {
        $data = Atendimento::where('id_atendimento_tba', $id_atendimento);
        if($id_user != null){
            $data = $data->join('tb_pet', 'tb_pet.id_pet_tbp', '=', 'tb_atendimento.id_pet_tba')
            ->join('users', 'users.id', '=', 'tb_pet.id_cliente_tbp')
            ->where('users.id', $id_user);
        }
        $data = $data->update([
            'id_pet_tba'          => $obj->id_pet_tba,
            'dta_atendimento_tba' => $obj->dta_atendimento_tba,
        ]);

        return $data;
    }

    public static function deleteReg($id_atendimento, $id_user) {
        $data = Atendimento::where('id_atendimento_tba', $id_atendimento);
        if($id_user != null){
            $data = $data->join('tb_pet', 'tb_pet.id_pet_tbp', '=', 'tb_atendimento.id_pet_tba')
            ->join('users', 'users.id', '=', 'tb_pet.id_cliente_tbp')
            ->where('users.id', $id_user);
        }
        $data = $data->delete();

        return $data;
    }
}
