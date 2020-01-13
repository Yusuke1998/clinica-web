<template>
    <div v-if="carruselData.length < 6" class="container">
    	<div class="jumbotron">
    		<p class="h4 text-center">No hay suficientes elementos para el carrusel</p>
    	</div>
    </div>
	<div v-else class="container">
        <v-carousel  
            :autoplay="true"
            autoplay_speed="3"
            :nav="false"
            :margin="5"
            :items="4">
        	<div v-for="(num,index) in 6">
        		<div class="panel">
		        	<img :src="img(carruselData[index])">
			        <div class="panel-footer">
			            <span class="break-text" v-text="title(carruselData[index])"></span>
			        </div>
			    </div>
        	</div>
        </v-carousel>
    </div>
</template>

<script>
    export default {
        created(){
            this.getPost('carrusel',6)
        },
        data(){
			return {
				carruselData:[]
			}
		},
		methods:{
			title(data){
				if (typeof data!=='undefined'){
					return data.title
				}
			},
			img(data){
				if (typeof data!=='undefined'){
					return this.$root.base_url_img+data.image_large;
				}
			},
			getPost(filtro='',numero=''){
	            let url = location.origin+"/get-post";
	            if (filtro!=''){url = url+'/'+filtro;}
            	if (numero!=''){url = url+'/'+numero;}
	            axios.get(url).then(response => {
	                this.carruselData = response.data
	            }).catch(errors =>{
	                console.log(errors)
	            })
	    	}
		}
    }
</script>