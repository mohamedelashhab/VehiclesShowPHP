@extends('layouts.app')

@section('content')



  <form method="POST" action="{{ route('vehicle.create') }}">
    @csrf
    @method('POST')



  <div class="container">


      <div class="form-group">
          <label for="name" col-sm-2 >Name</label>
      <input type="text"  name="vehicle_name" id="name" class="form-control">
      </div>


      <div class="form-group">
          <label for="make">Make</label>
              <select id="make" name="vehicle_make" class="browser-default custom-select">
                <option selected disabled>Open this select menu</option>
                @foreach ($makes as $make)
            
                  <option class="js-select" make-id={{$make->id}}  id="{{$make->id}}" value="{{$make->id}}">{{$make->name}}</option>
                  
                @endforeach
                
              </select>
      </div>


      <div class="form-group">
      <label for="model">Model</label>
          <select  id="model" name="vehicle_model" class="browser-default custom-select modeloption">
            <option selected disabled>Open this select menu</option>

            
          </select>
      </div>


      <!-- Default unchecked -->

      @foreach ($features as $name => $id)

          <div class="custom-control custom-checkbox">
          <input type="checkbox" name="vehicle_features[]" value="{{$id}}" class="custom-control-input" id="{{$id}}">
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


<script>
//////////////////////////////////////////////////////////////////////////

$(document).ready(function(){
     $("#make").change(function(){


      //ajax

      $.ajax({ 
        type: 'GET', 
        url: '/api/models/' + document.getElementById("make").value, 
        data: { get_param: 'value' }, 
        dataType: 'json',
        success: function (data) { 
          console.log(data);
            $.each(data, function(index, element) {
                // $('modeloption').append($('<div>', {
                //     text: element.id
                // }));
                $('.modeloption').append($("<option></option>").attr("value", element.id).text(element.name));
                // $('.modeloption').append('<option id=element.id value=element.id>element.name</option>');
            });
        }
        });

      //endajax

      // alert("Selected value is : " + document.getElementById("make").value);
     });
   });

// $.ajax({ 
//         type: 'GET', 
//         url: '/api/models/' + att.attr('make-id'), 
//         data: { get_param: 'value' }, 
//         dataType: 'json',
//         success: function (data) { 
//             $.each(data, function(index, element) {
//                 $('body').append($('<div>', {
//                     text: element.name
//                 }));
//             });
//         }
//         });
/////////////////////////////////////////////////////////////////////////
  </script>




@endsection