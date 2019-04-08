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
use Intervention\Image\Facades\Image;
use File;

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
    
  public function showClassrooms($computers=0)
    {
    	//dd(Students::find(1)->with('classroom')->first());
    	//dd(classroom::find(18)->with('students')->first());

    	$cl=classroom::withCount('students')->when($computers ,function($query) use ($computers){
    		$query->where('computers','>=',$computers);
    	})->get();

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
    	

//dd($longitude,$latitude);
    	$cl=classroom::whereId($id)->whereHas('students',
function($age){
	$age->where('age','>',20);
}
    )->first();
    	dd($cl->students);
     	return view('showstudents',['cl'=>$cl,'latitude'=>$latitude]);
     
    }
    public function handleDeletestudent($id)
    {

    students::whereId($id)->forceDelete();
    
    return back()->withErrors(['La suppression a été effectuée', 'test']);

    }
   public function showAddStudent()
   {
       $classroom = Classroom::all();
           //Sdd($classroom);
       return view('students', [
           'class' => $classroom
           
               ]);
   }

   public function handleAddStudent()
   {
       $data = Input::all();

       
       
       $photo = 'photo-' . str_random(5) . time() . '.' . $data['photo']->getClientOriginalExtension();
          $fullImagePath = public_path('storage/' . $photo);
          Image::make($data['photo']->getRealPath())->blur(5)->save($fullImagePath);
          $photoPath = 'storage/' . $photo;

       $cl = Students::create(['name' =>$data['name'], 'age' =>$data['age'], 'image'=>$photoPath, 'classroom_id'=>$data['classroom_id']]);

       
   }
   public function deleteImage($id)
   {
   	$cl=students::find($id);
   	if ($cl) {
   		if ($cl->image !='' or $cl->image !=null) {
   			File:: delete(public_path('/' . $cl->image));
   			$cl->image='';
   			$cl->save();
   			 return back()->withErrors(['La suppression a été effectuée']);

   		}
   		else{
   			return 'no';
   		}
   	}
   	
   }


}
