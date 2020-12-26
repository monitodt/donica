<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public static function hasAccess($token)
    {
        $admin = User::query()
            ->where('remember_token', '=', $token)//поиск пользователя у которого токен равен введенному
            ->first();

        return isset($admin->id);
    }
    public function auth(Request $request){
        $validated=$request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $user=User::query()
            ->where('email','=',$validated['email'])//поиск пользователя с введенным имейлом
            ->first();
        if(isset($user->id)&&$user->password==md5($validated['password'])){//проверка совпадения хэшей
            $user->remember_token=md5($user->id);//обновление токена пользователя
            $user->save();//запись обновленных данных в базу данных
            return['token'=>$user->remember_token];
        }
        return ['error'=>'вы ввели неверный логин и/или пароль'];
    }
}
