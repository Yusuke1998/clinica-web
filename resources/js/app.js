require('./bootstrap');

window.Vue = require('vue');

// componente
Vue.component('pagination', require('./components/Utilities/PaginationComponent.vue').default);
Vue.component('chart-component', require('./components/Utilities/ChartComponent.vue').default);
    // website
    Vue.component('historial-component', require('./components/Website/historialComponent.vue').default);
    Vue.component('carrusel-component', require('./components/Website/carruselComponent.vue').default);
    Vue.component('noticias-component', require('./components/Website/noticiasComponent.vue').default);
    Vue.component('peqnoticias-component', require('./components/Website/peqnoticiasComponent.vue').default);
    Vue.component('eventos-component', require('./components/Website/eventosComponent.vue').default);
    Vue.component('peqeventos-component', require('./components/Website/peqeventosComponent.vue').default);
    Vue.component('servicios-component', require('./components/Website/serviciosComponent.vue').default);
    Vue.component('peqservicios-component', require('./components/Website/peqserviciosComponent.vue').default);
    Vue.component('convenios-component', require('./components/Website/conveniosComponent.vue').default);
    // website
// componente

/* plugins */
import Carousel from 'vue-owl-carousel';
    Vue.component('v-carousel', Carousel);

import swal from 'sweetalert';

import VueAlertify from 'vue-alertify';
    Vue.use(VueAlertify,{
        notifier: {
            delay: 5,
            position: 'top-right',
            closeButton: true,
        }
    });

import Datetimepicker from 'vuejs-datetimepicker';
    Vue.component('v-datetime', Datetimepicker)

import PictureInput from 'vue-picture-input'
    Vue.component('picture-input', PictureInput);

import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
    Vue.component('v-select', vSelect)

import Datepicker from 'vuejs-datepicker';
import {en, es} from 'vuejs-datepicker/dist/locale'
    Vue.component('datepicker', Datepicker)
/* plugins */

const app = new Vue({
    el: '#app',
    data(){
        return {
            base_url:location.href,
            base_url_img:location.origin+'/blog_images/',
            base_origin_url:location.origin,
            sesion:{
                user:global.user,
                person:global.person,
                is_admin:global.is_admin
            }
        }
    },
    mounted(){
    },
    methods:{
        /* reutilizables */
        loading(name, content)
        {
            swal({
                title:name,
                text:content,
                button:{
                    text: "Ok!",
                    closeModal: false,
                },
                icon:'/img/spin.gif',
                closeOnClickOutside: false,
                timer: 3500
            })
        },
        alert(name, content, img)
        {
            swal({
                title:name,
                text:content,
                button:{
                    text:'Ok'
                },
                icon:img,
            })
        },
        date(type='',val='')
        {
            let moment = require('moment')
            moment.locale('es');
            switch (type){
                case "f1":
                {
                    return moment(val).format('h:mm a')
                    break;  
                }
                case "f2":
                {
                    return moment(val).format('DD MMMM YYYY')
                    break;  
                }
                default:
                {
                    return moment().format('DD MMMM YYYY')
                    break;  
                }
            }
        }
    }
});
