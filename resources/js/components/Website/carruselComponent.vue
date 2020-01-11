<template>
	<div class="container">
        <v-carousel  
            :autoplay="true"
            autoplay_speed="3"
            :nav="false"
            :margin="10"
            :items="4">
        	<div v-for="(num,index) in 6">
        		<div class="panel">
			    	<div class="panel-body">
			        	<img :src="$root.base_url+'website/img/photo/'+(index+1)+'.jpg'">
			    	</div>
			        <div class="panel-footer">
			            <p v-text="carrusel[index].title"></p>
			        </div>
			    </div>
        	</div>
        </v-carousel>
    </div>
</template>

<script>
    export default {
        created() {
            this.getPost('carrusel')
        },
        data(){
			return {
				carrusel:[]
			}
		},
		methods:{
			getPost(filtro=''){
	            let url = location.origin+"/get-post";
	            if (filtro!=''){
	                url = url+'/'+filtro;
	            }
	            axios.get(url).then(response => {
	                this.carrusel = response.data
	            }).catch(errors =>{
	                console.log(errors)
	            })
	    	}
		}
    }
</script>