<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Make;
use App\Http\Resources\Make as MakeResource;
class makesController extends Controller
{


    public function Index(){
        $make = new Make();
        $makes = $make->with('models')->get();
        return MakeResource::collection($makes);
    }

    public function makeForm(){
        $makes =  Make::all()->pluck('id','name')->toArray();
        return view('createmake', compact('makes'));
    }

    public function Create(){
        $validatedData = request()->validate([
            'name' => 'required|max:255'
        ]);
        $make = new Make();
        $make->name = $validatedData['name'];
        $make->save();
        return redirect()->route('make.form');
    }


    public function Update(Request $request,Make $make){
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);
        $make->name = $validatedData['name'];
        $make->save();
        return new MakeResource($make);
    }


    public function Delete(Make $make){
        $make->delete();
        return response()->json(['mssg'=>'Deleted']);
    }


    public function Get(Make $make){
        return new MakeResource($make);
    }
}
