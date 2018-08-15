<template>
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <!-- OVERVIEW -->
                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <h3 class="pb-2 display-4">Inventario de Piezas dañadas</h3>
                        <p class="panel-subtitle">Period: Oct 14, 2018 - Oct 21, 2018</p>
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
                                        <center><img  :src="imagen" v-model="imagen" class="img-thumbnail"  height="500" width="500" /></center>

                                    </div>


                                </div>


                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cancelar</button>

                                    <button type="button" class="btn btn-primary" v-if="tipoAccion==3" @click="Imagen()">Aceptar</button>


                                </div>


                            </div>

                        </div>
                    </div>

                    <div class="animated fadeIn">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">Registro de Piezas dañadas</strong>
                                    </div>

                                    <div class="card-body">

                                        <div class="col-lg-6">
                                        <div class="row form-group">
                                            <div class="col col-md-12">
                                                <div class="input-group">
                                                    <div class="input-group-btn">

                                                        <button class="btn btn-primary" @click="listarDanados(1,buscar,criterio)">
                                                            <i class="fa fa-search"></i> Search
                                                        </button>
                                                    </div>
                                                    <input type="text"  v-model="buscar" @keyup.enter="listarDanados(1,buscar,criterio)" placeholder="Nombre a buscar" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>

                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Descripcion</th>
                                                <th>imagen</th>
                                                <th>Periodo</th>
                                                <th>Formato</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(danados) in arrayDanados" :key="danados.id_danados">

                                                <td  v-text="danados.nombre"></td>
                                                <td v-text="danados.cantidad"></td>
                                                <td v-text="danados.descripcion"></td>
                                                <td >
                                                    <button  class="btn btn-success" @click="AbrirModal('danados','actualizarImagen',danados)">
                                                        Ver Imagen <i class="fa  fa-eye"></i>
                                                    </button>


                                                <td v-text="danados.created_at"> </td>
                                                <td>
                                                    <button @click="verPdf(danados.id_danados)"  class="btn btn-info">
                                                        <i class="fa  fa-eye"></i>
                                                    </button>

                                                    <button @click="descargarPdf()" class="btn btn-success">
                                                        <i class="fa  fa-download"></i>
                                                    </button>

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
                nombre: '',
                cantidad: '',
                descripcion: '',
                imagen:'',
                arrayDanados: [],
                modal: 0,
                modalImagen:0,
                tituloModal: '',
                tipoAccion: 0,
                pagination :{
                    "total": 0,
                    "per_page": 0,
                    "current_page": 0,
                    "last_page": 0,
                    "from": 0,
                    "to": 0,
                },
                offset:10,
                criterio:'periodos',
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
            verPdf: function (id_danados) {

                location.href='/pdfDescargar'


            },
            descargarPdf: function (id_reposiciones) {
                location.href='/pdfDescargar'
            },

          listarDanados(page,buscar,criterio){

              let me =this;
              var url='/danados?page='+ page + '&buscar='+buscar + '&criterio'+criterio;
              axios.get(url).then(function (response) {
                  var  respuesta=response.data;
                    me.arrayDanados = respuesta.danados.data;
                    me.pagination=respuesta.pagination;


                  })
                  .catch(function (error) {
                      console.log(error);
                  });
          },
            cambiarPagina(page,buscar,criterio){
              let me = this;
              me.pagination.current_page=page;
              me.listarDanados(page,buscar,criterio);

            },
            eliminarDanados(id_danados){
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

                        axios.delete('/danados/'+id_danados).then(response=>{
                           id:id_danados
                            console.log(response);
                        }).then(function (response) {
                            me.listarDanados(1,'','nombre' );
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
            cerrarModal(){
                this.modal=0;
                this.modalImagen=0;
                this.tituloModal='';
                this.nombre='';
                this.cantidad='';
                this.descripcion='';

            },
            AbrirModal(modelo,accion,data=[]){
                switch (modelo) {
                    case "danados":
                    {

                        switch (accion) {
                            case "registrar": {
                                this.modal =1;
                                this.tituloModal='Registrar Herramienta';
                                this.nombre='';
                                this.cantidad='';
                                this.descripcion='';
                                this.imagen='';
                                this.tipoAccion =1;
                                break;
                            }

                            case 'actualizar': {
                                this.modal =1;

                                this.tituloModal='Actualizar herramienta';
                                this.tipoAccion =2;
                                this.nombre=data['nombre'];
                                this.cantidad=data['cantidad'];
                                this.imagen=data['imagen'];
                                this.descripcion=data['descripcion'];
                                this.id=data['id_herramienta'];
                                break;
                            }
                            case 'actualizarImagen': {
                                this.modalImagen =1;

                                this.tituloModal='Imagen de herramienta';
                                this.tipoAccion =2;
                                this.nombre=data['nombre'];
                                this.cantidad=data['cantidad'];
                                this.imagen=data['imagen'];
                                this.descripcion=data['descripcion'];
                                this.id=data['id_herramienta'];
                                break;
                            }
                        }
                    }
                }
            },

        },
        mounted() {
          this.listarDanados(1,this.buscar,this.criterio);

        }
    }





</script>
