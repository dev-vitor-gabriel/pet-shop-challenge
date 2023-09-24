<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PetController extends Controller
{
    /**
     * Create new pet .
     *
     * @param $id_atendimento
     */
    public function create(Request $request)
    {

        $request->validate([
            'des_pet_tbp' => 'required|string|max:255'
        ]);
        $pet = Pet::create([
            'des_pet_tbp' => $request->des_pet_tbp,
            'id_cliente_tbp' => Auth::id(),
            'is_ative_tbp' => 1,
        ]);

        return response()->json($pet, 201);
    }

    /**
     * List all pets or a single pet if you have the id_pet .
     *
     * @param $id_atendimento
     */
    public function get(Int $id_pet = null)
    {
        $is_admin = auth()->user()->is_admin;
        $id_user  = Auth::id();

        if ($is_admin) {
            $id_user = null;
        }
        if ($id_pet) {
            $data = Pet::getById($id_pet, $id_user);
            return $data;
        }
        $data = Pet::getAll($id_user);
        return $data;
    }

    /**
     * Change one pet .
     *
     * @param $id_pet
     */
    public function update(Int $id_pet, Request $request)
    {
        $is_admin = auth()->user()->is_admin;
        $id_user  = Auth::id();

        if ($is_admin) {
            $id_user = null;
        }
        $request->validate([
            'des_pet_tbp' => 'required|string|max:255'
        ]);
        $pet = Pet::updateReg($id_pet, $request, $id_user);

        if ($pet == false) {
            return response()->json(null, 404);
        }
    }

    /**
     * Delete one pet .
     *
     * @param $id_pet
     */
    public function delete(Int $id_pet)
    {
        $is_admin = auth()->user()->is_admin;
        $id_user  = Auth::id();

        if ($is_admin) {
            $id_user = null;
        }

        $pet = Pet::deleteReg($id_pet,$id_user);

        if ($pet == false) {
            return response()->json(null, 404);
        }
    }
}
