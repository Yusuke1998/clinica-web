<template>
	<div class="row">
        <div class="col-md-12">
			<h4 class="text-center">Historial</h4>
		</div>
	    <form class="col-md-8 col-md-offset-2">
            <!-- col-md-12 -->
        	<div class="form-group row">
        		<div class="col-xs-6 col-sm-6 col-md-6">
	        		<label>Tipo de Documento</label>
	            	<v-select 
	            		label="name" 
	            		:class="'bg-white'" 
	            		v-model="person.document" 
	            		:options="list_documents"></v-select>
        		</div>
        		<div class="col-xs-6 col-sm-6 col-md-6">
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
        		<div class="col-xs-6 col-sm-6 col-md-6">
	        		<label>Primer Nombre</label>
	        		<input 
	        			type="text" 
	        			class="form-control" 
	        			v-model="person.firstname">
        		</div>
        		<div class="col-xs-6 col-sm-6 col-md-6">
	        		<label>Segundo Nombre</label>
	        		<input 
	        			type="text" 
	        			class="form-control" 
	        			v-model="person.firstnameii">
        		</div>
        	</div>
        	<!-- col-md-12 -->
        	<div class="form-group row">
        		<div class="col-xs-6 col-sm-6 col-md-6">
	        		<label>Primer Apellido</label>
	        		<input 
	        			type="text" 
	        			class="form-control" 
	        			v-model="person.lastname">
        		</div>
        		<div class="col-xs-6 col-sm-6 col-md-6">
	        		<label>Segundo Apellido</label>
	        		<input 
	        			type="text" 
	        			class="form-control" 
	        			v-model="person.lastnameii">
        		</div>
            </div>
        	<!-- col-md-12 -->
        	<div class="form-group row">
        		<div class="col-xs-4 col-sm-4 col-md-4">
	                <label>Fecha de Nacimiento</label>
	                <datepicker
	                    :full-month-name="true"
	                    :language="es"
	                    :disabled-dates="no_dates" 
	                    v-model="person.birthday"
	                    :input-class="'bg-white form-control'"></datepicker>
	            </div>
        		<div class="col-xs-8 col-sm-8 col-md-8">
	                <label>Direccion</label>
	                <textarea 
	                	v-model="person.direction" 
	                	class="form-control"></textarea>
	            </div>
            </div>
        	<!-- col-md-12 -->
        	<div class="form-group row">
        		<div class="col-xs-4 col-sm-4 col-md-4">
	                <label>Telefono Local</label>
	                <input 
	                	v-model="person.local_phone" 
	                	class="form-control"></input>
	            </div>
        		<div class="col-xs-4 col-sm-4 col-md-4">
	                <label>Telefono Movil</label>
	                <input 
	                	v-model="person.movil_phone" 
	                    class="form-control"></input>
	            </div>
        		<div class="col-xs-4 col-sm-4 col-md-4">
	                <label>Correo Electronico</label>
	                <input 
	                	v-model="person.mail_contact" 
	                	class="form-control"></input>
	            </div>
	        </div>
            <!-- col-md-12 -->
        </form>
	</div>
</template>

<script>
import {en, es} from 'vuejs-datepicker/dist/locale'
export default {
    mounted(){
        this.getDocuments();
    },
	data(){
		return {
			es:es,
			exist_document:false,
            no_dates:{to: new Date('1919-01-01')},
			list_documents:[],
			person:{
            	id: 0,
                firstname:null,
                firstnameii:null,
                lastname:null,
                lastnameii:null,
                nro_document:null,
                gender:null,
                document:{
                    id:0,
                    name:null,
                },
                birthday:new Date(),
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
    }
}
</script>