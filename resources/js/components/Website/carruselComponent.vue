<template>
	<div class="container">
        <v-carousel  
            :autoplay="true"
            autoplay_speed="3"
            :nav="false"
            :margin="10"
            :items="4">
            <template v-for="(noticia,index) in noticias">
	            <div class="panel">
	                <div class="panel-body">
	                    <img :src="$root.base_url+'website/img/photo/'+(index+1)+'.jpg'">
	                </div>
	                <div class="panel-footer">
	                    <p v-text="noticia.short_description"></p>
	                </div>
	            </div>
            </template>
        </v-carousel>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getPost('noticias');
        },
        data(){
			return {
				noticias:[]
			}
		},
		methods:{
			getPost(filtro=''){
				let url = location.origin+"/get-post";
				if (filtro){
					url = url+'/'+filtro
				}
	            axios.get(url).then(response => {
	                this.noticias = response.data
	            }).catch(errors =>{
	                console.log(errors.response)
	            })
			}
		}
    }
</script>