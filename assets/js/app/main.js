new Vue({
    el: '#main',
    delimiters: ['@{', '}'],
    data: {
        filter_group: '',
        filter_module: '',
        filter_dni: '',
        filter_fullname: '',
        students: [],
        talleres: ''
    },
    created: function(){
        this.listEnrollments();
    },
    methods: {
        filterStudents: function(){
            console.log('parametros tomados en cuenta'+'\n');
            console.log(this.filter_group+'\n');
            console.log(this.filter_module+'\n');
            console.log(this.filter_dni+'\n');
            console.log(this.filter_fullname+'\n');
            console.log('Buscando....'+'\n');
            console.log('Aplicanco axios....'+'\n');
        },
        saveNotes: function(){
            console.log("Cambios guardados");
        },
        
        // Crud de notas,
        doneNotes: function(index){
            var self = this;


            var csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;

            var headers = {
                'X-CSRF-TOKEN': csrf_token
            };

            axios.post('http://intranetehsq.ehsqgroup.app/api/secretaria-academico/', {'data': self.students[index].califications}, headers)
            .then(function (response) {
               console.log(response);
            })
            .catch(function (error) {
            });  
        },
        editNotes: function(index){
            this.students[index].edit = true;
        },
        cancelEditNotes(index){
            this.students[index].edit = false;
        },
        calculateProm: function(califications, enrollment){

            var count = califications.length;
            
            var calc  = 0;
            var prom  = 0;

            califications.forEach(function(element) {
                calc += parseFloat(element.value);
            }, this);
               
            var prom = (calc / count);
            
            console.log(calc + ' ' +count+' '+enrollment);

            return prom.toFixed(2);
        },
        listEnrollments(){
            var self = this;
            axios.get('http://intranetehsq.ehsqgroup.app/api/secretaria-academico?id_group=26&id_academic_period=13&cod_modulo=38&cod_esp_tipo=12&cod_esp=60')
            .then(function (response) {
                self.students = response.data.data;
                self.talleres = response.data.talleres;
            })
            .catch(function (error) {
            });
        }
        // Crud de notas,

    }
});