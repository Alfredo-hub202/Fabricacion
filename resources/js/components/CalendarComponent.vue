<template>
  <div class="container-fluid">

<div class="row">
         <div class="col-md-2">
                <label for="status"><h4>Sección</h4></label>
                <select class="form-control" required 
                v-model="selectedAgrupacion"
                >
                    <option value=''><h4>Selecciona Sección</h4></option>
                    <option :value="seccion.id" v-for="seccion in secciones" :key="seccion.id" >{{ seccion.seccion }}</option>
                </select>
            </div>

         <div class="col-md-2">
                <label><h4>Agrupación</h4></label>
        
                <select
                    class="form-control"
                   required 
                   v-model="selectedEquipo"
                  :disabled="selectedAgrupacion == 0"
                > 
                    <option value='' >Selecciona la Agrupación</option>
                    <option v-for="agrupacion in agrupaciones" :key="agrupacion.id" :value="agrupacion.id">{{ agrupacion.nombre }}</option>
                </select>
            </div>

                <div class="col-md-2">
                <label for="status"><h4>Equipo</h4></label>
                <select
                    class="form-control"
                v-model="selected"
                   
                   :disabled="selectedEquipo == 0 "
                   
                > 
                    <option value='' >Selecciona un Equipo</option>
                    <option v-for="equipo in equipos" :key="equipo.id" :value="equipo.id">{{ equipo.equipo }}</option>
                </select>
            </div>
                   <div class="col-md-2">  
          <label for="equipo" ><h4>Tipo Parte</h4></label>
  <select id="locationList" class="custom-select"  v-model="selectedTipo">
        <option  value='' >Todos</option>
        <option v-for="evento in filteradTipo_necesidad" :value="evento.tipo_necesidad" :key="evento.id" :v-bind="evento">
        {{ evento.tipo_necesidad }}
    </option>
  </select>
  </div>
     <div class="row-12">
 
   <button  v-if="selectedEquipo != 0"  type="button" class="btn btn-danger" v-on:click="onClick">Reiniciar Filtro</button>

  </div>
  </div>

  <!-- <div class="col-6">
    <h2>Seccion seleccionado:</h2>
    
    {{selectedSession}}
</div>

<div class="col-6">
    <h4>Agrupacion seleccionado:</h4>
    {{fetchSeccion}}
</div> -->
    <!-- <input type="button" onclick="resetselect()" value="Reiniciar"> -->

<br>
<!-- Modal de Leyenda Equipos -->
<div class="modal fade" id="leyenda" tabindex="-1" role="dialog" aria-labelledby="leyenda" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Leyenda Equipos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

   <div id='league-table' class='table-responsive'>
        <table class=' table table-striped my-tbody'>
          <thead>
            <th class='col-xs-2'>Equipos</th>
            <th class='col-xs-2'>Color</th>
            <th></th>
          </thead>

          <tbody>
            <tr v-for='league in filteradEquipo' :key="league.id">
                  
              <td class='team-roster-table__number'>{{ league.equipo }}</td>
              <td class='team-roster-table__number' :bgcolor="league.color"></td>
            </tr>
          </tbody>
        </table>
      </div>
 <div class="modal-footer">          
              <div class="col-md-6 mb-4">
                <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
              </div>
         
      </div>
    </div>
  </div>
</div>
</div>

    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" id="exampleModal" data-target="#staticBackdrop2" disabled>
  Nueva Fabricación
</button>

<div   class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
 <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Detalle de la Fabricación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
        <form @submit.prevent>
          <!-- <div class="form-group">
            
            <label for="equipo">Equipo</label>
            <input type="text" id="equipo" class="form-control" v-model="updateEvents.equipo" data-toggle="tooltip" title="Ingresa nombre del Equipo" required>
             
          </div> -->
           <!-- <div class="form-group">
            <label for="cod_equipo"> Codigo Equipo</label>
            <input type="text" id="cod_equipo" class="form-control" v-model="updateEvents.cod_equipo" required>
          </div> -->

      

             <div class="form-group">
            <label for="articulo_codigo"> Codigo Articulo</label>
            <input type="text" id="articulo_codigo" class="form-control" v-model="updateEvents.articulo_codigo" required>
          </div>
           <div class="form-group">
            <label for="articulo_nombre"> Nombre Articulo</label>
            <input type="text" id="articulo_nombre" class="form-control" v-model="updateEvents.articulo_nombre" required>
          </div>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="unidades_fabricar">Unidades a Fabricar</label>
                  <input type="number" min="0"  pattern="^[0-9]+" id="NumberFormat" class="form-control" v-model="updateEvents.unidades_fabricar" required>
              

              </div>
            </div>

   <div class="col-md-3">
              <div class="form-group">
                <label for="articulo_marca">Marca</label>
                <select id="locationList" class="custom-select" v-model="firstOption">
                  <option value="0">Selecciona una Marca</option>
                  <option v-for="(item, index) in list" :key="index" :value="index" :v-model="updateEvents.unidades_fabricar">{{ index }}</option>
                </select>
              </div>
            </div>
  
               <div class="col-md-3">
              <div class="form-group">
                <label for="articulo_marca" v-if="firstOption !== 0 || firstOption !== 1">Gama</label>
                <select id="locationList" class="custom-select" v-model="secondOption" v-if="firstOption != 0 && firstOption != 1" >
                  <option value="0">Selecciona Gama</option>
                  <option v-for="option in list[firstOption]" value="option.codigo" :key="option.id">{{option.marca}}</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="articulo_marca" v-if="secondOption != 0 && firstOption != 1" >Articulo</label>
                  <select id="locationList" class="custom-select"  v-model="threeOption" v-if="secondOption != 0">
                    <option value="0">Selecciona Articulo</option>
                    <option v-for="option in list[firstOption]" value="option.articulo" :key="option.id">{{option.articulo}}</option>
                  </select>
              </div>
            </div>
  
            <div class="col-md-3">
              <div class="form-group">
                <label for="articulo_marca">Articulo Marca</label>
                  <input type="text" id="articulo_marca" class="form-control" v-model="updateEvents.articulo_marca" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="gama">Gama</label>
                  <input type="text" id="gama" class="form-control" v-model="updateEvents.gama" required>
              </div>
            </div>

          </div>

                    <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="horas_necesarias">Horas Necesarias</label>
                  <input type="text" id="horas_necesarias" class="form-control" v-model="updateEvents.horas_necesarias" required>
              </div>
            </div>
          
                  <div class="col-md-3">
                <div class="form-group">
                  <label for="seccion">Tipo Necesidad</label>
                    <select name="refer" class="form-control" id="refre" v-model="updateEvents.tipo_necesidad">
                          <option value="En Partes Fab.">En Partes Fab.</option>
                          <option value="En Partes Planificados">En Partes Planificados</option>
                      </select>          
                </div>
            </div>
             <div class="col-md-3">
                <div class="form-group">
                  <label for="seccion">Recurso</label>
                    <select name="refer" class="form-control" id="refre" v-model="updateEvents.recurso_id">
                          <option value=1>INTERNO</option>
                          <option value=96>EXTERNO</option>
                     
                      </select>          
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group">
                  <label for="seccion">seccion</label>
                    <select name="refer" class="form-control" id="refre" v-model="updateEvents.seccion">
                          <option value="SECCION PROCESO DE FABRICACIón">SECCION PROCESO DE FABRICACION</option>
                          <option value="SECCION DOCIFICADO">SECCION DOCIFICADO</option>
                          <option value="SECCION ACONDICIONADO">SECCION ACONDICIONADO</option>
                      </select>          
                </div>
            </div>

          </div>


          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="fecha_compromiso_fab">Fecha Compromiso Fab</label>
                <input
                  type="date"
                  id="fecha_compromiso_fab"
                  class="form-control"
                  v-model="updateEvents.fecha_compromiso_fab"
                  required
                >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="fecha_fab_2t">Fecha de Compromiso de Fab 2 tiempo</label>
                <input type="date" id="fecha_fab_2t	" class="form-control" v-model="updateEvents.fecha_fab_2t" required>
              </div>
            </div>

          </div>
        </form>
      </div>
      </div>
      <div class="modal-footer">
                    <div class="col-md-6 mb-4">
              <button class="btn btn-sm btn-primary" @click="addNewEvent" data-dismiss="modal">Guardar Evento</button>
               <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div   class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
 <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Detalle de la Fabricación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
        <form @submit.prevent>
           <div class="form-group">
            <label for="equipo">Pedido</label>
            <input type="text" id="equipo" class="form-control" v-model="newEvent.pedido" data-toggle="tooltip" title="Ingresa nombre del Equipo" disabled>
          </div>
          <div class="form-group">
            <label for="equipo">Equipo</label>
            <input type="text" id="equipo" class="form-control" v-model="newEvent.equipo" data-toggle="tooltip" title="Ingresa nombre del Equipo" disabled>
          </div>

             <div class="form-group">
            <label for="articulo_codigo"> Codigo Articulo</label>
            <input type="text" id="articulo_codigo" class="form-control" v-model="newEvent.articulo_codigo" disabled>
          </div>
           <div class="form-group">
            <label for="articulo_nombre"> Nombre Articulo</label>
            <input type="text" id="articulo_nombre" class="form-control" v-model="newEvent.articulo_nombre" disabled>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="unidades_fabricar">Unidades a Fabricar</label>
                  <input type="number" id="NumberFormat" class="form-control" v-model="newEvent.unidades_fabricar" disabled>
                   
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="articulo_marca">Articulo Marca</label>
                  <input type="text" id="articulo_marca" class="form-control" v-model="newEvent.articulo_marca" disabled>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="gama">Gama</label>
                  <input type="text" id="gama" class="form-control" v-model="newEvent.gama" disabled>
              </div>
            </div>

          </div>
                    <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="horas_necesarias">Horas Necesarias</label>
                  <input type="text" id="horas_necesarias" class="form-control" v-model="newEvent.horas_necesarias" disabled>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="tipo_necesidad">Tipo Necesidad</label>
                  <input type="text" id="tipo_necesidad" class="form-control" v-model="newEvent.tipo_necesidad" disabled>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="seccion">seccion</label>
                  <input type="text" id="seccion" class="form-control" v-model="newEvent.seccion_id" disabled>
              </div>
            </div>
              <div class="col-md-4">
              <div class="form-group">
                <label for="seccion">Agrupacion</label>
                  <input type="text" id="agrupacion" class="form-control" v-model="newEvent.agrupacion_id" disabled>
              </div>
            </div>

          </div>


          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="fecha_compromiso_fab">Fecha Compromiso Fab</label>
                <input
                  type="date"
                  id="fecha_compromiso_fab"
                  class="form-control"
                  v-model="newEvent.fecha_compromiso_fab"
                  required
                >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="fecha_fab_2t	">fecha_fab_2t</label>
                <input type="date" id="fecha_fab_2t	" class="form-control" v-model="newEvent.fecha_fab_2t" required>
              </div>
            </div>

          </div>
        </form>
      </div>
      </div>
      <div class="modal-footer">
                    <div class="col-md-6 mb-4" v-if="addingMode">
              <button class="btn btn-sm btn-primary" @click="addNewEvent" data-dismiss="modal">Guardar Evento</button>
               <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            <template v-else>
              <div class="col-md-6 mb-4">
                <button class="btn btn-sm btn-success btn-secondary" @click="updateEvent" data-dismiss="modal">Modificar</button>
                <button class="btn btn-sm btn-danger btn-secondary" @click="deleteEvent" data-dismiss="modal">Eliminar</button>
                <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
            </template>
      </div>
    </div>
  </div>
</div>

    <div class="row justify-content-center">
      
      <div class="col-md-8 py-5">
        <Fullcalendar  
            @eventClick="showEvent"  
            :eventLimit="8"    
            :weekends="true"   
            locale="es"
            :selectable="true"
            :editable="true"
            :header="header" 
            :buttonText="buttonText"
            :plugins="calendarPlugins"
            :events="computed_events"
            @eventResize="updateEventDrop"
            @eventDrop="updateEventDrop"
            @eventRender="renderEvent"
            
        
          

          
         />
  <!-- @eventRender="eventDidMount"    -->
    <!-- @eventRender="renderEvent" -->
      </div>
    <div>
           <button type="button" class="btn btn-primary" data-toggle="modal" id="leyenda" data-target="#leyenda" v-if="selectedEquipo != 0">
  Leyenda de Equipos
</button>
    </div>
</div>
  </div>
</template>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
 
<script>

import Fullcalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import ListPlugin from '@fullcalendar/list'
import InteractionPlugin from '@fullcalendar/interaction'
import * as moment from "moment/moment";

import axios from "axios";
 

export default {
  components: {
    Fullcalendar,moment
  },
  
  data() {
    return {
      calendarPlugins: [ dayGridPlugin,ListPlugin,InteractionPlugin],
      defaultView: 'timeGridWeek',
      editable: true,
      allDay: false,
      showModal: false,
  

events: [],
equipos:'',
secciones:{},
agrupaciones:{},

     

		selected:{
			event:'',

  },
  customRender: true,

  header: {
                    left: 'prev, next today',
                    center: 'title',
                    defaultView: 'dayGridMonth',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay,list,timeGridDay',
                    selectable: true,
                    buttonIcons: false, // show the prev/next text
                    weekNumbers: true,
                    eventLimit: 6,// adjust to 6 only for timeGridWeek/timeGridDay
                    navLinks: true, // can click day/week names to navigate views
                    month: 'long',
                    year: 'numeric',
                    day: 'numeric',
                    locale: 'es',
                    allDaySlot: false



                },

  buttonText:{
            today: 'Hoy',
            month: 'mes',
            week: 'semana',
            day: 'día',
            list:'listado',
        allDaySlot: false


            
            },


      newEvent: {

       fecha_compromiso_fab: "",
        fecha_fab_2t: "",
        articulo_codigo: "",
        articulo_nombre:"",
        unidades_fabricar:"",
        pais:"",
        gama:"",
        articulo_marca:"",
        tipo_necesidad:"",
        horas_necesarias:"",
        seccion_id:"",
        agrupacion_id: "",
      },


       newEventDrop: {

        fecha_compromiso_fab:  "",
        fecha_fab_2t:  "",
 
      },


        updateEvents: {
        equipo: "",
        fecha_compromiso_fab: "",
        fecha_fab_2t: "",
        articulo_codigo: "",
        articulo_nombre:"",
        unidades_fabricar:"",
        pais:"",
        gama:"",
        articulo_marca:"",
        tipo_necesidad:"",
        horas_necesarias:"",
        _id:"",
        recurso_id:"",
      },

    selectedEquipo: '',
    selectedSession: '',
    selectedAgrupacion: '',

    selectedTipo:'',
    selectedRecurso:'',
    selected: '',
      addingMode: true,
      indexToUpdate: "",
     firstOption: null,
    secondOption: null,
    threeOption: null,
    selectAgrupaciones:'',
    agrupaOption: null,
    equipoOption: null,
    list: {
      '01-CLEARE': [
         {codigo:'3', marca:'CLEARE ANTICASPA',articulo:'CLEARE CAMOMILA ECO SPRAY 125 ML.'},
        {codigo:'3', marca:'CLEARE ANTIEDAD',articulo:'CLEARE CAMOMILA SPRAY PROMOCION 125ML.'},
        {codigo:'3', marca:'CLEARE CAMOMILA',articulo:'CLEARE CAMOMILA ECO CHAMPU 400 ML.'},
        
      ],
        '02-ATASHI': [
         {codigo:'3', marca:'ATASHI SENSORIAL',articulo:'ATASHI COFRE PRIMAVERA 2008'},
        {codigo:'3', marca:'ATASHI CELLULAR',articulo:'ATASHI CELLULAR COSMETICS REPARADORA ANTIARRUGAS'},
        {codigo:'3', marca:'ATASHI EDELWEISS',articulo:'ATASHI CELLULAR PSS TERAPIA HIDRATACION INTENSA REGENERANTE'},
        
      ],
        '03-ELIFEXIR': [
         {codigo:'3', marca:'ELIF. DEV. REF ANTIGUAS',articulo:'PACK V.PLANO ACTIV CREMA + MINUCELL CREM'},
        {codigo:'3', marca:'ELIFEXIR DERMO',articulo:'ELIFEXIR VIENTRE PLANO ACTIV 30 COMP.'},
        {codigo:'3', marca:'ELIFEXIR SALUD',articulo:'ELIFEXIR BODYSUN 30 PERLAS'},
        
      ],

        '04-VOLUMAX': [
         {codigo:'3', marca:'VOLUMAX. DEV. REF ANTIGUAS',articulo:'197897 LIPFRUITS FRUTAS DEL BOSQUE'},
        {codigo:'3', marca:'VOLUMAX TRIACTIVE',articulo:'COFRE VOLUMAX TRIACTIVE+PASHMINA 2007'},
        {codigo:'3', marca:'VOLUMAX REDEFINITION',articulo:'VOLUM. FRUITGLOSS FRESA-NATA 15 ML.'},
        
      ],

          '05-DR. TREE': [
         {codigo:'3', marca:'DR. TREE',articulo:'DR. TREE GEL DE DUCHA 500 ML.'},
        {codigo:'3', marca:'05-DR. TREE',articulo:'DR. TREE CREMA ACONDICIONADORA 150 ML.'},
        {codigo:'3', marca:'DR. TREE',articulo:'DR. TREE CHAMPU SOLIDO COSMOS USO FRECUENTE'},
        
      ],

          '06-OTRAS MARCAS': [
         {codigo:'3', marca:'NETISUM',articulo:'EXPOSITOR CON PRODUCTO NETISUM FORTE'},
        {codigo:'3', marca:'OTRAS',articulo:'BRONCOFORMO MUCO-DEXA 200 ML.'},
        {codigo:'3', marca:'RESALIM',articulo:'RESALIM 10 UDS.'},
        
      ],

          '07-DESCATALOGADO': [
         {codigo:'3', marca:'DESCATALOGADO',articulo:'SECREPAT MENTA 50 COMPRIMIDOS'},
        {codigo:'3',  marca:'DESCATALOGADO',articulo:'TAURITON 30 CAPSULAS'},
        {codigo:'3',  marca:'DESCATALOGADO',articulo:'INNOVAGE TRAT.ALISADOR CUTANEO+HYDRALIFT'},
        
      ],

    
      '08-NATURTINT': [{size:'3', marca:'8',articulo:'hola'}],
      '09-YACEL': [
        {codigo:'3', marca:'CLEARE ANTICASPA',articulo:'hola'},
        {codigo:'3', marca:'CLEARE ANTIEDAD',articulo:'hola'},
        {codigo:'3', marca:'CLEARE CAMOMILA',articulo:'hola'},
        
        
        ]
    }
    };
   
    

  },

  watch: {
        selectedAgrupacion : function(value){
            axios.get('/api/agrupaciones?seccion_id=' + this.selectedAgrupacion)
            .then(response => {
              // console.log(response.data.data);
                this.agrupaciones = response.data.data;
              
            });
        },
        selectedEquipo : function(value){
            axios.get('/api/equipos?agrupaciones_id=' + this.selectedEquipo)
            .then(response => {
            // console.log(response.data);
                this.equipos = response.data.data;
            });
        },
      indexToUpdate() {
      return this.indexToUpdate;
      
    }
  },

  mounted(){
         axios.get('/api/secciones')
        .then(response => {
            this.secciones = response.data.data;
            this.equipos = this.agrupaciones = '';
        });
  
    },


    

    
  created() {

    this.getEvents();

  },


   computed: {
  
      filteradSeccion() {
        
  return _.uniqBy(this.events, function(u) {
    return u.seccion_id;
    
  });
},

      filteradAgrupacion() {  
  return _.uniqBy(this.events ,function(u) {

  return u.agrupacion_id;
  
  });
},
   filteradEquipo() {
       
  return _.uniqBy(this.equipos, function(u) {
    return u.equipo;
    
  });
  },
      filteradRecurso() {
        
  return _.uniqBy(this.events, function(u) {
    return u.recurso;
  });
},
      filteradTipo_necesidad() {
        
  return _.uniqBy(this.events, function(u) {
    return u.tipo_necesidad;
    
  });
},


 uniqueNames: function() {
          var filtered_array = [];
          for(var i =0; i < this.events.length; i++) {
            if(filtered_array.indexOf(this.events[i].equipo) === -1) {
              filtered_array.push(this.events[i].equipo)
            }
          }
              
        return filtered_array;

   
        },

    uniqueNames2: function() {
          var filtered_array = [];
          for(var i =0; i < this.events.length; i++) {
            if(filtered_array.indexOf(this.events[i].equipo) === -1) {
              filtered_array.push(this.events[i].equipo)
            }

          }
              
        return filtered_array ;

   
        },

         computed_events: function () {
          
      let filterEquipo= this.selectedEquipo,
          filterSession = this.selectedAgrupacion,
          selected = this.selected,
          selectedTipo =this.selectedTipo,
          selectedRecurso= this.selectedRecurso


      return this.events.filter(function(event){
     
            
        let filtered = true

        if(selected > 0){ 
            
          filtered = event.equipo_id == selected
     
        }
        if(filtered){
          if(filterSession > 0){
            filtered = event.seccion_id == filterSession
          }
        }
        if(filtered){
          if(filterEquipo > 0){
            filtered = event.agrupacion_id == filterEquipo
          //  console.log(filtered)
          }
        }

        if(filtered){
          if(selectedTipo && selectedTipo.length > 0){
              
              filtered = event.tipo_necesidad == selectedTipo
          }
        }
        
        return filtered
      })
    }, 
  
  },

  methods: {


 
renderEvent: function (info) {
  console.log(info.event)
     info.el.querySelector('.fc-title').innerHTML = "<i> " + info.event.title + " <br>  Unidades de Fabricación " + info.event.extendedProps.unidades_fabricar + " <br> Equipo " + info.event.extendedProps.equipos.equipo + "</i>";
    //  info.el.querySelector('.fc-title').innerHTML = "<i>"  + info.event.extendedProps.unidades_fabricar+"</i>";
      },

NumberFormat(x){

    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

},

// Calcularhoras(){
//   console.log("prueba");
//   var fecha1 = moment('2016-07-12');
//   var fecha2 = moment('2016-07-13');
// var dur = moment.duration(8, 'hours');
// var hours = Math.floor(dur.asHours());
// console.log(hours, 'horas de dia ')
// moment('2016-03-12 13:00:00').add(24, 'hours').format('LLL')

//  var h= fecha2.diff(fecha1, 'years') 
// console.log(h, ' horas de diferencia');

// },


    addNewEvent() {
      axios
        .post("/api/calendar", {
          ...this.updateEvents
        })
        .then(data => {
          this.getEvents(); // update our list of events
          this.resetForm(); // clear newEvent properties (e.g. title, start_date and end_date)



        })
        .catch(err =>
          console.log("Unable to update event!", err.response.data)
        );

         $('#staticBackdrop2').modal('show');

        $("#staticBackdrop2 form").validate({
                rules: {
                        Name: {
                                required: true,
                                minlength: 2
                 },
                        Email: {
                                required: true,
                                minlength: 5
                 },
                        Phone: {
                                required: true,
                                minlength: 12
                 }
                },

                submitHandler: function(form) {
            $.ajax({
                url: './pay-vip.php',
                type: 'POST',
                data: $(form).serialize(),
                success: function(response) {
                    location.replace(location + "pay-vip.php");
                    alert("Send mail")
                }            
            });
          }
        });

    },
    showEvent(arg) {
      
      this.addingMode = false;
      const { 
        id, 
      equipo,
      nom_equipo, 
      start, 
      end , 
      codigo_articulo, 
      articulo_nombre,
      unidades_fabricar,
      pais,
      gama,
      articulo_marca,
      horas_necesarias,
      tipo_necesidad,
      seccion,
      recurso_id,
      pedido,
      agrupacion_id} = this.events.find(
        event => event.id === +arg.event.id
      );
      this.indexToUpdate = id;
                function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}
      this.newEvent = {
        // nom_equipo: nom_equipo,
        // equipo: equipo,
        fecha_compromiso_fab: formatDate(start),
        articulo_codigo:codigo_articulo,
        fecha_fab_2t:formatDate(end),
        articulo_nombre:articulo_nombre,
        unidades_fabricar:unidades_fabricar,
        pais:pais,
        gama:gama,
        pedido:pedido,
        articulo_marca:articulo_marca,
        tipo_necesidad:tipo_necesidad,
        horas_necesarias:horas_necesarias,
        seccion:seccion,
        agrupacion_id:agrupacion_id,
        // recurso_id:recurso_id,
      };

      //   this.newEventDrop = {
      //   fecha_compromiso_fab: newEventDrop(start),
      //   fecha_fab_2t: newEventDrop(end),

      // };

      
      $('#staticBackdrop').modal('show');
      // console.log("abrir Modal",'#staticBackdrop');


      this.showModal = true;
     
    },



    
    updateEvent() {
      axios
        .put("/api/calendar/" + this.indexToUpdate, {
          ...this.newEvent
        })

     
        // console.log(this.newEvent)
        .then(resp => {
          this.resetForm();
          this.getEvents();
          this.addingMode = !this.addingMode;
        
            return view('CalendarComponent');


        })
        .catch(err =>
          console.log("Unable to update event!", err.response.data)
        );
    },

    updateEventDrop(arg) {
      axios
        .put("/api/calendar/" + this.indexToUpdate, {
          ...this.newEventDrop
        })
        
      //      console.log(this.convert(arg.event.start))

      // console.log(arg)
        .then(resp => {
          this.resetForm();
          this.getEvents();
          this.addingMode = !this.addingMode;
            return view('CalendarComponent');

        })
        .catch(err =>
          console.log("Unable to update event!", err.response.data)
        );
    },
      convert(str) {
  var date = new Date(str),
    mnth = ("0" + (date.getMonth() + 1)).slice(-2),
    day = ("0" + date.getDate()).slice(-2);
  return [date.getFullYear(), mnth, day].join("-");
  
},

    deleteEvent() {
      axios
        .delete("/api/calendar/" + this.indexToUpdate)
        .then(resp => {
          this.resetForm();
          this.getEvents();
          
          this.addingMode = !this.addingMode;
        })
        .catch(err =>
          console.log("Unable to delete event!", err.response.data)
        );
    },
    getEvents() {
   
      axios.get("/api/calendar")
        .then((resp) => {
          // console.log( resp.data );
          this.events = resp.data.data;
          // console.log(events);
          })
        .catch(err => console.log(err.response.data));
              //  console.log("carga de Dato")
   
    },
    
    resetForm() {
      Object.keys(this.updateEvents).forEach(key => {
        return (this.updateEvents[key] = "");
      });
      
      
    },
    resetFormUpdate() {
      Object.keys(this.newEvent).forEach(key => {
        return (this.newEvent[key] = "");
      });
      
      
    },
         onClick: function (event) {
            
            this.selectedAgrupacion = '0';
            this.selectedEquipo =' 0';
            this.selected = '0';

    
        },
        
    
  },
  

};
</script>

<style lang="css">
@import "~@fullcalendar/core/main.css";
@import "~@fullcalendar/daygrid/main.css";

.fc-title {
  color: #fff;
}

.fc-title:hover {
  cursor: pointer;
}
.my-tbody {
  height: 500px;
  display:block;
  overflow-y:scroll;
  width: 100%;
}
.my-tooltip {
    display: none;
}
 
.my-tooltip-active {
    display: block;
}


</style>