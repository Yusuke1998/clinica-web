<template>
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-12">
          <h1 class="my-4">Noticias
            <small>más relevantes.</small>
          </h1>

        <!-- Blog Post -->
        <div class="panel" v-if="!table_data.length > 0">
            <div class="panel-body text-center text-dark">
                No se encontraron coincidencias.
            </div>
        </div>
        <div v-else v-for="(item_table,index_for_table) in table_data" :key="index_for_table" class="panel mb-4">
            <center>
                <img class="panel-img-top" :src="$root.base_url_img+item_table.image_medium" alt="panel image cap">
            </center>
            <div class="panel-body">
                <h2 v-text="item_table.title" class="panel-heading"></h2>
                <p v-text="item_table.short_description" class="panel-text"></p>
                <a href="#" class="btn btn-primary pull-right">Leer más &rarr;</a>
            </div>
            <div class="panel-footer text-muted">
                <div class="row">
                    <div class="col-md-6 pull-left">
                        <a href="#">Publicado el
                            <span v-text="$root.date('f2',item_table.posted_at) +' a las '+ $root.date('f1',item_table.posted_at)"></span>
                        </a> 
                    </div>
                    <div class="col-md-6">
                        <a class="pull-right" href="#">Autor(a) <b v-text="item_table.author.person.firstname +' '+item_table.author.person.firstlastname"></b></a>
                    </div>
                </div>

            </div>
        </div>

        <pagination
            v-if="table_data.length > 0"
            :table_pagination='table_pagination' 
            @changePage="changePage">
        </pagination>

        </div>
    </div>
</template>
<script>
export default {
    mounted(){
        this.getData()
    },
	data(){
		return {
			noticias:[],
            // DATOS DEL DATATABLE 
            table_data:[],
            sort_table:['5','10','15','25','35','100'],
            sort_selected:5,
            search_table:'',
            table_pagination:{
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0
            },
		}
	},
	methods:{
        getData(page)
        {
            let url = location.origin+"/get-post-paginate/noticias";
            axios.post(url,{
                page   : page, 
                sort   : this.sort_selected, 
                search : this.search_table,
                type   : this.type_contract
            }).then(response =>{
                this.table_pagination   = response.data.pagination
                this.table_data         = response.data.table.data
                this.search_table       = ''
            }).catch(errors =>{
                console.log(errors)
            })
        },
        changePage: function (page) 
        {
            this.table_pagination.current_page = page;
            this.getData(page);
        }
	}
}
</script>

<style>
.mb-4{
    margin-bottom: 7%;
}
</style>