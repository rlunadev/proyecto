<?php

namespace App\Http\Controllers;
use JWTAuth;
use Illuminate\Http\Request;

use App\User;
use Exception;
class UsersController extends Controller
{
    public function create () {
    	return view('users.create');
    }

    public function SaveData (UserRequest $request) {
         $user=new User($request->all());
         $user->password= Hash::make($password);
        // dd($user,$request);

        // $name = $request->name;
        // $email = $request->email;
        // $password = $request->password;
        // $user = User::create([
        //     'name' => $name,
        //     'email' => $email,
        //     'password' => Hash::make($password)
        //     ]);

        // $verification_code = str_random(30);

    	$user->save();
        return response()->json(['success'=>true]);
    }

    public function index(Request $request) {
        $users=User::orderBy('id','ASC');//->paginate(12);
        return view('users.index')->with('users',$users);
    }

    public function GetAll(){
        $data=User::all();//->take(10);
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
    }
    
    public function DeleteById(Request $request){
        $data=User::find($request->id);
        if($data!=null){
            $data->delete();
            return response()->json(['success'=>true]);
        }
        else
            return response()->json(['success'=>'Error']);
    }

    public function GetById($id){
        $data=User::find($id);
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function DeleteAll() {
       $user = User::All();
       return response()->json(['success'=>true]);
     }

    public function update(Request $request, $id) {
        $user=User::find($id);
            $user->name=$request->name;
            $user->email=$request->email;
            $user->type=$request->type;
            $user->save();
        return response()->json(['success'=>true]);
       // return redirect()->route('users.index');
        //}
    }
}
