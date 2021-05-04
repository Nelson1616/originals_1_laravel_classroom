<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $users;
    public function __construct(User $users)
    {
        $this->users = $users;
    }
    
    public function index()
    {
        $users = $this->users->paginate('10');
        return response()->json($users, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try{
            $data['password'] = bcrypt($data['password']);
            $user = $this->users->create($data);
            return response()->json([
                'data' => ['msg' => 'Usuário casdastrado!']], 200);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }    
    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        try{
            $data['password'] = bcrypt($data['password']);
            $user = $this->users->findOrFail($id);
            $user->update($data);
            return response()->json([
                'data' => ['msg' => 'Usuário atualizado!']], 200);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }  
    }

    public function destroy($id)
    {
        try{
            $user = $this->users->findOrFail($id);
            $user->delete();
            return response()->json([
                'data' => ['msg' => 'Usuário apagado!']], 200);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }  
    }

    public function show($id)
    {
        try{
            $user = $this->users->findOrFail($id);
            return response()->json([
                'data' => $user, 200]);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }  
    }
}
