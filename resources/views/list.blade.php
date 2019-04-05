<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
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
    </body>
</html>
