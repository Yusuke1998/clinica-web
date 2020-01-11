<template>
	<h3 class="text-center">Todos los Eventos</h3>
</template>
<script>
export default {
    mounted(){
    	this.getPost('eventos',15)
    },
	data(){
		return {
			eventos:[]
		}
	},
	methods:{
		getPost(filtro='',numero=''){
            let url = location.origin+"/get-post";
            if (filtro!=''){url = url+'/'+filtro;}
            if (numero!=''){url = url+'/'+numero;}
            axios.get(url).then(response => {
                this.eventos = response.data
            }).catch(errors =>{
                console.log(errors)
            })
    	}
	}
}
</script>