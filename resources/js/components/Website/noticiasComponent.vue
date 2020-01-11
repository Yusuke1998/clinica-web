<template>
	<h3 class="text-center">Todas las Noticias</h3>
</template>
<script>
export default {
    mounted(){
    	this.getPost('noticias',15)
    },
	data(){
		return {
			noticias:[]
		}
	},
	methods:{
		getPost(filtro='',numero=''){
            let url = location.origin+"/get-post";
            if (filtro!=''){url = url+'/'+filtro;}
            if (numero!=''){url = url+'/'+numero;}
            axios.get(url).then(response => {
                this.noticias = response.data
            }).catch(errors =>{
                console.log(errors)
            })
    	}
	}
}
</script>