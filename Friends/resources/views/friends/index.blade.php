{{-- <!DOCTYPE html>
<html>
<head>
    <title>Friend List </title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body> --}}
@extends('layouts.app')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script >
// $(document).ready(function() {
    
//     $( "#delete-friend" ).click(function() {
//         var id = $(this).data("id");
//         console.log(id);
//         $.ajax({
//             url: '/friends/'+id,
//             method: 'DELETE',
//             data: { "_token": $('#token').val()}
//             success: function(result) {
//                 window.reload();
//                 // Do something with the result
//             }
//         });
//     });

  
// });

</script>
@section('content')
<div class="container">

<nav class="navbar navbar-inverse">
    {{-- <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('friends') }}">Nerd Alert</a>
    </div> --}}
    <ul class="nav navbar-nav">
        {{-- <li><a href="{{ URL::to('friends') }}">View All friends</a></li> --}}
        <li><a href="{{ URL::to('friends/create') }}">Invite Friend</a>
    </ul>
</nav>

<h1>Your Friend List</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
@if (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Email</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($friends as $key => $value)
        <tr>
        
            <td>{{ $value->email }}</td>


            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /friends/{id} -->
                <form method="POST" action={{ 'friends/' . $value->id }}>
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="form-group">
                        <button type="submit" class="btn btn-small btn-danger" >Delete </button>
                    </div>
                </form>
                {{-- <a class="btn btn-small btn-danger"  id="delete-friend" data-id="{{$value->id}}">Delete</a>
             --}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
@endsection
{{-- </body>
</html> --}}
