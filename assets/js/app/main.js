new Vue({
    el: '#main',
    delimiters: ['@{', '}'],
    data: {
        filter_group: '',
        filter_module: '',
        filter_dni: '',
        filter_fullname: '',
        students: [],
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
            var notes = this.students[index].notes;
            var count = notes.length;
            var calc  = 0;
            notes.forEach(function(element) {
                calc += parseFloat(element.value);
            }, this);
            this.students[index].prom = (calc / count);
            this.students[index].edit = false;
        },
        editNotes: function(index){
            this.students[index].edit = true;
        },
        cancelEditNotes(index){
            this.students[index].edit = false;
        }
        ,
        listEnrollments(){
            var self = this;
            axios.get('http://intranetehsq.ehsqgroup.app/api/secretaria-academico?id_group=14&id_academic_period=8&cod_modulo=26&cod_esp_tipo=11&cod_esp=16')
            .then(function (response) {
                self.students = response.data;
            })
            .catch(function (error) {
              console.log(error);
            });
        }
        // Crud de notas,

    }
});