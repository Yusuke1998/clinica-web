<template>
	<div class="col-md-8">
		<h4>Noticias</h4>
		<div v-if="noticias.length == 0">
			<p class="text-center">No hay noticias...</p>
		</div>
		<div v-else class="media" v-for="(noticia,index) in noticias">
			<div class="media-left">
				<a :href="$root.url_ir+noticia.slug">
					<img width="190" class="media-object" :src="$root.base_url_img+noticia.image_medium" :title="noticia.short_description">
				</a>
			</div>
			<div class="media-body">
				<small>
					<span :title="$root.date('f2',noticia.posted_at) +' - '+ $root.date('f1',noticia.posted_at)" v-text="$root.date('f2',noticia.posted_at) +' - '+ $root.date('f1',noticia.posted_at)"></span>
				</small>
				<a :href="$root.url_ir+noticia.slug">
					<h5 :title="noticia.short_description" class="media-heading break-text" v-text="noticia.title"></h5>
				</a>
				<a :href="$root.url_ir+noticia.slug" class="btn btn-sm btn-primary pull-center">Leer más &rarr;</a>
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