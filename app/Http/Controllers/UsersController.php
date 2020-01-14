<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Validator;
use App\Person;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except([
            'user_store','validate_user','validate_person'
        ]);
    }

    public function index()
    {
        return view('users.index');
    }

    public function userTable(Request $request)
    {
    	$users = $this->filteruserTable($request);
    	return [
            'pagination' => [
                'total'         => $users->total(),
                'current_page'  => $users->currentPage(),
                'per_page'      => $users->perPage(),
                'last_page'     => $users->lastPage(),
                'from'          => $users->firstItem(),
                'to'            => $users->lastItem(),
            ],
            'table' => $users
        ];
    }

    public function filteruserTable($request)
    {
        $search = mb_strtolower($request->search,'UTF-8');
        $users = User::with('person.document');

        if (!is_null($search) && !empty($search)) {
            $users
            ->where('username','like','%'.$search.'%')
            ->orWhere('email','like','%'.$search.'%')
            ->orWhereHas('person',function ($query) use ($search) {
                $query
                ->where('firstname','like','%'.$search.'%')
                ->orWhere('lastname','like','%'.$search.'%')
                ->orWhere('nro_document','like','%'.$search.'%')
                ->orWhere('birthday','like','%'.$search.'%')
                ->orWhere('local_phone','like','%'.$search.'%')
                ->orWhere('movil_phone','like','%'.$search.'%')
                ->orWhere('mail_contact','like','%'.$search.'%')
                ->orWhereHas('document',function ($subQuery) use ($search) {
                    $subQuery->where('name','like','%'.$search.'%');
                });
            });
        }
        return $users->orderBy('updated_at','DESC')->paginate($request->sort);
    }

    public function validate_person($person)
    {
        $validator = Validator::make($person,[
            'firstnames'    =>  'required',
            'lastnames'     =>  'required',
        ],
        [
            'firstnames.required'   =>  'Los nombres son requeridos',
            'lastnames.required'    =>  'Los apellidos son requeridos'
        ])->validate();
    }

    public function validate_dni($person)
    {
        $validator = Validator::make($person,[
            'nro_document'  =>  'required|unique:people',
        ],
        [
            'nro_document.unique'   =>  'El numero de documento ya esta registrado!'
        ])->validate();
    }

    public function validate_user($user)
    {
        $validator = Validator::make($user,[
            'name'          =>  'required|unique:users',
            'email'         =>  'required|unique:users',
            'password'      =>  'required|string|min:6|confirmed',
        ],
        [
            'name.unique'       =>  'El nombre de usuario ya fue registrado',
            'name.required'     =>  'El nombre de usuario es requedido',
            'email.unique'      =>  'El correo electronico ya fue registrado',
            'email.required'    =>  'El correo electronico es requedido',
            'password.min'      =>  'La contraseña debe tener mas de 5 caracteres.',
            'password.required' =>  'La contraseña es requerida.',
            'password.confirmed'=>  'Las contraseñas no coinciden.'
        ])->validate();
    }

    public function validate_password($user)
    {
        $validator = Validator::make($user,[
            'password'      =>  'required|string|min:6|confirmed',
        ],
        [
            'password.min'      =>  'La contraseña debe tener mas de 5 caracteres.',
            'password.required' =>  'La contraseña es requerida.',
            'password.confirmed'=>  'Las contraseñas no coinciden.'
        ])->validate();
    }
    // web
    public function user_store(Request $request)
    {
        $nombres    = explode(' ', $request->person['firstnames']);
        $apellidos  = explode(' ', $request->person['lastnames']);

        if ($request->person['id']>0 && $request->user['id']>0) {
            $this->validate_person($request->person);
            $person = Person::findOrFail($request->person['id']);
            $person->update([
                'firstname'         =>  $nombres[0],
                'middlename'        =>  $nombres[1]??'',
                'firstlastname'     =>  $apellidos[0],
                'middlelastname'    =>  $apellidos[1]??'',
                'nro_document'      =>  $request->person['nro_document'],
                'document_id'       =>  $request->person['document']['id']
            ]);
            $user = User::findOrFail($request->user['id']);
            $this->validate_password($request->user);
            $user->update([
                'name'          =>  $request->user['name'],
                'email'         =>  $request->user['email'],
                'password'      =>  bcrypt($request->user['password']),
                'person_id'     =>  $person->id
            ]);
        }else{
            $this->validate_dni($request->person);
            $this->validate_user($request->user);
            $person = Person::create([
                'firstname'         =>  $nombres[0],
                'middlename'        =>  $nombres[1]??'',
                'firstlastname'     =>  $apellidos[0],
                'middlelastname'    =>  $apellidos[1]??'',
                'nro_document'      =>  $request->person['nro_document'],
                'document_id'       =>  $request->person['document']['id']
            ]);
            $person->user()->create([
                'name'          =>  $request->user['name'],
                'email'         =>  $request->user['email'],
                'password'      =>  bcrypt($request->user['password'])
            ]);
        }
    }
    // web

    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();
        return;
    }
}
