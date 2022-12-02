<?php

namespace App\Http\Controllers;

use App\Models\TodoModel;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Http\Request;

class TodoModelController extends Controller
{
    public function index()
    {
        $data = TodoModel::orderby('created_at', 'desc')->get();

        foreach($data as $item){
            if($item->todo_status == 1){
                $item->todo_status = 'completed';
            }else{
                $item->todo_status = 'active';
            }
        }

        return view('todo', ['data' => $data]);
    }

    public function create(Request $request){
        $data = new TodoModel();
        $data->todo_name = $request->todo_name;
        $data->todo_status = 0;
        $data->created_at = now();
        $data->save();

        return redirect()->route('todo');
    }

    public function mark(Request $request, $id)
    {
        $data = TodoModel::findorfail($id);
        $data->todo_status = $data->todo_status == 1 ? 0 : 1;
        $data->save();

        return response()->json(['status' => 200]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;   
        TodoModel::where('id', $id)->delete();
        
        return redirect()->route('todo');
    }

    public function destroyall()
    {
        TodoModel::where('todo_status', 1)->delete();
        return redirect()->route('todo');
    }
}
