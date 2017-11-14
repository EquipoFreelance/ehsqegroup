new Vue({
    el: '#main',
    delimiters: ['@{', '}'],
    data: {
        filter_academic_period: '',
        filter_group: '',
        filter_esp: '',
        filter_esp_tipo: '',
        filter_module: '',
        filter_dni: '',
        filter_fullname: '',
        students: [],
        talleres: '',
        message: ''
    },
    created: function(){
    
        // Periodo Academico
        /*axios.get('http://intranetehsq.ehsqgroup.com/hsqegroup/api/academic-period')
        .then(function (response) {
            
            var period = response.data;
            var select = document.getElementById('filter_academic_period');

            var text = "";
            var x;
            for (x in period) {
                var opt = document.createElement('option');
                opt.value = period[x].id;
                opt.innerHTML = period[x].name;
                select.appendChild(opt);
            }

        });*/

        // Grupos
        axios.get('http://intranetehsq.ehsqgroup.com/hsqegroup/api/groups')
        .then(function (response) {
            
            var period = response.data;
            var select = document.getElementById('filter_group');

            var text = "";
            var x;
            for (x in period) {
                var opt = document.createElement('option');
                opt.value = period[x].id;
                opt.innerHTML = period[x].name;
                select.appendChild(opt);
            }

        });

        // Tipo de Especialización
        /*axios.get('http://intranetehsq.ehsqgroup.com/dashboard/json/esp_tipos')
        .then(function (response) {
            
            var period = response.data;
            var select = document.getElementById('filter_esp_tipo');

            var x;
            for (x in period) {
                var opt = document.createElement('option');
                opt.value = period[x].id;
                opt.innerHTML = period[x].name;
                select.appendChild(opt);
            }
            
        });*/
        //http://intranetehsq.ehsqgroup.com/dashboard/json/especializaciones/12

    },
    methods: {
        changeSpecializaciones: function(){
            
            var self = this;
            
            var select = document.getElementById('filter_esp');    

            axios.get('http://intranetehsq.ehsqgroup.com/dashboard/json/especializaciones/'+self.filter_esp_tipo)
            .then(function (response) {
                            
                var period = response.data;
                var select = document.getElementById('filter_esp');
    
                var x;

                if(select.options.length){
                    while (select.options.length > 0) {                
                        select.remove(0);
                    } 
                }

                var opt = document.createElement('option');
                opt.value = '';
                opt.innerHTML = 'Especialización';
                select.appendChild(opt);
                
                for (x in period) {
                    var opt = document.createElement('option');
                    opt.value = period[x].id;
                    opt.innerHTML = period[x].name;
                    select.appendChild(opt);
                }
                
            });
        },
        changeModules(){

            var self = this;

            // Tipo de Especialización
            //axios.get('http://intranetehsq.ehsqgroup.com/api/secretaria-academico/modules/')

            axios.get('http://intranetehsq.ehsqgroup.com/api/secretaria-academico/modules/', {
                params: {
                    id_group: self.filter_group
                }
              })

            .then(function (response) {
                console.log(response);
                var group = response.data.group;
                var period = response.data.data;

                console.log(group);

                self.filter_academic_period = group.id_academic_period;
                self.filter_esp_tipo          = group.cod_esp_tipo;
                self.filter_esp          = group.cod_esp;

                
                var select = document.getElementById('filter_module');

                if(select.options.length){
                    while (select.options.length > 0) {                
                        select.remove(0);
                    } 
                }

                var opt = document.createElement('option');
                opt.value = '';
                opt.innerHTML = 'Especialización';
                select.appendChild(opt);

                

                var x;
                for (x in period) {
                    var opt = document.createElement('option');
                    opt.value = period[x].id;
                    opt.innerHTML = period[x].nombre;
                    select.appendChild(opt);
                }
                
            });
            
        },

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
            
            var data = self.students[index].califications;

            axios.post('http://intranetehsq.ehsqgroup.com/api/secretaria-academico/', {data: data}, headers)
            .then(function (response) {
               self.students[index].edit = false;
               self.message = 'Nota actualizada satisfactoriamente!';
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
            return Math.round(prom);
        },
        listEnrollments(){
            var self = this;

            document.getElementById("buscar").disabled = true;
            document.getElementById("buscar").innerHTML = 'Buscando!';

            axios.get('http://intranetehsq.ehsqgroup.com/api/secretaria-academico', {
                params: {
                    id_academic_period: self.filter_academic_period,
                    id_group: self.filter_group,
                    cod_modulo: self.filter_module,
                    cod_esp_tipo: self.filter_esp_tipo,
                    cod_esp: self.filter_esp
                }
              })
            .then(function (response) {
                self.students = response.data.data;
                self.talleres = response.data.talleres;
                document.getElementById("buscar").disabled = false;
                document.getElementById("buscar").innerHTML = 'Buscar';
            })
            .catch(function (error) {
                console.log(error);
            });
        }
        // Crud de notas,

    }
});