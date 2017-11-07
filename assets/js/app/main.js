new Vue({
    el: '#main',
    delimiters: ['@{', '}'],
    data: {
        filter_group: '',
        filter_module: '',
        filter_dni: '',
        filter_fullname: '',
        students: [
            {
                fullname: 'Juan Rodas', 
                notes:[
                    {id: 1, value: 20, edit: false},
                    {id: 2, value: 12, edit: false},
                    {id: 3, value: 14, edit: false},
                    {id: 4, value: 15, edit: false}
                ],
                prom: 15,
                edit: false
            }
        ],
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
        // Crud de notas,

    }
});