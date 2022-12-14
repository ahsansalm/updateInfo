<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Register;
use App\Models\User;
use Image;
use DB;
use App\Models\Parcel;
use App\Models\Invoices;
use Auth;
use Hash;
use Illuminate\Auth\Events\Registered;

class ProfileController extends Controller
{
    // enter profile with register
    public function profile(Request $request){
        $validateData = $request->validate([
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password',
            'photo' =>  'required|photo|mimes:jpeg,png,jpg|max:2048'
        ],
        [
            'email.required' => 'Email (requis',
            'email_verification.required' => 'Le champ de vérification de ladresse e-mail est obligatoire.',
            'confirmPassword.required' => 'Le champ de confirmation du mot de passe est obligatoire.',
            'email.unique' => 'le-mail doit être unique',
            'email_verification.same' => 'Les deux email saisis sont différent, merci de vérifier',
            'password.required' => ' Mot de passe requis',
            'confirmPassword.same' => 'Les deux mot de passes saisis sont différent, merci de vérifier.',
            'password.min' => 'le mot de passe doit comporter 8 caractères',
            'photo.mimes' => 'Limage doit être jpg, jpeg et png',
            'photo.max' => 'La taille de limage doit être de 2 Mo',
        ]);
        if($photo = $request->file('photo')){
        
            $name_gen = hexdec(uniqid()).'.'.$photo->GetClientOriginalExtension();
            Image::make($photo)->resize(300,200)->save('img/profile/'.$name_gen);
        $user = new User();
        $user->name=$request->firstname;
        $user->email=$request->email;
        $user->email_verification=$request->email_verification;
        $user->password=Hash::make($request->password);
        $user->confirmPassword=Hash::make($request->confirmPassword);
        $user->save();
        Auth::attempt([
            'email' =>$request->email,
            'password' =>$request->password,
        ]);
        event(new Registered($user));

        
        

        $last_img = 'img/profile/'.$name_gen;
        Register::insert([
            'user_id' => $user->id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'postal' => $request->postal,
            'code' => $request->code,
            'address' => $request->address,
            'town' => $request->town,
            'photo' => $last_img,
            'preferenceNew' => $request->preferenceNew,
            'pre1' => $request->email_info,
            'phone' => $request->phone,
            'pre5' => $request->time,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Compte utilisateur créé !',
            'alert_type' => 'success'
        );
        return Redirect('/home')->with($notification);
    }else{
        $user = new User();
        $user->name=$request->firstname;
        $user->email=$request->email;
        $user->email_verification=$request->email_verification;
        $user->password=Hash::make($request->password);
        $user->confirmPassword=Hash::make($request->confirmPassword);
        $user->save();
        Auth::attempt([
            'email' =>$request->email,
            'password' =>$request->password,
        ]);
        event(new Registered($user));

        $random_img = 'img/random.jpg'; 
            Register::insert([
                'user_id' => $user->id,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'postal' => $request->postal,
                'code' => $request->code,
                'photo' => $random_img,
                'address' => $request->address,
                'town' => $request->town,
                'preferenceNew' => $request->preferenceNew,
                'pre1' => $request->email_info,
                'phone' => $request->phone,
                'pre5' => $request->time,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Compte utilisateur créé !',
                'alert_type' => 'success'
            );
            return Redirect('/home')->with($notification);
        }
    }
    // admin login
    public function adminLogin(){
        return view("auth.adminlogin");
    }

    // admin login form
    public function adminLoginForm(Request $request){
        $validateData = $request->validate([
            'email' => 'required|unique:users|max:255',
            'email_verification' => 'required|same:email',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password',
        ],
        [
            'email.required' => 'Email (requis',
            'email_verification.required' => 'Le champ de vérification de ladresse e-mail est obligatoire.',
            'confirmPassword.required' => 'Le champ de confirmation du mot de passe est obligatoire.',
            'email.unique' => 'le-mail doit être unique',
            'email_verification.same' => 'Les deux email saisis sont différent, merci de vérifier',
            'password.required' => ' Mot de passe requis',
            'confirmPassword.same' => 'Les deux mot de passes saisis sont différent, merci de vérifier.',
            'password.min' => 'le mot de passe doit comporter 8 caractères',
        ]);
        if($photo = $request->file('image')){
        
            $name_gen = hexdec(uniqid()).'.'.$photo->GetClientOriginalExtension();
            Image::make($photo)->resize(300,200)->save('img/profile/'.$name_gen);
    
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->email_verification=$request->email_verification;
        $user->password=Hash::make($request->password);
        $user->confirmPassword=Hash::make($request->confirmPassword);
        $user->role_as=$request->role;
        $user->save();

        Auth::attempt([
            'email' =>$request->email,
            'password' =>$request->password,
        ]);
        event(new Registered($user));

            $last_img = 'img/profile/'.$name_gen;
            Register::insert([
                'user_id' => $user->id,
                'firstname' => $request->name,
                'photo' => $last_img,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Compte administrateur créé !',
                'alert_type' => 'success'
            );
            return Redirect('/home')->with($notification);
        }else{
            $user = new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->email_verification=$request->email_verification;
            $user->password=Hash::make($request->password);
            $user->confirmPassword=Hash::make($request->confirmPassword);
            $user->role_as=$request->role;
            $user->save();
    
            Auth::attempt([
                'email' =>$request->email,
                'password' =>$request->password,
            ]);
            event(new Registered($user));

            $random_img = 'img/random.jpg'; 
                Register::insert([
                    'user_id' => $user->id,
                    'photo' => $random_img,
                    'firstname' => $request->name,
                    'created_at' => Carbon::now(),
                ]);
                $notification = array(
                    'message' => 'Compte administrateur créé !',
                    'alert_type' => 'success'
                );
                return Redirect('/home')->with($notification);
    
            }
    }


    // profile page of admin
    public function MyProfile(){
        $id = Auth::user()->id;
        $Invoice = Invoices::where('user_id' , $id)->first();
        $Parcel = Parcel::where('userId' , $id)->first();
        return view("profile.index",compact('Invoice','Parcel'));
    }
    // profile update
    public function ProfileUpdate(Request $request,$id){
        $validateData = $request->validate([
            'new_password' => 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'required_with:new_password|same:new_password'
        ],
        
        [
            'new_password.regex' => 'Doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial',
            'password_confirmation.same' => 'Le mot de passe ne correspond pas',
        ]);
         $hashedPassword = Auth::user()->password;
         $photo = $request->file('photo');
         if($request->current_password){
            if (!Hash::check($request->current_password , $hashedPassword)) {
               $notification = array(
                        'message' => 'Le mot de passe ne correspond pas!',
                        'alert_type' => 'warning'
                    );
                    return Redirect()->back()->with($notification);
            }
            else{
                $users = User::find(Auth::user()->id);
                $users->password = Hash::make($request->new_password);
                $users->confirmPassword = Hash::make($request->password_confirmation);
                $users->save();
                 $notification = array(
                        'message' => 'Profil mis à jour!',
                        'alert_type' => 'warning'
                    );
                    return Redirect()->back()->with($notification);
            }
            
             if($photo){
           // image insert using intervation
           $name_gen = hexdec(uniqid()).'.'.$photo->GetClientOriginalExtension();
           Image::make($photo)->resize(300,200)->save('img/profile/'.$name_gen);

           $last_img = 'img/profile/'.$name_gen;   


           user::find($id)->update([
            'name' => $request->firstname,
        ]);
            $input = [  
                    'lastname' => $request->lastname
                    ,'postal' => $request->postal
                    ,'code' => $request->code
                    ,'address' => $request->address
                    ,'photo' => $last_img
                    ,'town' => $request->town
                    ,'phone' => $request->phone
                    ,'created_at' => Carbon::now()
                ];
                    Register::where('user_id', '=', $id)->update($input);
                    $notification = array(
                        'message' => 'Profil mis à jour!',
                        'alert_type' => 'warning'
                    );
                    return Redirect()->back()->with($notification);
            }else{
                user::find($id)->update([
                    'name' => $request->firstname,
                ]);
                $input = [  
                    'lastname' => $request->lastname
                    ,'postal' => $request->postal
                    ,'code' => $request->code
                    ,'address' => $request->address
                    ,'town' => $request->town
                    ,'phone' => $request->phone
                    ,'created_at' => Carbon::now()
                ];
                    Register::where('user_id', '=', $id)->update($input);
                    $notification = array(
                        'message' => 'Profil mis à jour!',
                        'alert_type' => 'warning'
                    );
                    return Redirect()->back()->with($notification);
            }
         }
         else{
             
              if($photo){
           // image insert using intervation
           $name_gen = hexdec(uniqid()).'.'.$photo->GetClientOriginalExtension();
           Image::make($photo)->resize(300,200)->save('img/profile/'.$name_gen);

           $last_img = 'img/profile/'.$name_gen;   


           user::find($id)->update([
            'name' => $request->firstname,
        ]);
            $input = [  
                    'lastname' => $request->lastname
                    ,'postal' => $request->postal
                    ,'code' => $request->code
                    ,'address' => $request->address
                    ,'photo' => $last_img
                    ,'town' => $request->town
                    ,'phone' => $request->phone
                    ,'created_at' => Carbon::now()
                ];
                    Register::where('user_id', '=', $id)->update($input);
                    $notification = array(
                        'message' => 'Profil mis à jour!',
                        'alert_type' => 'warning'
                    );
                    return Redirect()->back()->with($notification);
            }else{
                user::find($id)->update([
                    'name' => $request->firstname,
                ]);
                $input = [  
                    'lastname' => $request->lastname
                    ,'postal' => $request->postal
                    ,'code' => $request->code
                    ,'address' => $request->address
                    ,'town' => $request->town
                    ,'phone' => $request->phone
                    ,'created_at' => Carbon::now()
                ];
                    Register::where('user_id', '=', $id)->update($input);
                    $notification = array(
                        'message' => 'Profil mis à jour!',
                        'alert_type' => 'warning'
                    );
                    return Redirect()->back()->with($notification);
            }
             
         }
        

    }
    // chnage pasword
    public function ChangPas(){
        $id = Auth::user()->id;
        $Invoice = Invoices::where('user_id' , $id)->first();
        $Parcel = Parcel::where('userId' , $id)->first();
        return view("profile.changPass",compact('Invoice','Parcel'));
    }




    public function ProfileUpdatePass(Request $request,$id){
        $validateData = $request->validate([
            'new_password' => 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'required_with:new_password|same:new_password'
        ],
        
        [
            'new_password.regex' => 'Doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial',
            'password_confirmation.same' => 'Le mot de passe ne correspond pas',
        ]);
         $hashedPassword = Auth::user()->password;
         if($request->current_password){
            if (!Hash::check($request->current_password , $hashedPassword)) {
               $notification = array(
                        'message' => 'Le mot de passe ne correspond pas!',
                        'alert_type' => 'warning'
                    );
                    return Redirect()->back()->with($notification);
            }
        }
    }
}
