<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
<div id="main">
    <div>
        <!--<label for="">Periodo académico: </label>
        <select name="" id="filter_academic_period" v-model="filter_academic_period">
            <option value="26"> 26</option>
            <option value="" disabled="disabled"> Periodo academico </option>
        </select>
        <hr>-->
        <!--<label for="">Tipo de Especialización: </label>
        <select name="" id="filter_esp_tipo" v-model="filter_esp_tipo" @change="changeSpecializaciones">
            <option value="" disabled="disabled">Tipo de especialización</option>
            <option value="12"> 12 </option>
        </select>
        <hr>
        <label for="">Especialización: </label>
        <select name="" id="filter_esp" v-model="filter_esp" >
            <option value="" disabled="disabled">Especialización</option>
            <option value="60"> 60 </option>
        </select>
        <hr>
        -->
        <label for="">Grupo: </label>
        <select name="" id="filter_group" v-model="filter_group" @change="changeModules">
            <option value="" disabled="disabled"> Grupo </option>
            <!--<option value="26"> 26</option>-->
        </select>
        <hr>

        <label for="">Modulo:</label>
        <select name="" id="filter_module" v-model="filter_module">
            <option value="" disabled="disabled">Modulo</option>
            <!--<option value="38"> 38 </option>-->
        </select>
        <!--<hr>
        <label for="">DNI:</label>
        <input type="text" v-model="filter_dni">
        <label for="">Apellidos</label>
        <input type="text" v-model="filter_fullname">-->

        <button type="button" id="buscar" @click="listEnrollments">Buscar</button>
    </div>

    <div>
        <h2>Notas</h2>
        <span v-if="message!= ''">@{ message }</span>
        <table>
        <tr v-if="students != ''">
            <td>Alumnos</td>
            <template v-for="(taller, index) in talleres.num_taller">
                <td>Taller @{ index + 1 }</td>
            </template>
            <td>Examen</td>
            <td>Promedio</td>
            <td>Acciones</td>
        </tr>
        <tr v-for="(student, index) in students">
            <td>@{ student.dni + '-' +student.fullname }</td>
            <template v-for="calification in student.califications">
                <td>
                    <input type="text" :value="calification.value" v-model="calification.value" v-if="student.edit == true" />
                    <span v-else>@{ calification.value }</span>
                </td>
            </template>
            <td>@{ calculateProm(student.califications, student.enrollment) }</td>
            <td>
                <span v-if="student.edit == true">
                    <a href="#" @click="doneNotes(index)">Guardar</a>
                    <a href="#" @click="cancelEditNotes(index)">Cancelar</a> 
                </span>
                <span v-else>
                    <a href="#" @click="editNotes(index)">Editar</a>
                </span>
            </td>
        </tr>
        </table>
    </div>

    <!--<pre>
    @{ $data | json }
    </pre>-->
</div>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.17.0/axios.min.js"></script>
    <script src="/assets/js/app/main.js"></script>
</body>
</html>