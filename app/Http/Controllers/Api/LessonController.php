<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    private $lessons;

    public function __construct(Lesson $lessons)
    {
        $this->lessons = $lessons;
    }

    public function index()
    {
        $lessons = $this->lessons->paginate('10');
        return response()->json($lessons, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try{
            $lesson = $this->lessons->create($data);
            return response()->json([
                'data' => ['msg' => 'Aula casdastrada!']], 200);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }    
    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        try{
            $lesson = $this->lessons->findOrFail($id);
            $lesson->update($data);
            return response()->json([
                'data' => ['msg' => 'Aula atualizada!']], 200);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }  
    }

    public function destroy($id)
    {
        try{
            $lesson = $this->lessons->findOrFail($id);
            $lesson->delete();
            return response()->json([
                'data' => ['msg' => 'Aula apagada!']], 200);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }  
    }

    public function show($id)
    {
        try{
            $lesson = $this->lessons->findOrFail($id);
            return response()->json([
                'data' => $lesson, 200]);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }  
    }
}
