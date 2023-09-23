<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Atendimento;
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    public function create(Request $request) {

        $request->validate([
            'id_pet_tba' => 'required|int'
        ]);
            $pet = Atendimento::create([
                'id_pet_tba' => $request->id_pet_tba,
            ]);

        return response()->json($pet,201);
    }


    public function get(Int $id_atendimento = null) {
        if($id_atendimento){
            $data = Atendimento::getById(($id_atendimento));
            return $data;
        }
        $data = Atendimento::getAll();
        return $data;
    }

    public function update(Int $id_atendimento, Request $request) {
        $request->validate([
            'id_pet_tba' => 'required|int'
        ]); 
        Atendimento::updateReg($id_atendimento, $request);
    }

    // delete (inactivate)
    public function delete(Int $id_atendimento) {
        Atendimento::deleteReg($id_atendimento);
    }
}
