<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\FeatureCollection;
use App\Feature;
use App\Http\Resources\Feature as FeatureResource;

class FeaturesController extends Controller
{



    public function Index(){
        $Feature = new Feature();
        $features = $Feature->all();
        return Feature::select('id','name')->get();
    }

    public function featureForm(){

        $features =  Feature::all()->pluck('id','name')->toArray();
        return view('createfeature', compact('features'));
    }

    public function Create(){
        $validatedData = request()->validate([
            'name' => 'required|max:255'
        ]);
        $feature = new Feature();
        $feature->name = $validatedData['name'];
        $feature->save();
        return redirect()->route('feature.form');
    }

    public function Update(Request $request,Feature $feature){
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);
        $feature->name = $validatedData['name'];
        $feature->save();
        return new FeatureResource($feature);
    }

    public function Delete(Feature $feature){
        $feature->delete();
        return response()->json(['mssg'=>'Deleted']);
    }

    public function Get(Feature $feature){
        return new FeatureResource($feature);
    }

}
