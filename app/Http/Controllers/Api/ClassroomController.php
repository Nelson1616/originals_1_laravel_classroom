<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    private $classrooms;

    public function __construct(Classroom $classrooms)
    {
        $this->classrooms = $classrooms;
    }

    public function index()
    {
        $classrooms = $this->classrooms->paginate('10');
        return response()->json($classrooms, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try{
            $classroom = $this->classrooms->create($data);

            /*
            if(isset($data['users']) && count($data['users']))
            {
                $classroom->users()->sync($data['users']);
            }
            */

            return response()->json([
                'data' => ['msg' => 'Sala casdastrada!']], 200);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }    
    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        try{
            $classroom = $this->classrooms->findOrFail($id);
            $classroom->update($data);
            return response()->json([
                'data' => ['msg' => 'Sala atualizada!']], 200);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }  
    }

    public function destroy($id)
    {
        try{
            $classroom = $this->classrooms->findOrFail($id);
            $classroom->delete();
            return response()->json([
                'data' => ['msg' => 'Sala apagada!']], 200);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }  
    }

    public function show($id)
    {
        try{
            $classroom = $this->classrooms->findOrFail($id);
            
            return response()->json(
            [
                'data' => $classroom, 200,
            ],
            );
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }  
    }

    public function enter(Request $request)
    {
        $data = $request->all();     
        try{
            $classroom = $this->classrooms->where('enter_code', $data['enter_code'])->first();
            if(isset($data['users']) && count($data['users']))
            {
                $classroom->users()->sync($data['users']);
            }
            return response()->json([
                'data' => ['msg' => 'Entou na sala!'], 200]);

        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function exit(Request $request)
    {
        $data = $request->all();
        $users = [];
        try{
            $classroom = $this->classrooms->findOrFail($data['classroom_id']);

            foreach($classroom->users as $student)
            {   
                if($student->id != $data['user_id'])
                {
                    array_push($users, $student->id);
                }
                
            }

            if(isset($users) && count($users))
                {
                    $classroom->users()->sync($users);
                }
                $classroom = $this->classrooms->findOrFail($data['classroom_id']);
                return response()->json([
                    'data' => ['msg' => 'Saiu da sala!'], 200]);                
        
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }     
    }
}
