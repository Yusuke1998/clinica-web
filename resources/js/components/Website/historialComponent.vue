<template>
	<div class="panel">
		<div class="panel-heading">
			<h5 class="text-center">Historial</h5>
		</div>		
		<div class="panel-body">		
			<div class="row">
				<div class="col-xs-12 text-center">
        			<small>Información Personal</small>
        		</div>
			    <form class="col-md-10 col-md-offset-1">
		            <!-- col-md-12 -->
		        	<div class="form-group row">
		        		<div class="col-xs-6">
			        		<label>Tipo de Documento</label>
			            	<v-select 
			            		label="name" 
			            		:class="'bg-white'" 
			            		v-model="person.document" 
			            		:options="list_documents"></v-select>
		        		</div>
		        		<div class="col-xs-6">
			        		<label>Nro de Documento</label>
			                <input 
			                	:disabled="person.document==null" 
			                	type="number" 
			                	v-model="person.nro_document" 
			                	class="form-control">
			            </div>
			        </div>
		        	<!-- col-md-12 -->
		        	<div class="form-group row">
		        		<div class="col-xs-6">
			        		<label>Primer Nombre</label>
			        		<input 
			        			:disabled="!exist_document" 
			        			type="text" 
			        			class="form-control" 
			        			v-model="person.firstname">
		        		</div>
		        		<div class="col-xs-6">
			        		<label>Segundo Nombre</label>
			        		<input 
			        			:disabled="!exist_document" 
			        			type="text" 
			        			class="form-control" 
			        			v-model="person.middlename">
		        		</div>
		        	</div>
		        	<!-- col-md-12 -->
		        	<div class="form-group row">
		        		<div class="col-xs-6">
			        		<label>Primer Apellido</label>
			        		<input 
			        			:disabled="!exist_document" 
			        			type="text" 
			        			class="form-control" 
			        			v-model="person.firstlastname">
		        		</div>
		        		<div class="col-xs-6">
			        		<label>Segundo Apellido</label>
			        		<input 
			        			:disabled="!exist_document" 
			        			type="text" 
			        			class="form-control" 
			        			v-model="person.middlelastname">
		        		</div>
		            </div>
		        	<!-- col-md-12 -->
		        	<div class="form-group row">
		        		<div class="col-xs-3">
			                <label>F. Nacimiento</label>
			                <datepicker
			        			:disabled="!exist_document" 
			                	:onchange="calYear()"
			                    :full-month-name="true"
			                    :language="es"
			                    :disabled-dates="no_dates" 
			                    v-model="person.birthday"
			                    :input-class="'bg-white form-control'"></datepicker>
			            </div>
		        		<div class="col-xs-3">
			                <label>Edad</label>
			                <input
			                	disabled 
			                	v-model="person.year"
			                	type="text" 
			                	class="form-control">
		        		</div>
		        		<div class="col-xs-3">
			                <label>Etnia</label>
			                <v-select 
			        			:disabled="!exist_document" 
			            		label="name" 
			            		:class="'bg-white'" 
			            		v-model="person.ethnic" 
			            		:options="list_ethnics"></v-select>
		        		</div>
		        		<div class="col-xs-3">
			                <label>Genero</label>
			                <v-select 
			        			:disabled="!exist_document" 
			            		label="title" 
			            		:class="'bg-white'" 
			            		v-model="person.gender" 
			            		:options="list_genders"></v-select>
		        		</div>
		        	</div>
		        	<!-- col-md-12 -->
		        	<div class="form-group row">
		        		<div class="col-xs-12 text-center">
		        			<small>Localidad de nacimiento</small>
		        		</div>
		        		<div class="col-xs-4">
			                <label>Pais</label>
			                <v-select 
			        			:disabled="!exist_document" 
			            		label="title" 
			            		:class="'bg-white'" 
			            		v-model="person.gender" 
			            		:options="list_genders"></v-select>
		        		</div>
		        		<div class="col-xs-4">
			                <label>Estado</label>
			                <v-select 
			            		label="title" 
			            		:class="'bg-white'" 
			            		v-model="person.gender" 
			            		:options="list_genders"></v-select>
		        		</div>
		        		<div class="col-xs-4">
			                <label>Municipio</label>
			                <v-select 
			            		label="title" 
			            		:class="'bg-white'" 
			            		v-model="person.gender" 
			            		:options="list_genders"></v-select>
		        		</div>
		        	</div>
		        	<!-- col-md-12 -->
		        	<div class="form-group row">
		        		<div class="col-xs-12 text-center">
		        			<small>Localidad de residencia</small>
		        		</div>
		        		<div class="col-xs-4">
			                <label>Pais</label>
			                <v-select 
			        			:disabled="!exist_document" 
			            		label="title" 
			            		:class="'bg-white'" 
			            		v-model="person.gender" 
			            		:options="list_genders"></v-select>
		        		</div>
		        		<div class="col-xs-4">
			                <label>Estado</label>
			                <v-select 
			            		label="title" 
			            		:class="'bg-white'" 
			            		v-model="person.gender" 
			            		:options="list_genders"></v-select>
		        		</div>
		        		<div class="col-xs-4">
			                <label>Municipio</label>
			                <v-select 
			            		label="title" 
			            		:class="'bg-white'" 
			            		v-model="person.gender" 
			            		:options="list_genders"></v-select>
		        		</div>
		        	</div>
		        	<!-- col-md-12 -->
		        	<div class="form-group row">
		        		<div class="col-xs-12 text-center">
		        			<small>Direccion de habitación (residencia)</small>
		        		</div>
		        		<div class="col-xs-12">
			                <label>Direccion</label>
			                <textarea 
			        			:disabled="!exist_document" 
			                	v-model="person.direction" 
			                	class="form-control"></textarea>
			            </div>
		            </div>
		        	<!-- col-md-12 -->
		        	<div class="form-group row">
		        		<div class="col-xs-12 text-center">
		        			<small>Información de Contacto</small>
		        		</div>
		        		<div class="col-xs-4">
			                <label>Telefono Local</label>
			                <input 
			        			:disabled="!exist_document" 
			                	v-model="person.local_phone" 
			                	class="form-control"></input>
			            </div>
		        		<div class="col-xs-4">
			                <label>Telefono Movil</label>
			                <input 
			        			:disabled="!exist_document" 
			                	v-model="person.movil_phone" 
			                    class="form-control"></input>
			            </div>
		        		<div class="col-xs-4">
			                <label>Correo Electronico</label>
			                <input
			        			:disabled="!exist_document" 
			                	type="email"
			                	v-model="person.mail_contact" 
			                	class="form-control"></input>
			            </div>
			        </div>
		            <!-- col-md-12 -->
		        </form>
			</div>
		</div>
	</div>
</template>

<script>
import {en, es} from 'vuejs-datepicker/dist/locale'
export default {
    mounted(){
        this.getDocuments();
        this.getEthnics();
    },
	data(){
		return {
			es:es,
			exist_document:false,
			list_documents:[],
			list_ethnics:[],
            no_dates:{
    			to: new Date('1920-01-01'),
    			from: new Date()
            },
			list_genders:[
				{'title':'masculino','abr':'m'},
				{'title':'femenino','abr':'f'}
			],
			person:{
            	id: 0,
                firstname:null,
                middlename:null,
                firstlastname:null,
                middlelastname:null,
                nro_document:null,
                gender:null,
                ethnic:null,
                document:{
                    id:0,
                    name:null,
                },
                birthday:new Date(),
                year:null,
                direction:null,
                local_phone:null,
                movil_phone:null,
                mail_contact:null
        	}
		}
	},
    methods:{
    	getDocuments()
        {
            let url = location.origin+"/get-documents"
            axios.get(url).then(response => {
                this.list_documents = response.data
            }).catch(errors =>{
                console.log(errors.response)
            })
        },
        getEthnics()
        {
            let url = location.origin+"/get-ethnics"
            axios.get(url).then(response => {
                this.list_ethnics = response.data
            }).catch(errors =>{
                console.log(errors.response)
            })
        },
		calYear(){
        	let moment = require('moment')
			let a = moment(new Date());
			let b = moment(this.person.birthday);
			let years = a.diff(b, 'year');
				b.add(years, 'years');
			let months = a.diff(b, 'months');
				b.add(months, 'months');
			let days = a.diff(b, 'days');

			if(years==0){
				if(months<=1){
					if(days<=1){
						this.person.year = months + ' mes ' + days + ' dia';
				    }else{
						this.person.year =  months + ' mes ' + days + ' dias';
				    }
			   }else{
					if(days<=1){
					   this.person.year =  months + ' meses ' + days + ' dia';
					}else{
					   this.person.year =  months + ' meses ' + days + ' dias';
					}  
			   }
			}else{
				if(years==1){
					this.person.year =  years + ' año';
			    }else{
					this.person.year =  years + ' años';
			    }	
			}
		}
    }
}
</script>

<style>
.mb-4{
    margin-bottom: 7%;
}
.bg-white{
	background: white !important;
}
legend.scheduler-border {
   width: auto;
   border-bottom: none;
}
</style>