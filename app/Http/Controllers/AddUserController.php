<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Route;
use Webpatser\Uuid\Uuid;

use Illuminate\Http\Request;
use Mail;

class AddUserController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

  


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function index () {
        return view('register2');
    }
    public function regEmail(Request $request) {
        $uuid = Uuid::generate()->string;
        $name = $request->name;
        $email = $request->email;
        $link = "/confirm/".$uuid;

        Mail::send('emails.send', ['name' => $name, 'link' => $link], function ($message) use ($email)
        {

            $message->from('me@gmail.com', 'Ene Vlad Stefan');

            $message->to($email);

        });
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('123456'),
            'uuid' => $uuid,
        ]);
        return redirect('/add-user')->with('success', 'An email was sent to the user');
    }
    public function confirm($id) {
        $user = new User;
        $user = User::where('uuid', Route::input('id'))->first();
        if(!$user)
            return "Cont deja activat";
        return view('/confirmpass')->with('user',$user );

    }
    public function updatePas($id, Request $request) {
        $user = new User;
        $user = User::where('uuid', Route::input('id'))->first();
        $user->password = bcrypt($request->password);
        $user->uuid = null;
        $user->save();
        return redirect('/login');

    }
    public function deleteUser($id) {
        $user = User::find($id);
        $user->delete();
    }
}
