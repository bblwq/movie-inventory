@extends('master')

@section('content')

<ul class="nav nav-tabs">
 <li class="active">
  <a href="/movie">Movies</a>
 </li>
 <li class="inactive">
  <a href="/actor">Actors</a>
 </li>
</ul>

<div class="row">
 <div class="col-md-12">
  <br />

  @if($message = Session::get('success'))
  <div class="alert alert-success">
   <p>{{$message}}</p>
  </div>
  @endif

  <div align="right">
   <a href="{{route('movie.create')}}" class="btn btn-primary">Add Movie</a>
   <br />
   <br />
  </div>
  <table class="table table-bordered table-striped">
   <tr>
    <th>ID</th>
    <th>Title</th>
    <th>Release date</th>
    <th>Description</th>
    <th>Genre Type</th>
    <th>Actors</th>
    <th>Delete</th>
   </tr>


   @foreach($movies as $movie)
   <tr>
    <td>{{$movie->id}}</td>
    <td><a href="{{action('MovieController@edit', $movie['id'])}}">{{$movie['title']}} <span class="glyphicon glyphicon-edit"></span></a></td>
    <td>{{$movie->release_date}}</td>
    <td>{{$movie->description}}</td>
    <td>{{$movie->genre_type}}</td>
    <td>
     @foreach((array)$movie->actors as $movie_actors)
      <p>{{ implode(", ",array_map(function($x) {return $x->name;}, $movie_actors)) }}
     @endforeach
    </td>
    <td>
     <form method="post" class="delete_form" action="{{action('MovieController@destroy', $movie['id'])}}">
      {{csrf_field()}}
      <input type="hidden" name="_method" value="DELETE" />
      <button type="submit" class="btn btn-danger">Delete</button>
     </form>
    </td>
   </tr>
   @endforeach

  </table>
 </div>
</div>

<script>
$(document).ready(function(){
 $('.delete_form').on('submit', function(){
  if(confirm("Are you sure you want to delete it?")) {
   return true;
  } else {
   return false;
  }
 });
});
</script>

@endsection