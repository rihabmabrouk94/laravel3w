@extends('template.layout')
@section('header')
@include('template.inc.header',['title'=>'students'])

@endsection
@section('content')
<table>
<thead>
            <th>name</th>
            <th>age</th>
            <th>image</th>

        </thead>
        <tbody>
               
         @foreach($cl->students()->withTrashed()->get() as $c)
      <tr>
        
               <td>{{transformName($c->name)}}</td>
               <td>{{$c->age}}</td>
               <td><img src="{{asset($c->image)}}"> <a href="{{route('deleteImage',['cl'=>$c->id])}}">supp</a></td>
               <td><a href="{{route('handleDeletestudent',['cl'=>$c->id])}}">Modifier <i class="fas fa-trash-alt"></i></a></td>
               
               <td><a href="{{route('handleDeletestudent',['cl'=>$c->id])}}">Supprimer </i></a></td>
               </tr>
          @endforeach
<img src="{{$latitude}}">
 @if($errors->any())
            @foreach($errors->all() as $e)
                <h3 style="color: red">{{$e}}</h3>
            @endforeach
            @endif
</tbody>
       </table>
       @endsection
@section('footer')
@include('template.inc.footer')
@endsection