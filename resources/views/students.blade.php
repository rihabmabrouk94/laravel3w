<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

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
            tr, td, th {
                border: 1px solid black;

            }
        </style>
    </head>
    <body>
        @auth
            {{Auth::user()->name}}
            <a href="{{route('logout')}}">se déconnecter</a>
        @endauth
        
        
        <form method="POST" action="{{route('handleAddStudent')}}" enctype="multipart/form-data">
                    @csrf <!--protection des données. sinon on aura une erreur 419-->

                    <label>Name : </label>
                    <input type="text" name="name">
                    <label>Age : </label>
                    <input type="number" name="age">
                    <label>Title : </label>
                    <input type="file" name="photo">

                    <select name="classroom_id">
                        @foreach($class as $c)
                        <option value="{{$c->id}}">{{$c->title}}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="" value="Envoyer">
                </form>
        
       <!-- @if($errors->any())
        <h4>{{$errors->first()}}</h4>
           @endif-->

           @if(Session::has('message'))
            <h4>{{Session::get('message')}}</h4>
            @endif
    </body>
</html>
