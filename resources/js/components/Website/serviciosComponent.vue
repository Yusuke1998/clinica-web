<template>
	<h3 class="text-center">Todos los Servicios</h3>
</template>
<script>
export default {
    mounted(){
    	this.getPost('servicios',15)
    },
	data(){
		return {
			servicios:[]
		}
	},
	methods:{
		getPost(filtro='',numero=''){
            let url = location.origin+"/get-post";
            if (filtro!=''){url = url+'/'+filtro;}
            if (numero!=''){url = url+'/'+numero;}
            axios.get(url).then(response => {
                this.servicios = response.data
            }).catch(errors =>{
                console.log(errors)
            })
    	}
	}
}
</script>