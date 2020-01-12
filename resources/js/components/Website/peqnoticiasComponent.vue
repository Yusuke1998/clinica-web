<template>
	<div class="col-md-8">
		<h4>Noticias</h4>
		<div v-if="noticias.length == 0">
			<p class="text-center">No hay noticias...</p>
		</div>
		<div v-else class="media" v-for="(noticia,index) in noticias">
			<div class="media-left">
				<a :href="$root.url_ir+noticia.slug">
					<img width="190" class="media-object" :src="$root.base_url_img+noticia.image_large" alt="...">
				</a>
			</div>
			<div class="media-body">
				<small>
					<span v-text="$root.date('f2',noticia.posted_at) +' - '+ $root.date('f1',noticia.posted_at)"></span>
				</small>
				<a :href="$root.url_ir+noticia.slug">
					<h5 class="media-heading" v-text="noticia.title"></h5>
				</a>
				<p class="media-heading" v-text="noticia.short_description"></p>
			</div>
		</div>
    </div>
</template>
<script>
export default {
    mounted(){
    	this.getPost('noticias',5)
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