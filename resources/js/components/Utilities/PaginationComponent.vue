<template>
    <div class="row">
        <div class="col-lg-3 col-xs-3 col-md-3">
            <span>Pagina {{table_pagination.current_page}} De {{table_pagination.last_page}}.</span>
        </div>
        <div class="col-lg-6 col-xs-6 col-md-6 text-center">
            <ul class="pagination justify-content-center mb-4">
                <li 
                    class="page-item"
                    v-if="table_pagination.current_page > 1">
                    <a 
                        class="page-link" 
                        href="#"
                        @click.prevent="$emit('changePage',table_pagination.current_page - 1)">&larr; anterior</a>
                </li>
                <li 
                    class="page-item disabled"
                    v-else>
                    <a class="page-link">anterior &rarr;</a>
                </li>

                <li 
                    class="page-item"
                    v-if="table_pagination.current_page < table_pagination.last_page">
                    <a 
                        class="page-link" 
                        href="#"
                        @click.prevent="$emit('changePage',table_pagination.current_page + 1)">siguiente &rarr;</a>
                </li>
                <li 
                    class="page-item disabled"
                    v-else>
                    <a class="page-link disabled">siguiente &rarr;</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-3 col-xs-3 col-md-3 text-right">
            {{table_pagination.total}} Registros Encontrados.
        </div>
    </div>      
</template>

<script>
export default {
    props:['table_pagination'],
    data() {
		return {
            offset: 1,
        }
	},
    computed: {
        isActived: function () {
            return this.table_pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.table_pagination.to) {
                return [];
            }

            var from = this.table_pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }

            var to = from + (this.offset * 2);
            if (to >= this.table_pagination.last_page) {
                to = this.table_pagination.last_page;
            }

            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
    },
}
</script>

<style>
    .actived {
        background: pink !important;
    }
</style>
