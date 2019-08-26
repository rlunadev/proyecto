<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use App\Configuracion;
use DB, Hash, Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
class ConfigurationController extends Controller
{
    public function index() {
        $data=Configuracion::all()->take(1);
        return view('configuration.index')->with('data',$data);
    }
}
