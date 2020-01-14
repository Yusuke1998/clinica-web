<?php
// Persona
namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
    	'firstname','middlename','firstlastname','middlelastname','document_id','nro_document','img_document','birthday','direction','local_phone','movil_phone','mail_contact','gender','ethnic_id','n_country_id','n_state_id','n_municipality_id','r_country_id','r_state_id','r_municipality_id'
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
