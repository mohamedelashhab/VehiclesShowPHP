<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle;
use App\Http\Resources\Vehicle as VehicleResource;
use DataTables;
use App\Model;
use Illuminate\Support\Facades\Auth;
use App\Feature;
use phpDocumentor\Reflection\Types\Nullable;
use App\VehicalFeature;
use App\Make;

class vehiclesController extends Controller
{




    public function Index(){
        $vehicle = new Vehicle();
        $vehicles = $vehicle->with('model')->get();
        $collection = VehicleResource::collection($vehicles);
        return response()->json($collection);
    }

    public function CreateVehicle(Vehicle $vehicle){
        $makes = Make::with('models')->get();
        $features =  Feature::all()->pluck('id','name')->toArray();
        if(empty($vehicle->id)){
            $add= true;
            return view('createvehicle',compact('features','add','makes'));
        }
        else{
            $models = Model::where('make_id' ,$vehicle->model_id)->get();
            $add = false;
            $make_id = Model::where('id', $vehicle->model_id)->first()->make_id;
            $models = Model::where('make_id', $make_id)->get();
            $feature_ids = VehicalFeature::where('vehicle_id', $vehicle->id)->pluck('feature_id')->toArray();
            return view('updatevehicle',compact('models','features','vehicle','feature_ids','add','make_id'));
        }
    }


    public function Create(Vehicle $vehicle){
        $validatedData = request()->validate([
            'vehicle_name' => 'required|max:255',
            'vehicle_model' => 'required|integer',
            'vehicle_make' => 'required|integer',
            'vehicle_features'=>'required'
        ]);

        if (request()->isMethod('put')) {
            $feature_ids = VehicalFeature::where('vehicle_id', $vehicle->id)->pluck('feature_id')->toArray();
            $vehicle->name = $validatedData['vehicle_name'];
            $vehicle->model_id = $validatedData['vehicle_model'];

            foreach($feature_ids as $f){
                if(!in_array($f, [$validatedData['vehicle_features']])){
                    VehicalFeature::where('vehicle_id', $vehicle->id)->where('feature_id' , $f)->delete();
                }
                else{ $vehicle->features()->attach($f); }
            }
            

            // $newFeatures = array_diff($validatedData['vehicle_features'], $feature_ids);
            $vehicle->features()->attach($validatedData['vehicle_features']);
            $vehicle->save();
            return redirect()->route('home');  
        }


        $vehicle = new Vehicle();
        $vehicle->name = $validatedData['vehicle_name'];
        $vehicle->model_id = $validatedData['vehicle_model'];
        $vehicle->save();
        $vehicle->features()->attach($validatedData['vehicle_features']);
        return redirect()->route('home');  
    }


    public function Update(Request $request,Vehicle $vehicle){
        $validatedData = request()->validate([
            'vehicle_name' => 'required|max:255',
            'vehicle_model' => 'required|integer',
            'vehicle_features'=>''
        ]);


        dd($vehicle);
        
        $vehicle->features()->attach($validatedData['vehicle_features']);
        
        return redirect()->route('home');  
    }


    public function Delete(Vehicle $vehicle){
        $vehicle->delete();
        return response()->json(['mssg'=>'Deleted']);
    }


    public function Get(Vehicle $vehicle){
        return new VehicleResource($vehicle);
    }
}
