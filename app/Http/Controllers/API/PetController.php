<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PetController extends Controller
{
    public function create(Request $request) {

        $request->validate([
            'des_pet_tbp' => 'required|string|max:255'
        ]);
            $pet = Pet::create([
                'des_pet_tbp' => $request->des_pet_tbp,
                'id_cliente_tbp'=> Auth::id(),
                'is_ative_tbp' => 1,
            ]);

        return response()->json($pet,201);
    }


    public function get(Int $id_pet = null) {
        if($id_pet){
            $data = Pet::getById(($id_pet));
            return $data;
        }
        $data = Pet::getAll();
        return $data;
    }

    public function update(Int $id_pet, Request $request) {
        $request->validate([
            'des_pet_tbp' => 'required|string|max:255'
        ]); 
        Pet::updateReg($id_pet, $request);
    }

    // delete (inactivate)
    public function delete(Int $id_pet) {
        Pet::deleteReg($id_pet);
    }
}
