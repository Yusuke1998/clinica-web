<template>
	<h3 class="text-center">Todos los Convenios</h3>
</template>
<script>
export default {
    mounted(){
    	this.getPost('convenios',15)
    },
	data(){
		return {
			convenios:[]
		}
	},
	methods:{
		getPost(filtro='',numero=''){
            let url = location.origin+"/get-post";
            if (filtro!=''){url = url+'/'+filtro;}
            if (numero!=''){url = url+'/'+numero;}
            axios.get(url).then(response => {
                this.convenios = response.data
            }).catch(errors =>{
                console.log(errors)
            })
    	}
	}
}
</script>