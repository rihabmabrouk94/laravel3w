<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use  Session;
use  Validator;

use App\classroom;
use App\Students;
use App\User;
use Auth;

class ClassroomController extends Controller
{
     public function handleAddClassroom()
    {
    	$data=Input::all();
    	$rules = [
          
            'title' => 'required|min:5',
            'computers' => 'required',
        ];

        $messages = [
            'title.required' => 'Votre titre est obligatoire',
            'title.min' => 'Votre titre doit dépasser 5 caractères',
          
            'computers.required' => 'Le champ computers est obligatoire'
        ];

        $validation = Validator::make($data, $rules, $messages);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }

    	//dd($data);
    	$cl=classroom::create(['table'=>$data['tables'],'computers'=>$data['computers'],
    		'title'=>$data['title']]);
    	return back();
    	
    	//dd(now()->addDays(5));
    }
    public function handleDeleteClassroom($id)
    {

    classroom::whereId($id)->delete();
    	//dd($find);
    // return $find ? $find->delete() :'Ereur'; la fonction deleat n'a pas de retour
     /*if ($find) {
     	$find->delete() ;
     }
     else{
     	return'Ereur';
     }*/
     //return redirect('list');
     //Session::flash('message', "Special message goes here");
		//return back();
    return back()->withErrors(['La suppression a été effectuée', 'test']);

    }
    
  public function showClassrooms()
    {
    	//dd(Students::find(1)->with('classroom')->first());
    	//dd(classroom::find(18)->with('students')->first());

    	$cl=classroom::withCount('students')->get();

    	return view('list',['cl'=>$cl]);

    }
    public function handleShowClassroom($id){
    	$cl=classroom::find($id);

    	if ($cl) {
     	return view('show',['cl'=>$cl]);
     }
     else{
     	return'Ereur';
     }

    }
    public function handleUpdate(){
    $data=Input::all();
   	$cl=classroom::find($data['id']);
   	$cl->table=$data['tables'];
   	$cl->computers=$data['computers'];
   	$cl->title=$data['title'];
   	$cl->save();
   	//classroom::where('table','<',10)->update(['computers'=>100,'table'=>1000]);
   	return redirect('list');

   }
   public function handleRegister(){
   	$data=Input::all();
   	//dd(bcrypt($data['password']));
   	$user=User::create(['name'=>$data['name'], 'email'=>$data['email'], 'password'=>bcrypt($data['password'])]);
   } 
    	
    public function showRegister()
    {
    	$cl=classroom::all();
		return view('register',['cl'=>$cl]);

    }	
    public function handleLogin(){
		$data=Input::all();
   	//dd(bcrypt($data['password']));
		$credentials = 
		['email' => $data['email'],
           'password' => $data['password'],
       	];
   		if (Auth::attempt($credentials)) {
          return $user = Auth::user();

           //dd($user);
       } 
       else { return 'error'; }
	}
    public function showLogin()
    {
    	$cl=classroom::all();

		return view('showlogin',['cl'=>$cl]);

    }
    public function Logout()
    {
    	Auth::logout();
    	return redirect(route('showLogin'));
    }
    public function showStudents($id)
    {
    	if ($data = @file_get_contents("http://api.apixu.com/v1/current.json?key=fc8ed0be1ed24dcb885144051190404&q=ny"))
   {
       $json = json_decode($data, true);
       $latitude = $json['current']['condition']['icon'];
      $longitude = $json['location']['tz_id'];
   }

//dd($longitude,$latitude);
    	$cl=classroom::find($id);
    	if ($cl and $cl->students()->exists())
    	{
     	return view('showstudents',['cl'=>$cl,'latitude'=>$latitude]);
     	}
     else
     {
     	return'Ereur';
     }
		
    }
    public function handleDeletestudent($id)
    {

    students::whereId($id)->delete();
    
    return back()->withErrors(['La suppression a été effectuée', 'test']);

    }


}
