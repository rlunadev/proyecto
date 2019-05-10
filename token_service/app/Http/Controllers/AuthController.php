<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Sistemas;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use DB, Hash, Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
class AuthController extends Controller
{
    public function register(Request $request) {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ];
        $input = $request->only(
            'name',
            'email',
            'password',
            'password_confirmation'
        );
        $validator = Validator::make($input, $rules);
        //dd($input,$rules);
        if($validator->fails()) {
            $error = $validator->messages();
            return response()->json(['success'=> false, 'error'=> $error]);
        }
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $grupo_id = $request->grupo_id;
        $user = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password) ,'grupo_id'=>$grupo_id]);
        //send by E-MAIL
        // $verification_code = str_random(30); //Generate verification code
        // DB::table('user_verifications')->insert(['user_id'=>$user->id,'token'=>$verification_code]);
        // $subject = "Confirmacion de registro a J.B.B.L.";
        // Mail::send('verify', ['name' => $name, 'verification_code' => $verification_code],
        //     function($mail) use ($email, $name, $subject){
        //         $mail->from("ronaldluna17@gmail.com", "J.B.B.L.");
        //         $mail->to($email, $name);
        //         $mail->subject($subject);
        //     });

        return response()->json(['success'=> true, 'data'=> $user]);
    }
    //////
    public function verifyUser($verification_code) {
        $check = DB::table('user_verifications')->where('token',$verification_code)->first();
        if(!is_null($check)){
            $user = User::find($check->user_id);
            if($user->is_verified == 1){
                return response()->json([
                    'success'=> true,
                    'message'=> 'Account already verified..'
                ]);
            }
            $user->update(['is_verified' => 1]);
            DB::table('user_verifications')->where('token',$verification_code)->delete();
            return response()->json([
                'success'=> true,
                'message'=> 'You have successfully verified your email address.'
            ]);
        }
        return response()->json(['success'=> false, 'error'=> "Verificacion invalida."]);
    }

    public function login(Request $request) {
        //return response()->json(['success' => true]);
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $input = $request->only('email', 'password');
        $validator = Validator::make($input, $rules);
        
        if($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json(['success'=> false, 'error'=> $error]);
        }
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        //GTE USER
        $data=User::where('email','=', $request->email)->get();
        $data->each(function($data){
            $data->sistemaRegistro;
        });
       // dd($data[0]->sistemaRegistro->nombre,$data[0]->name);
    //    $ids=$data[0]->sistemaRegistro->sistema_id;
         $custom = [];
    //         'empresa' =>[ 'id'=>$data[0]->sistemaRegistro->id,'nombre'=>$data[0]->sistemaRegistro->nombre, 'usuario'=>$data[0]->name],
    //         'sistemas' => ['sistemas'=>$ids]
    //     ];

        try {
            if (! $token = JWTAuth::attempt($credentials,$custom)) {
                return response()->json(['success' => false, 'error' => 'Credenciales invalidos.'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['success' => false, 'error' => 'could_not_create_token'], 500);
        }
        // $id_empresa=JWTAuth::getPayload($token)->get('empresa.id');
        // $id_usuario=JWTAuth::getPayload($token)->get('empresa.usuario');
        // dd($id_empresa,$id_usuario);
        return response()->json(['success' => true, 'data'=> [ 'token' => $token]]);
    }

    public function logout(Request $request) {
        $this->validate($request, ['token' => 'required']);
        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true]);
        } catch (JWTException $e) {
            return response()->json(['success' => false, 'error' => 'intente de nuevo.'], 500);
        }
    }

    public function recover(Request $request) {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $error_message = "Su email no fue encontrado.";
            return response()->json(['success' => false, 'error' => ['email'=> $error_message]], 401);
        }
        try {
            Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject('enviamos un link para renovar su contrase;a');
            });
        } catch (\Exception $e) {
            //Return with error
            $error_message = $e->getMessage();
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
        return response()->json([
            'success' => true, 'data'=> ['msg'=> 'revise su email.']
        ]);
    }
    public function index() {
        return view('login.index');
    }

    public function admin() {
        $verify=false;
        return view("admin.index")->with($verify);
    }
    public function registro() {
        $data="hola";
        return view("login.registro")->with($data);
    }
}
