require('./bootstrap');

window.Vue = require('vue');

// componente
Vue.component('pagination', require('./components/Utilities/PaginationComponent.vue').default);
Vue.component('chart-component', require('./components/Utilities/ChartComponent.vue').default);
Vue.component('historial-component', require('./components/Website/historialComponent.vue').default);
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
                    break;  
                }
                case "f2":
                {
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
