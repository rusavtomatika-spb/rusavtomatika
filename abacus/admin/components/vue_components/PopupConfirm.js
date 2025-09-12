export default {
    data() {
        return {
            show: false,
            text: '',
            id: 0,
            action: '',
        }
    },
    created() {
    },
    mounted() {
        let href = '/abacus/admin/components/vue_components/PopupConfirm.css';
        const test_link = document.querySelectorAll("[href='"+href+"']");
        if(test_link.length == 0){
            let link = document.createElement("link");
            link.setAttribute("rel", "stylesheet");
            link.setAttribute("type", "text/css");
            link.setAttribute("href", href);
            document.getElementsByTagName("body")[0].appendChild(link);
        }
    },
    methods: {
    },
    emits: ['action_confirmed'],
    props: [],
    template: `
<div class="popup_confirm" v-if="show">
        <div class="wrapinn">
            <div :class="['question', 'action-'+action]">
                {{text}}
            </div>
            <div class="buttons is-flex is-justify-content-center">
                <div @click="$emit('action_confirmed',{index:id,action:action});show=false;" class="button is-primary">
                    Да
                </div>
                <div @click="show=false" class="button is-danger">
                    Нет
                </div>
            </div>
        </div>
    </div>
`,
}