<template>
	<div class="panel">
		<div class="panel-heading">
			<h5 class="text-center">Historial</h5>
		</div>		
		<div class="panel-body">		
			<div class="row">
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
			        			type="text" 
			        			class="form-control" 
			        			v-model="person.firstname">
		        		</div>
		        		<div class="col-xs-6">
			        		<label>Segundo Nombre</label>
			        		<input 
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
			        			type="text" 
			        			class="form-control" 
			        			v-model="person.firstlastname">
		        		</div>
		        		<div class="col-xs-6">
			        		<label>Segundo Apellido</label>
			        		<input 
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
			                	:onchange="calYear()"
			                    :full-month-name="true"
			                    :language="es"
			                    :disabled-dates="no_dates" 
			                    v-model="person.birthday"
			                    :input-class="'bg-white form-control'"></datepicker>
			            </div>
		        		<div class="col-xs-2">
			                <label>Edad</label>
			                <input
			                	disabled 
			                	v-model="person.year"
			                	type="text" 
			                	class="form-control">
		        		</div>
		        		<div class="col-xs-7">
			                <label>Direccion</label>
			                <textarea 
			                	v-model="person.direction" 
			                	class="form-control"></textarea>
			            </div>
		            </div>
		        	<!-- col-md-12 -->
		        	<div class="form-group row">
		        		<div class="col-xs-4">
			                <label>Telefono Local</label>
			                <input 
			                	v-model="person.local_phone" 
			                	class="form-control"></input>
			            </div>
		        		<div class="col-xs-4">
			                <label>Telefono Movil</label>
			                <input 
			                	v-model="person.movil_phone" 
			                    class="form-control"></input>
			            </div>
		        		<div class="col-xs-4">
			                <label>Correo Electronico</label>
			                <input
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
        this.calYear();
    },
	data(){
		return {
			es:es,
			exist_document:false,
            no_dates:{
    			to: new Date('1920-01-01'),
    			from: new Date()
            },
			list_documents:[],
			person:{
            	id: 0,
                firstname:null,
                middlename:null,
                firstlastname:null,
                middlelastname:null,
                nro_document:null,
                gender:null,
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
		calYear(){
        	let moment = require('moment')

			var a = moment(new Date());
			var b = moment(this.person.birthday);

			var years = a.diff(b, 'year');
			b.add(years, 'years');

			var months = a.diff(b, 'months');
			b.add(months, 'months');

			var days = a.diff(b, 'days');

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