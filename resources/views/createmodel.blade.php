@extends('layouts.app')

@section('content')



<form method="POST" action="{{ route('model.create') }}">
        @csrf
        @method('POST')
    
    <div class="container">

          <div class="form-group">
              <label for="name" col-sm-2 >Name</label>
          <input type="text"  name="name" id="name" class="form-control">
          </div>

          <div class="form-group">
                <label for="make">Make</label>
                    <select id="make" name="make_id" class="browser-default custom-select">
                      <option selected disabled>Open this select menu</option>
                      @foreach ($makes as $name=>$id)
                  
                        <option  id="{{$id}}" value="{{$id}}">{{$name}}</option>
                        
                      @endforeach
                      
                    </select>
                </div>
          

          <p align="right"><button type="submit" class="btn btn-primary" > Add   </button></p>

    <div>

    </form>


    <table id="models" class="table ftable">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Model</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($models as $name=>$id)
              <tr>
                    <td>{{$id}}</td>
                    <td>{{$name}}</td>
                    <td> <button class='btn-link js-delete' data-model-id="{{$id}}">Delete</button> </td>
                    </tr>
              @endforeach

            </tbody>
    </table>

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
    
            $("#models").on('click', '.js-delete', function () {
                    
                    var button = $(this);
                
                            $.ajax(
                                {
                                    url: "/api/models/" + button.attr("data-model-id"),
                                    method: "DELETE",
                                    success: function () {
                                        button.parents("tr").remove();
                                        alert("successfully deleted");
                                    }
                                });
        
                });
                
               
            </script>


@endsection