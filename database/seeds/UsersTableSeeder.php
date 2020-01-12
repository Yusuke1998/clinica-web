<?php

use App\User;
use App\Person;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
 
class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $persona = Person::create([
            'firstname'     =>  'Jhonny',
            'middlename'    =>  'Jose',
            'firstlastname' =>  'Perez',
            'middlelastname'=>  'Martinez',
            'document_id'   =>  1,
            'nro_document'  =>  '26039408',
            'birthday'      =>  new Carbon(),
            'direction'     =>  'n/a',
            'local_phone'   =>  'n/a',
            'movil_phone'   =>  'n/a',
            'mail_contact'  =>  'n/a',
            'gender'        =>  'm',
        ]);

        $usuario = User::create([
        	'name'		=>	'admin',
        	'email'		=>	'admin@admin.com',
        	'password'	=>	bcrypt('admin'),
            'type'      =>  'root',
            'person_id' =>  $persona->id
        ]);
    }
}
