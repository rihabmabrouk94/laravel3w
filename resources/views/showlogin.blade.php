
 

<form method="post" action="{{route('handleLogin')}}">
    <fieldset>
    <ul>
        @csrf
   <li><label>Nom</label>
 
    <li> <label>Email</label>
    <input type="email" name="email"></li> 
      <li><label>password</label>
    <input type="password" name="password"></li>
   <li> <button type="submit" value="ok">ok</button></li>

</ul>
</fieldset>
</form>