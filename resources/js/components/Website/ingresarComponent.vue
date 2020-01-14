<template>
	<div class="panel">	
		<div class="panel-body">		
			<div class="row">
		        <form @submit.prevent class="col-xs-12">
		            <div class="form-group col-md-5">
		                <input 
		                	v-model="user.email"
		                	type="text" 
		                	class="form-control form-control-alt form-control-lg" 
		                	required 
		                	autocomplete="email" 
		                	autofocus 
		                	placeholder="Correo Electronico">
		            </div>
		            <div class="form-group col-md-5">
		                <input 
		                	v-model="user.password"
		                	type="password" 
		                	class="form-control form-control-alt form-control-lg" 
		                	required 
		                	autocomplete="current-password" 
		                	placeholder="Contraseña">
		            </div>
		            <div class="col-md-2">
		                <button 
		                	type="submit" 
		                	@click="login()" 
		                	class="btn btn-block btn-primary">
		                    <i class="fa fa-check"></i>
		                </button>
		            </div>
		        </form>
		    </div>
		</div>
	</div>
</template>

<script>
export default {
	data(){
		return {
			user:{
				email:null,
				password:null
			}
		}
	},
    methods:{
        verify()
        {
        	if (this.$root.sesion.user!==null && this.$root.sesion.user!==undefined)
        	{
        		let user = this.$root.sesion.user
        		$alertify.warning($user.name+' ya has iniciado sesion');
        		return;
        	}
        },
        login()
        {
        	this.verify();
        	let url = location.origin+"/web/user-login"
        	let redirect = location.origin+"/web/usuario"
        	axios.post(url,{
        		email:this.user.email,
        		password:this.user.password,
        	}).then(response => {
        		if (response.data==='fine') {
                	this.$alertify.success('Inicio de sesion!')
                	window.location.replace(redirect)
        		}else{
                	this.$alertify.error('Credenciales incorrectas!')
        		}
            }).catch(errors =>{
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
</style>