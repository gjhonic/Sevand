let appPersonal = new Vue({
    el: '#app',
    data: {
        config: {
            projectName: 'TAPS',
            version: '0.1',
            lang: 'en',
            author: '',
        },
        //Ссылки
        url_get_personal: '../backend/actions/get-info.php',
        //Данные
        personalData: [],
    },
    computed: {
        Personal() {
            return this.personalData;
        },
    },
    methods: {
        loadPersonal(callback) {
            fetch(this.url_get_personal, {
                method: "GET",
            }).then(response => response.json()).then(data => {
                if (data.error === false) {
                    this.personalData = data.personal;
                }

                console.log(this.personalData);

                if (typeof callback !== 'undefined') {
                    let timerId = setTimeout(function () {
                        callback();
                    }, 500);
                }
            });
        }
    },
    mounted() {
        this.loadPersonal();
    },
});
