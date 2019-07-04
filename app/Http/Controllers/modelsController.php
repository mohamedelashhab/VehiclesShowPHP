<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model;
use App\Make;
use App\Http\Resources\Model as ModelResource;
use Illuminate\Support\Facades\Auth;

class modelsController extends Controller
{



    public function Index(){
        $model = new Model();
        $models = $model->with('make')->get();
        return ModelResource::collection($models);
    }


    public function modelForm(){

        $models =  Model::with('make')->pluck('id','name')->toArray();
        $makes =  Make::all()->pluck('id','name')->toArray();
        return view('createmodel', compact('models','makes'));
    }


    public function Create(){
        $validatedData = request()->validate([
            'name' => 'required|max:255',
            'make_id' => 'required|integer',
        ]);
        $model = new Model();
        $model->name = $validatedData['name'];
        $model->make_id = $validatedData['make_id'];
        $model->save();
        return redirect()->route('model.form');
    }


    public function Update(Request $request,Model $model){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'make_id' => 'required'
        ]);
        $model->name = $validatedData['name'];
        $model->make_id = $validatedData['make_id'];
        $model->save();
        return new ModelResource($model);
    }


    public function Delete(Model $model){
        $model->delete();
        return response()->json(['mssg'=>'Deleted']);
    }


    public function Get($mk_id){
        
        $models = Model::where('make_id', $mk_id)->get();
        // dd($models[0]->name);
        return  $models;
    }
}
