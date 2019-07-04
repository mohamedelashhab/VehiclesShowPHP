@extends('layouts.app')

@section('content')


<form method="POST" action="{{ route('vehicle.update', $vehicle->id) }}">
  @csrf
  @method('PUT')


  <div class="container">

      <input type="hidden" id="vehicle_make" name="vehicle_make" value="{{$make_id}}">
      <div class="form-group">
          <label for="name" col-sm-2 >Name</label>
      <input type="text" value="{{$vehicle->name}}" name="vehicle_name" id="name" class="form-control">
      </div>

      <div class="form-group">
      <label for="model">Model</label>
          <select id="model" name="vehicle_model" class="browser-default custom-select">
            <option selected>Open this select menu</option>
            @foreach ($models as $model)
     
              <option {{$vehicle->model->id === $model->id ? 'selected' : ''}} id="{{$model->id}}" value="{{$model->id}}">{{$model->name}}</option>

            @endforeach
            
          </select>
      </div>


      <!-- Default unchecked -->
   
      @foreach ($features as $name => $id)

          <div class="custom-control custom-checkbox js-check">
          <input {{ in_array($id , $feature_ids) ? "checked" : ""}}  type="checkbox" name="vehicle_features[]" value="{{$id}}" class="custom-control-input feature_id" id="{{$id}}" />
              <label class="custom-control-label" for="{{$id}}">{{$name}}</label>
          </div>

      @endforeach



      <p align="right"><button type="submit" class="btn btn-primary" > {{$add ? "Add" : "Update"}} </button></p>
  </div>

</form>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection

