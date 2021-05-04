<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;

class ModulesController extends Controller
{
    private $modules;
    public function __construct(Module $modules)
    {
        $this->modules = $modules;
    }
    
    public function index()
    {
        $modules = $this->modules->paginate('10');
        return response()->json($modules, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try{
            
            $module = $this->modules->create($data);
            return response()->json([
                'data' => ['msg' => 'Módulo casdastrado!']], 200);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }    
    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        try{
            
            $module = $this->modules->findOrFail($id);
            $module->update($data);
            return response()->json([
                'data' => ['msg' => 'Módulo atualizado!']], 200);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }  
    }

    public function destroy($id)
    {
        try{
            $module = $this->modules->findOrFail($id);
            $module->delete();
            return response()->json([
                'data' => ['msg' => 'Módulo apagado!']], 200);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }  
    }

    public function show($id)
    {
        try{
            $module = $this->modules->findOrFail($id);
            return response()->json([
                'data' => $module, 200]);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }  
    }
}
