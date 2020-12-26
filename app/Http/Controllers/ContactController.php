<?php


namespace App\Http\Controllers;


use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function createCustomer(Request $request)
    {
        $validated = $request->validate([//валидация параметров запроса
            'first_name' => 'required',
            'middle_name' => 'sometimes',
            'last_name' => 'required',
            'phone_number' => 'required',
            'home_address' => 'required',
            'comment' => 'sometimes'
        ]);
        $contact = Contact::query()
            ->create($validated);//создание записи в таблице
        return $contact;
    }

    public function getCustomers(Request $request)
    {
        $validated = $request->validate([
            'token'=>'required'//токен доступа
        ]);
        if(!UserController::hasAccess($validated['token']))
            return ['error'=>'вы не аутентифицированы'];
        return Contact::all();//все сохраненные контакты
    }
}
ёёёёёёёёёёёёёёёёёёёёёёёёёёёёёёёёёёёёёёёёё
