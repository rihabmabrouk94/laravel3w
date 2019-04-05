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
               <td>{{$c->image}}</td>
               <td><a href="{{route('handleDeletestudent',['cl'=>$c->id])}}">Modifier <i class="fas fa-trash-alt"></i></a></td>
               
               <td><a href="{{route('handleDeletestudent',['cl'=>$c->id])}}">Supprimer <i class="fas fa-trash-alt"></i></a></td>
               </tr>
          @endforeach
<img src="{{$latitude}}">
</tbody>
       </table>