<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <title>Notas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div id="main" class="container">

<div class="field">
  <label class="label">Grupo</label>
  <div class="control">
    <div class="select is-fullwidth">
        <select name="" id="filter_group" v-model="filter_group" @change="changeModules">
            <option value="" disabled="disabled"> Grupo </option>
        </select>
    </div>
  </div>
</div>

<div class="field">
  <label class="label">Modulo</label>
  <div class="control">
    <div class="select is-fullwidth">
        <select name="" id="filter_module" v-model="filter_module">
            <option value="" disabled="disabled">Modulo</option>
        </select>
    </div>
  </div>
</div>

<div class="field is-grouped">
  <div class="control">
    <button type="button" class="button is-primary" id="buscar" @click="listEnrollments">Buscar</button>
  </div>
</div>





        <!--<hr>
        <label for="">DNI:</label>
        <input type="text" v-model="filter_dni">
        <label for="">Apellidos</label>
        <input type="text" v-model="filter_fullname">-->



    <div>
        <h2><b>Notas</b></h2><br>
        <span v-if="message!= ''">@{ message }</span>
        <table class="table is-bordered is-striped is-narrow is-fullwidth">
        <tr v-if="students != ''">
            <th>Alumnos</th>
            <template v-for="(taller, index) in talleres.num_taller">
                <th>Taller @{ index + 1 }</th>
            </template>
            <th>Examen</th>
            <th>Promedio</th>
            <th>Acciones</th>
        </tr>
        <tr v-for="(student, index) in students">
            <td>@{ student.fullname }</td>
            <template v-for="calification in student.califications">
                <td>
                    <input type="text" :value="calification.value" v-model="calification.value" v-if="student.edit == true" class="input" />
                    <span v-else>@{ calification.value }</span>
                </td>
            </template>
            <td>@{ calculateProm(student.califications, student.enrollment) }</td>
            <td align="center">
                <center>
                    <span v-if="student.edit == true">
                        <a href="#" @click="doneNotes(index)"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>
                        <a href="#" @click="cancelEditNotes(index)"><i class="fa fa-times" aria-hidden="true"></i></a> 
                    </span>
                    <span v-else>
                        <a href="#" @click="editNotes(index)"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </span>
                </center>
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