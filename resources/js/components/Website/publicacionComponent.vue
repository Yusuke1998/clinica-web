<template>
    <div class="container" v-if="publicacion!==null">
        <div class="panel bgdefault">
            <div class="panel-heading bgdefault">
                <h2 class="text-center break-text" v-text="publicacion.title"></h2>
            </div>
            <div class="panel-body bgdefault">
                <center>
                    <img :src="$root.base_url_img+publicacion.image_large" :alt="publicacion.title" width="90%" class="mb-4">
                </center>
                <h3 class="break-text font-weight-light" v-text="publicacion.subtitle"></h3>
                <p class="break-text" v-html="publicacion.post_body"></p>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6 pull-left">
                        <a href="#">Publicado el
                            <span v-text="$root.date('f2',publicacion.posted_at) +' a las '+ $root.date('f1',publicacion.posted_at)"></span>
                        </a> 
                    </div>
                    <div class="col-md-6">
                        <a class="pull-right" href="#">Autor(a) <b v-text="publicacion.author.person.firstname +' '+publicacion.author.person.firstlastname"></b></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel mt-4 bgdefault">
            <div class="panel-heading bgdefault">
                <h4 class="text-center"><img :src="$root.base_origin_url+'/website/assets/icono_comentarios.png'"> &nbspComentarios</h4>
                <div class="panel" v-if="!table_data.length > 0">
                    <div class="panel-body text-center text-dark">
                        No hay comentarios.
                    </div>
                </div>
                <div v-else v-for="(item_table,index) in table_data" :key="index" class="panel mb-1">
                    <div class="panel-body">
                        <div style="border: 0.5%; border-style: groove; padding: 1%;">
                            <p class="break-text" v-text="item_table.comment"></p>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-6 pull-left">
                                <a href="#" class="h6">
                                    <span v-text="$root.date('f2',item_table.created_at) +' a las '+ $root.date('f1',item_table.created_at)"></span>
                                </a> 
                            </div>
                            <div class="col-md-6">
                                <a class="pull-right h6" href="#">Autor(a) <b v-text="item_table.author_name"></b></a>
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
            <div class="panel-body bgdefault">
                <h5 class='text-center'>Agrega un comentario</h5>
                <form @submit.prevent>
                    <div class="form-group">
                        <label id="comment_label" for="comment">Comentario </label>
                        <textarea
                            v-model="comentario.comment"
                            class="form-control"
                            required
                            placeholder="Escribe aqui"
                            rows="7"></textarea>
                    </div>
                    <div v-if="$root.sesion.user==null || $root.sesion.user==undefined" class='container-fluid'>
                        <div class='row'>
                            <div class='col'>
                                <div class="form-group ">
                                    <label id="author_name_label" for="author_name">Nombre y Apellido</label>
                                    <input
                                        v-model="comentario.name"
                                        type='text'
                                        class="form-control"
                                        placeholder="Tu nombre y apellido"
                                        required>
                                </div>
                            </div>
                            <div class='col'>
                                <div class="form-group">
                                    <label id="author_email_label" for="author_email">Tu correo electronico
                                    </label>
                                    <input
                                        v-model="comentario.email"
                                        type='email'
                                        class="form-control"
                                        placeholder="Tu correo electronico"
                                        required>
                                </div>
                            </div>
                            <div class='col'>
                                <div class="form-group">
                                    <label id="author_website_label" for="author_website">Tu sitio web
                                    </label>
                                    <input
                                        v-model="comentario.web"
                                        type='url'
                                        class="form-control"
                                        placeholder="URL de sitio web">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <button
                            @click="commented()" 
                            class="form-control input-sm btn btn-success">
                            Comentar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted(){
        this.getPublication()
    },
    data(){
        return {
            publicacion:null,
            comentario:{
                user_id:0,
                name:'',
                email:'',
                web:'',
                comment:''
            },
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
        getPublication(page)
        {
            let url = location.href;
            axios.get(url).then(response =>{
                this.publicacion = response.data[0]
                this.getComments()
            }).catch(errors =>{
                console.log(errors)
            })
        },
        getComments(page)
        {
            let url = location.origin+"/get-comments-paginate/"+this.publicacion.slug;
            axios.post(url,{
                page   : page, 
                sort   : this.sort_selected, 
            }).then(response =>{
                this.table_pagination = response.data.pagination
                this.table_data       = response.data.table
            }).catch(errors =>{
                console.log(errors)
            })
        },
        commented()
        {
            let t=this
            let url = location.origin+'/post-commented/'+this.publicacion.slug;
            if (t.$root.sesion.user!==null && t.$root.sesion.user!==undefined)
            {
                t.comentario.user_id    = t.$root.sesion.user.id
                t.comentario.email      = t.$root.sesion.user.email
                t.comentario.name       = t.$root.sesion.user.name
            }

            if (t.comentario.comment!==''&&t.comentario.name!==''&&t.comentario.email!=='') {
                axios.post(url,{
                    'comentario':this.comentario
                }).then(response =>{
                    this.$alertify.success('Comentario enviado!')
                    this.commentedBlank()
                    this.getComments()
                }).catch(errors =>{
                    this.$alertify.error('Error inesperado!')
                    console.log(errors)
                })
            }else{
                this.$alertify.warning('Campos vacios!')
            }
        },
        commentedBlank(){
            this.comentario={
                user_id:0,
                name:'',
                email:'',
                web:'',
                comment:''
            }
        },
        changePage: function(page) 
        {
            this.table_pagination.current_page = page;
            this.getComments(page);
        }
    }
}
</script>

<style>
.mb-1{
    margin-bottom: 2%;
}
.mb-4{
    margin-bottom: 3%;
}

.mt-4{
    margin-top: 7%;
}

.bgdefault{
    background-color: #F2F2F2;
}
</style>