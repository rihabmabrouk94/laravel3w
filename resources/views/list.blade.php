@extends('template.layout')
@section('header')
@include('template.inc.header',['title'=>'bonjour!'])

@endsection

@section('content')

<body>

        @auth
       {{Auth::user()->name}}
       <li><a href="{{route('logout')}}"> logout</a></li>
       {{Auth::user()->created_at->diffForHumans()}}
       @endauth
       @guest
       {{'voulez vous connecter'}}
       @endauth
       <table>
        <thead>
            <th>table</th>
            <th>computers</th>
            <th>title</th>

        </thead>
         @foreach($cl as $c)
           <tr>
        
               <td>{{$c->table}}</td>
               <td>{{$c->computers}}</td>
               <td>{{$c->title}}</td>
               <td><a href="{{route('handleDeleteClassroom',['cl'=>$c->id])}}"><i class="fas fa-trash-alt"></i></a></td>

        @auth
               {{Auth::user()->name}}
               <td>@if($c->students_count)
                
                    <a href="{{route('showStudents',['cl'=>$c->id])}}">voir etudiant</a>
                     @endif
               </td>
                 @endauth
           </tr>
            @endforeach

            @if($errors->any())
            @foreach($errors->all() as $e)
                <h3>{{$e}}</h3>
            @endforeach
           <h4>{{$errors->first()}}</h4>
           @endif
           @if(Session::has('message'))
               <h4>{{ Session::get('message') }}</h4>
@endif
       </table>
       {{ trans_choice('pagination.voiture',1) }}

    </body>
@endsection
@section('footer')
@include('template.inc.footer')
@endsection

    
</html>
