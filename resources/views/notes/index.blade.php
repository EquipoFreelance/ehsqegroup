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
        <label for="">Grupo: </label>
        <select name="" id="" v-model="filter_group">
            <option value="group1">Grupo  1</option>
        </select>
        <hr>
        <label for="">Modulo:</label>
        <select name="" id="" v-model="filter_module">
            <option value="module1">Modulo 1</option>
        </select>
        <hr>
        <label for="">DNI:</label>
        <input type="text" v-model="filter_dni">
        <label for="">Apellidos</label>
        <input type="text" v-model="filter_fullname">

        <button type="button" @click="filterStudents">Buscar</button>
    </div>

    <div>
        <h2>Notas</h2>
        <table>
        <tr>
            <td>Alumnos</td>
            <template v-for="(taller, index) in talleres.num_taller">
                <td>Taller @{ index + 1 }</td>
            </template>
            <td>Examen</td>
            <td>Promedio</td>
            <td>Acciones</td>
        </tr>
        <tr v-for="(student, index) in students">
            <td>@{ student.enrollment + '-' +student.fullname }</td>
            <template v-for="calification in student.califications">
                <td>
                    <input type="text" :value="calification.value" v-model="calification.value" v-if="student.edit == true" />
                    @{ calification.value }
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

    <div>
        <button type="button">Guardar</button>
    </div>

    <pre>
    @{ $data | json }
    </pre>
</div>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.17.0/axios.min.js"></script>
    <script src="/assets/js/app/main.js"></script>
</body>
</html>