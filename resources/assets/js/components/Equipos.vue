<template>
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <!-- OVERVIEW -->
                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <h3 class="pb-2 display-4">Inventario de Equipos</h3>
                    </div>

                    <div class="modal fade" tabindex="-1"  :class="{'mostrar' : modalImagen}" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mediumModalLabel" v-text="tituloModal"></h5>
                                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group"  >
                                        <center> <h3 v-model="nombre">{{nombre}}</h3></center>
                                        <center><img  :src="imagen" v-model="imagen" class="img-thumbnail"  height="475" width="475" /></center>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cancelar</button>
                                    <button type="button" class="btn btn-primary" v-if="tipoAccion==3" @click="Imagen()">Aceptar</button>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal fade" tabindex="-1"  :class="{'mostrar' : modal}" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mediumModalLabel" v-text="tituloModal"></h5>
                                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" >
                                    <template v-if="listado">
                                        <div class="form-group"  >
                                            <label  class=" form-control-label">Nombre</label>
                                            <input type="text"   v-model="nombre"  name="nombre"  placeholder="Inserta Nombre de Herramienta" class="form-control">
                                            <input type="text" disabled v-if="tipoAccion==3" v-model="nombre"  v-validate="'required'" name="nombre"  placeholder="Inserta Nombre de Cristaleria" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label  class=" form-control-label">Cantidad</label>
                                            <input type="number"   v-model="cantidad" placeholder="Cantidad" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label  class=" form-control-label">Descripcion</label>
                                            <input type="text"  v-model="descripcion" placeholder="Descripcion" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label  class=" form-control-label">Imagen</label>
                                            <input type="file" v-on:change="onImageChange" class="form-control">
                                        </div>
                                        <button  class="btn btn-link" v-if="tipoAccion==2" @click="mostrarDetalle()">Dar de baja</button>
                                        <div class="modal-footer" >

                                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cancelar</button>
                                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="RegistrarEquipos()">Aceptar</button>
                                            <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="ActualizarCategoria()">Actualizar</button>
                                        </div>
                                    </template>

                                    <template v-else>
                                        <h5>Baja de Equipos</h5>
                                        <br>
                                        <div class="form-group">
                                            <label v-if="tipoAccion==2" class=" form-control-label">Alumno</label>
                                            <input type="text" v-if="tipoAccion==2" v-model="alumno" placeholder="Nombre del alumno" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label v-if="tipoAccion==2" class="form-control-label" >Control</label>
                                            <input type="text" v-if="tipoAccion==2" v-model="control" placeholder="Numero de control" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label v-if="tipoAccion==2" class="form-control-label" >Descripcion de dano</label>
                                            <input type="text" v-if="tipoAccion==2" v-model="descripcion_danados" placeholder="Descripcion" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label v-if="tipoAccion==2" class="form-control-label" >Dañados</label>
                                            <input type="text" v-if="tipoAccion==2" v-model="cantidad_danados" placeholder="piezas Dañadas" class="form-control">
                                        </div>
                                        <button  class="btn btn-link" @click="ocultarDetalle()">Volver</button>
                                        <div class="modal-footer" >

                                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cancelar</button>
                                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="RegistrarEquipos()">Aceptar</button>
                                            <button type="button" class="btn btn-danger" v-if="tipoAccion==2" @click="ActualizarCategoria()">Dar de Baja</button>
                                        </div>
                                    </template>


                                </div>

                            </div>

                        </div>
                    </div>


                    <div class="animated fadeIn">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">Registro de Equipos</strong>
                                    </div>

                                    <div class="card-body">
                                        <button type="button" class="btn btn-primary" @click="AbrirModal('equipos','registrar')"><i class="fa fa-plus"></i>
                                            Agregar Equipo
                                        </button>
                                        <div class="col-lg-6">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group-btn">
                                                            <select  class="dropdown-toggle btn btn-primary" v-model="criterio">
                                                                <option class="form-group" value="nombre">Nombre</option>
                                                                <option class="form-group" value="descripcion">Descripcion</option>

                                                            </select>
                                                            <button class="btn btn-primary" @click="listarEquipos(1,buscar,criterio)">
                                                                <i class="fa fa-search"></i> Search
                                                            </button>
                                                        </div>
                                                        <input type="text"  v-model="buscar" @keyup.enter="listarEquipos(1,buscar,criterio)" placeholder="Nombre a buscar" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Descripcion</th>
                                                <th>Imagen</th>
                                                <th>Acciones</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(equipos, index) in arrayEquipos" :key="equipos.id_equipo">
                                                <td v-text="equipos.id_equipo"></td>
                                                <td v-text="equipos.nombre"></td>
                                                <td v-text="equipos.cantidad"></td>
                                                <td v-text="equipos.descripcion"></td>
                                                <td>

                                                    <button  class="btn btn-success" @click="AbrirModal('equipos','actualizarImagen',equipos)">
                                                        Ver Imagen <i class="fa  fa-eye"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button  class="btn btn-warning" @click="AbrirModal('equipos','actualizar',equipos)">
                                                        <i class="fa  fa-pencil"></i>
                                                    </button>

                                                    <template v-if="equipos.id_equipo">
                                                        <button type="button"  class="btn btn-danger" @click="eliminarEquipos(equipos.id_equipo,index)">
                                                            <i class="fa  fa-trash-o"></i>
                                                        </button>
                                                    </template>
                                                </td>

                                            </tr>

                                            </tbody>
                                        </table>
                                        <nav>
                                            <ul class="pagination">
                                                <li class="page-item" v-if="pagination.current_page>1">
                                                    <a href="#" class="page-link" @click.prevent="cambiarPagina(pagination.current_page-1, buscar,criterio)">anterior</a>
                                                </li>
                                                <li class="page-item" v-for="page in pageNumber" :key='page' :class="[page== isActivated? 'active' : '']">
                                                    <a href="#" class="page-link" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page">1</a>
                                                </li>

                                                <li class="page-item" v-if="pagination.current_page<pagination.last_page">
                                                    <a href="#" class="page-link"  @click.prevent="cambiarPagina(pagination.current_page+1,buscar,criterio)">siguiente</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>


                                </div>
                            </div>


                        </div>
                    </div><!-- .animated -->
                </div>
                <!-- END OVERVIEW -->



            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>

</template>

<script>

    export default {
        //Declarar variables
        data(){
            return {
                id: 0,
                listado:1,
                cantidad_danados:'',
                descripcion_danados:'',
                alumno:'',
                control:'',
                nombre: '',
                cantidad: '',
                descripcion: '',
                imagen:'',
                arrayEquipos: [],
                modal: 0,
                tituloModal: '',
                modalImagen: 0,
                tipoAccion: 0,
                errorEquipos: 0,
                errorMostrarMsjEquipos: [],
                pagination :{
                    "total": 0,
                    "per_page": 0,
                    "current_page": 0,
                    "last_page": 0,
                    "from": 0,
                    "to": 0,
                },
                offset:10,
                criterio:'nombre',
                buscar:''
            }
        },
        computed:{
            isActivated:function () {
                return this.pagination.current_page;
            },
            pageNumber:function(){
                if (!this.pagination.to){
                    return[];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1){
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }
                var pagesArray =[];
                while (from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }


        },
        methods: {
            mostrarDetalle(){
                this.listado=0;
            },
            ocultarDetalle(){
                this.listado=1;
            },

            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.imagen = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            listarEquipos(page,buscar,criterio){

                let me =this;
                var url='/equipos?page='+ page + '&buscar='+buscar + '&criterio'+criterio;
                axios.get(url).then(function (response) {
                    var  respuesta=response.data;
                    me.arrayEquipos = respuesta.equipos.data;
                    me.pagination=respuesta.pagination;


                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                me.pagination.current_page=page;
                me.listarEquipos(page,buscar,criterio);

            },
            RegistrarEquipos(){


                let me =this;
                axios.post('/equipos/registrar',{
                    'nombre':this.nombre,
                    'cantidad':this.cantidad,
                    'descripcion':this.descripcion,
                    'imagen':this.imagen


                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEquipos(1,'','nombre' );
                    console.log(response);
                    swal("Exito", "Se inserto correctamente!", "success");
                })
                    .catch(function (error) {
                        console.log("es un error de post");
                    });

            },
            ActualizarCategoria(){

                let me =this;
                axios.put('/equipos/actualizar',{
                    'nombre':this.nombre,
                    'cantidad':this.cantidad,
                    'descripcion':this.descripcion,
                    'imagen':this.imagen,
                    'cantidad_danados':this.cantidad_danados,
                    'descripcion_danados':this.descripcion_danados,
                    'control':this.control,
                    'alumno':this.alumno,
                    'id_equipo': this.id_equipo
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEquipos(1,'','nombre'  );
                    console.log(response);
                    swal("Exito", "Se Actualizo correctamente!", "success");
                })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            eliminarEquipos(id_equipo){
                swal({
                    title: 'Estas seguro?',
                    text: "No podras recuperar la informacin!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, deseo eliminarlo!'
                }).then((result) => {
                    if (result.value) {
                        let me =this;

                        axios.delete('/equipos/'+id_equipo).then(response=>{
                            id:id_equipo
                            console.log(response);
                        }).then(function (response) {
                            me.listarEquipos(1,'','nombre' );
                            swal(

                                'Eliminado!',
                                'Tu fila a sido eliminada.',
                                'success'

                            );
                            console.log(response);
                        })
                            .catch(function (error) {
                                console.log("es un error de post");
                            });


                    }
                });
            },
            DanadosCategoria(){
                let me =this;
                axios.post('/herramienta/danados',{
                    'nombre':this.nombre,
                    'cantidad':this.cantidad_danados,
                    'descripcion':this.descripcion_danados,
                    'alumno':this.alumno,
                    'control':this.control,
                    'imagen':this.imagen
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarHerramientas(1,'','nombre'  );

                    console.log(response);
                    swal("Exito", "Se agrego a Piezas Dañadas correctamente!", "success");
                })
                    .catch(function (error) {
                        console.log(error);
                    });

            },

            desactivarEquipos(id_equipo){
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        let me =this;
                        axios.delete('/equipos/eliminar',{
                            'id':id_equipo
                        }).then(function (response) {
                            me.listarEquipos();
                            swal(

                                'Deleted!',
                                'Your file has been deleted.',
                                'success'

                            )
                        }).catch(function (error) {
                            console.log("es un error de post");
                        });


                    }
                });

            },



            cerrarModal(){
                this.modal=0;
                this.modalImagen= 0;
                this.tituloModal='';
                this.nombre='';
                this.cantidad='';
                this.descripcion='';

            },
            AbrirModal(modelo,accion,data=[]){
                switch (modelo) {
                    case "equipos":
                    {

                        switch (accion) {
                            case "registrar": {
                                this.modal =1;
                                this.tituloModal='Registrar equipos';
                                this.nombre='';
                                this.cantidad='';
                                this.descripcion='';
                                this.tipoAccion =1;
                                break;
                            }

                            case 'actualizar': {
                                this.modal =1;
                                this.tituloModal='Actualizar categoria';
                                this.tipoAccion =2;
                                this.nombre=data['nombre'];
                                this.cantidad=data['cantidad'];
                                this.descripcion=data['descripcion'];
                                this.imagen=data['imagen'];
                                this.id_equipo=data['id_equipo'];
                                break;
                            }
                            case 'actualizarImagen': {
                                this.modalImagen =1;
                                this.tituloModal='Imagen de equipo';
                                this.tipoAccion =2;
                                this.nombre=data['nombre'];
                                this.cantidad=data['cantidad'];
                                this.imagen=data['imagen'];
                                this.descripcion=data['descripcion'];
                                this.id=data['id_equipo'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarEquipos(1,this.buscar,this.criterio);

        }
    }





</script>
<style>
    .mostrar {
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .div-error{
        display:flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight:bold;
    }

</style>
