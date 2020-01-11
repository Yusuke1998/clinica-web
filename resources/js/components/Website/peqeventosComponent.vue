<template>
	<div class="col-md-4">
	    <h4>Eventos</h4>
		<div v-if="eventos.length == 0">
			<p class="text-center">No hay eventos...</p>
		</div>
	    <ul v-else class="list-group">
	      <li v-for="(evento,index) in eventos" class="list-group-item" v-text="evento.title"></li>
	    </ul>
	</div>
</template>
<script>
export default {
    mounted(){
    	this.getPost('eventos',5)
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