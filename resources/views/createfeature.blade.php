@extends('layouts.app')

@section('content')



<form method="POST" action="{{ route('feature.create') }}">
        @csrf
        @method('POST')
    
    <div class="container">

          <div class="form-group">
              <label for="name" col-sm-2 >Name</label>
          <input type="text"  name="name" id="name" class="form-control">
          </div>

          <p align="right"><button type="submit" class="btn btn-primary" > Add   </button></p>
        
    <div>

    </form>

    <table id="features" class="table ftable">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Feature</th>
                <th scope="col"> Delete </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($features as $name=>$id)
              <tr>
                    <td>{{$id}}</td>
                    <td>{{$name}}</td>
                    <td> <button class='btn-link js-delete' data-feature-id="{{$id}}">Delete</button> </td>
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
    
        $("#features").on('click', '.js-delete', function () {
            
                var button = $(this);
                console.log( button.attr("data-feature-id"));
                        $.ajax(
                            {
                                url: "/api/features/" + button.attr("data-feature-id"),
                                method: "DELETE",
                                success: function () {
                                    button.parents("tr").remove();
                                    alert("successfully deleted");
                                }
                            });

            });
            


    </script>

@endsection

