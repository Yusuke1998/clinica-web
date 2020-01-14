<template>
	<div class="panel">
		<div class="panel-heading">
			<h5 class="text-center">Perfil de Usuario</h5>
		</div>		
		<div class="panel-body">		
			<div class="row">
			    <form @submit.prevent class="col-xs-10 col-xs-offset-1">
		            <!-- col-xs-12 -->
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
		        	<!-- col-xs-12 -->
		        	<div class="form-group row">
		        		<div class="col-xs-6">
			        		<label>Nombres</label>
			        		<input 
			        			:disabled="person.nro_document==null" 
			        			type="text" 
			        			class="form-control" 
			        			v-model="person.firstnames">
		        		</div>
		        		<div class="col-xs-6">
			        		<label>Apellidos</label>
			        		<input 
			        			:disabled="person.nro_document==null" 
			        			type="text" 
			        			class="form-control" 
			        			v-model="person.lastnames">
		        		</div>
		        	</div>
		        	<!-- col-xs-12 -->
		        	<div class="form-group row">
		        		<div class="col-xs-12 text-center">
		        			<small>Datos de Usuario</small>
		        		</div>
		        		<div class="col-xs-6">
			                <label>Usuario</label>
			                <input 
			        			:disabled="person.nro_document==null" 
			                	v-model="user.name" 
			                	type="text"
			                	class="form-control"></input>
			            </div>
		        		<div class="col-xs-6">
			                <label>Correo Electronico</label>
			                <input 
			        			:disabled="person.nro_document==null" 
			                	v-model="user.email"
			                	type="email" 
			                    class="form-control"></input>
			            </div>
			        </div>
		        	<div class="form-group row">
		        		<div class="col-xs-6">
			                <label>Contraseña</label>
			                <input
			        			:disabled="person.nro_document==null" 
			                	type="password"
			                	v-model="user.password" 
			                	class="form-control"></input>
			            </div>
			            <div class="col-xs-6">
			                <label>Confirmar Contraseña</label>
			                <input
			        			:disabled="person.nro_document==null" 
			                	type="password"
			                	v-model="user.password_confirmation" 
			                	class="form-control"></input>
			            </div>
			        </div>
		            <!-- col-xs-12 -->
		        	<div class="form-group row">
			            <div class="col-xs-12">
			            	<button 
			            		@click="store()" 
			            		class="pull-right btn btn-sm btn-primary">Guardar</button>
			            </div>
		        	</div>
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
        this.verify();
    },
	data(){
		return {
			es:es,
			list_documents:[],
			user:{
				id:0,
				name:null,
				password:null,
				password_confirmation:null,
				email:null
			},
			person:{
            	id: 0,
                firstnames:null,
                lastnames:null,
                nro_document:null,
                document:null
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
        verify()
        {
        	if (this.$root.sesion.user!==null && this.$root.sesion.user!==undefined)
        	{
        		let user = this.$root.sesion.user
        		this.user={
					id:user.id,
					name:user.name,
					password:null,
					password_confirmation:null,
					email:user.email
				}
        		let person = this.$root.sesion.person
        		let doc = this.$root.sesion.document
        		this.person={
	            	id:person.id,
	                firstnames:person.firstname+' '+person.middlename,
	                lastnames:person.firstlastname+' '+person.middlelastname,
	                nro_document:person.nro_document,
	                document:doc
        		}
        	}
        },
        store()
        {
        	let url = location.origin+"/web/user-store"
        	axios.post(url,{
        		user:this.user,
        		person:this.person
        	}).then(response => {
                this.$alertify.success('Registro exitoso!')
            }).catch(errors =>{
                console.log(errors.response)
                if (status = 204)
                {
                    Object.values(errors.response.data.errors).forEach((element,indx) => {
                        this.$alertify.error(element.toString())
                    });
                }
            })
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