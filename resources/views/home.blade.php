@extends('layouts.app')

@section('content')



<table id="vehicles" class="table" >
    <thead>
        <tr>
            <th>Name</th>
            <th>Model</th>
            <th>Make</th>
            <th>Features</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
<a href="{{route('vehicle.form')}}"><button class="btn btn-primary" >Add Vehicle</button></a>





<script type="text/javascript">
    $(document).ready(function () {
       
      
        $("#vehicles").DataTable(
            {
                ajax:
                {
                    url: "/api/vehicles",
                    dataSrc: ""
                },
                columns:
                [
                    {
                        data: "name",

                    },
                    {
                        data: "model.name",
                    },
                    {
                        data: "model.make.name",

                    },
                    {
                        data: "features[ , ].name",
                    },

                    {
                        data: "id",
                        "orderable": false,
                        "searchable":false,
                        render: function (data, type, row) {
                             return "<button class='btn-link js-update' data-vehicle-id=" + data + ">Edit</button>";
                           
                        }
                    },
                    {
                        data: "id",
                        "searchable":false,
                        "orderable": false,
                        render: function (data)
                        {
                            return "<button class='btn-link js-delete' data-vehicle-id=" + data + ">Delete</button>";
                        }
                    }
                ]
            })
        $("#vehicles").on('click', '.js-delete', function () {
            var button = $(this);
        
               
                    
                    $.ajax(
                        {
                            url: "/api/vehicles/" + button.attr("data-vehicle-id"),
                            method: "DELETE",
                            success: function () {
                                button.parents("tr").remove();
                                alert("successfully deleted");
                            }
                        });

        });



        $("#vehicles").on('click', '.js-update', function () {
            var button = $(this);
        
               
                    
                    $.ajax(
                        {
                            url: "/vehicles/" + button.attr("data-vehicle-id"),
                            method: "GET",
                            success: function(data){
                                window.location = "/vehicles/" + button.attr("data-vehicle-id");
                            }
                        });

        });



    });




</script>




@endsection