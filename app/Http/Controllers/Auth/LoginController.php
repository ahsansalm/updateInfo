<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request){
        $status = Auth::user()->status;
        if($status == 'Handicapé'){
            $notification = array(
                'message' => 'Ladministrateur vous a désactivé!',
                'alert_type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }elseif($status == 'Actif'){
               $notification = array(
                'message' => 'Connectez-vous avec succès!',
                'alert_type' => 'success'
            );
            return Redirect('/home')->with($notification);
        }
    }
}
