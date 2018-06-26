<template>
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <!-- OVERVIEW -->
                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <h3 class="panel-title">Registro de Herramientas</h3>
                        <p class="panel-subtitle">Period: Oct 14, 2018 - Oct 21, 2018</p>
                    </div>
                    <button type="button" class="btn btn-secondary mb-1" @click="AbrirModal('herramienta','registrar')"><i class="fa fa-plus"></i>
                        Agregar
                    </button>
                    <div class="modal fade" tabindex="-1"  :class="{'mostrar' : modal}" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mediumModalLabel" v-text="tituloModal"></h5>
                                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label  class=" form-control-label">Nombre</label>
                                        <input type="text"   v-model="nombre" placeholder="Inserta Nombre de Herramienta" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label  class=" form-control-label">Cantidad</label>
                                        <input type="number"  v-model="cantidad" placeholder="Cantidad" class="form-control">
                                    </div>
                                    <div v-show="errorHerramienta" class="form-group row  div-error">
                                        <div class="text-center">
                                            <div v-for="error  in errorMostrarMsjHerramienta" :key="error" v-text="error">

                                            </div>

                                        </div>

                                    </div>
                                </div>


                                <div class="modal-footer">
                                    
                                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cancelar</button>
                                    <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="RegistrarHerramientas()">Aceptar</button>
                                    <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="ActualizarCategoria()">Actualizar</button>


                                </div>


                            </div>

                        </div>
                    </div>

                    <div class="animated fadeIn">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">Data Table</strong>
                                    </div>
                                    <div class="card-body">

                                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Descripcion</th>
                                                <th>Acciones</th>
                                                <th>Estado</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(herramienta, index) in arrayHerramienta" :key="herramienta.id_herramienta">
                                                <td v-text="herramienta.id_herramienta"></td>
                                                <td v-text="herramienta.nombre"></td>
                                                <td v-text="herramienta.cantidad"></td>
                                                <td></td>
                                                <td>
                                                    <button  class="btn btn-warning" @click="AbrirModal('herramienta','actualizar',herramienta)">
                                                        <i class="fa  fa-pencil"></i>
                                                    </button>

                                                <template v-if="herramienta.id_herramienta">
                                                    <button type="button"  class="btn btn-danger" @click="eliminarHerramienta(herramienta.id_herramienta,index)">
                                                        <i class="fa  fa-trash-o"></i>
                                                    </button>
                                                </template>
                                                </td>
                                                <td>Altas y bajas</td>
                                            </tr>

                                            </tbody>
                                        </table>
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
                nombre: '',
                cantidad: '',
                arrayHerramienta: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorHerramienta: 0,
                errorMostrarMsjHerramienta: []


            }
        },
        methods: {

          listarHerramientas(){

              let me =this;
              axios.get('/herramienta').then(function (response) {
                    me.arrayHerramienta = response.data;
                      console.log(response);

                  })
                  .catch(function (error) {
                      console.log(error);
                  });
          },
            RegistrarHerramientas(){
                if (this.ValidarHerramientas()==0){
                    return;
                }

                let me =this;
                axios.post('/herramienta/registrar',{
                    'nombre':this.nombre,
                    'cantidad':this.cantidad
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarHerramientas();
                    console.log(response);
                    swal("Exito", "Se inserto correctamente!", "success");
                })
                    .catch(function (error) {
                        console.log("es un error de post");
                    });

            },
            ActualizarCategoria(){

                let me =this;
                axios.put('/herramienta/actualizar',{
                    'nombre':this.nombre,
                    'cantidad':this.cantidad,
                    'id_herramienta': this.id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarHerramientas();
                    console.log(response);
                    swal("Exito", "Se Actualizo correctamente!", "success");
                })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            eliminarHerramienta(id_herramienta){
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

                        axios.delete('/herramienta/'+id_herramienta).then(response=>{
                           id:id_herramienta
                            console.log(response);
                        }).then(function (response) {
                            me.listarHerramientas();
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

            desactivarHerramienta(id_herramienta){
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
                        axios.delete('/herramienta/eliminar',{
                             'id':id_herramienta
                        }).then(function (response) {
                            me.listarHerramientas();
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


            ValidarHerramientas(){
              this.errorHerramienta=0;
              this.errorMostrarMsjHerramienta=[];

              if (!this.nombre)this.errorMostrarMsjHerramienta.push("El nombre no puede estar vacio");


                if (!this.errorMostrarMsjHerramienta.length)this.errorHerramienta=1;
                return this.errorHerramienta;
            },
            cerrarModal(){
              this.modal=0;
              this.tituloModal='';
              this.nombre='';
              this.cantidad='';

            },
            AbrirModal(modelo,accion,data=[]){
                    switch (modelo) {
                        case "herramienta":
                            {

                            switch (accion) {
                                case "registrar": {
                                    this.modal =1;
                                    this.tituloModal='Registrar Herramienta';
                                    this.nombre='';
                                    this.cantidad='';
                                    this.tipoAccion =1;
                                    break;
                                }

                                case 'actualizar': {
                                    this.modal =1;
                                    this.tituloModal='Actualizar categoria';
                                    this.tipoAccion =2;
                                    this.nombre=data['nombre'];
                                    this.cantidad=data['cantidad'];
                                    this.id=data['id_herramienta'];
                                    break;
                                }
                            }
                    }
                    }
            }
        },
        mounted() {
          this.listarHerramientas();

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
