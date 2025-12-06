<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // GET ALL USERS
    public function index()
    {
        return view('admin.user');
    }

    public function getData()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'message' =>'List data users berhasil di tampilkan',
            'data' => $users
        ],200);
    }

    // STORE USER
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'=> 'required|string|max:255',   
            'email'=> 'required|string|email|max:255|unique:users',   
            'password'=> 'required|string|min:8',   
            'phone'=> 'nullable',   
            'address'=> 'nullable',   
            'role'=> 'nullable',   
        ]);

        $validateData['password'] = Hash::make($validateData['password']);

        $user = User::create($validateData);

        return response()->json([
            'status' => true,
            'message' => 'User berhasil di tambahkan',
            'data' => $user
        ],201);
    }

    // SHOW USER
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json([
                'status' => true,
                'message'=> 'Detail Data user berhasil ditampilkan',
                'data' => $user
            ],200);

        } catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }
    }

    // UPDATE USER
    public function update(Request $request, $id)
    {
        try{
            $user = User::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|string|email|max:255|unique:users,email,' .$id,
                'password'=> 'nullable|string|min:8',
                'phone'=> 'nullable',
                'address'=> 'nullable',
                'role'=> 'nullable',
            ]);

            if (isset($validatedData['password'])){
                $validatedData['password'] = Hash::make($validatedData['password']);
            }

            $user->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil diperbarui',
                'data' => $user
            ], 200);

        } catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }
    }

    // DELETE USER
    public function destroy($id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'status' => true,
                'message' => 'User berhasil dihapus',
            ],200);

        } catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }
    }
}