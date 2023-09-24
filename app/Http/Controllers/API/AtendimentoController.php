<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Atendimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AtendimentoController extends Controller
{
    public function create(Request $request) {

        $request->validate([
            'id_pet_tba' => 'required|int'
        ]);
            $pet = Atendimento::create([
                'id_pet_tba'          => $request->id_pet_tba,
                'dta_atendimento_tba' => $request->dta_atendimento_tba
            ]);

        return response()->json($pet,201);
    }

    public function get(Int $id_atendimento = null) {
        $is_admin = auth()->user()->is_admin;
        $id_user  = Auth::id();

        if($is_admin){
            $id_user = null;
        }

        if($id_atendimento){
            $data = Atendimento::getById($id_atendimento, $id_user);
            return $data;
        }

        $data = Atendimento::getAll($id_user);
        return $data;
    }

    public function update(Int $id_atendimento, Request $request) {
        $is_admin = auth()->user()->is_admin;
        $id_user  = Auth::id();

        if($is_admin){
            $id_user = null;
        }
        $request->validate([
            'id_pet_tba'          => 'int',
            'dta_atendimento_tba' => 'date'
        ]);
        $atendimento = Atendimento::updateReg($id_atendimento, $request, $id_user);

        if($atendimento == false){
            return response()->json(null,404);
        }
    }

    public function delete(Int $id_atendimento) {
        $is_admin = auth()->user()->is_admin;
        $id_user  = Auth::id();

        if($is_admin){
            $id_user = null;
        }

        $atendimento = Atendimento::deleteReg($id_atendimento, $id_user);

        if($atendimento == false){
          return response()->json(null,404);
        }
    }
}
