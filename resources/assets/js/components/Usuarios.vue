<template>
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <!-- OVERVIEW -->
                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <h3 class="pb-2 display-4">Perfil de usuario</h3>
                        <p class="panel-subtitle">Period: Oct 14, 2018 - Oct 21, 2018</p>
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
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label  class=" form-control-label">Nombre</label>
                                        <input type="text"   v-model="name" placeholder="Inserta Nombre de Usuario" class="form-control">

                                    </div>
                                    <div class="form-group">
                                        <label  class=" form-control-label">correo</label>
                                        <input type="email"  v-model="email" placeholder="Correo" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label  class=" form-control-label">contrasena</label>
                                        <input type="password"  v-model="password" placeholder="Contrasena" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label  class=" form-control-label">Telefeno</label>
                                        <input type="text"  v-model="telefono" placeholder="Telefeno" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label  class=" form-control-label">Tipo De Usuario</label>
                                        <select class="form-control" v-model="id_roles">
                                        <option value="0">Seleccione un rol</option>
                                        <option v-for="rol in arrayRol" :key="rol.id_roles" :value="rol.id_rol" v-text="rol.nombre">

                                        </option>

                                        </select>
                                    </div>
                                    <div  class="form-group row  div-error">
                                        <div class="text-center">
                                            <div >

                                            </div>

                                        </div>

                                    </div>
                                </div>


                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cancelar</button>
                                    <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="RegistrarUsuario()">Aceptar</button>
                                    <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="ActualizarUsuario()">Actualizar</button>


                                </div>


                            </div>

                        </div>
                    </div>

                    <div class="animated fadeIn">
                        <div class="row">


                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            <img class="rounded-circle mx-auto d-block" src="images/admin.jpg" alt="Card image cap">
                                            <h5 class="text-sm-center mt-2 mb-1"></h5>
                                            <div class="location text-sm-center"><i class="fa fa-map-marker"></i> California, United States</div>
                                        </div>
                                        <hr>
                                        <div class="card-text text-sm-center">
                                            <a href="#"><i class="fa fa-facebook pr-1"></i></a>
                                            <a href="#"><i class="fa fa-twitter pr-1"></i></a>
                                            <a href="#"><i class="fa fa-linkedin pr-1"></i></a>
                                            <a href="#"><i class="fa fa-pinterest pr-1"></i></a>
                                        </div>
                                    </div>

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">Agregar usuario</strong>
                                    </div>

                                    <div class="card-body">
                                        <button type="button" class="btn btn-primary" @click="AbrirModal('usuario','registrar')"><i class="fa fa-plus"></i>
                                            Agregar
                                        </button>
                                        <div class="col-lg-6">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group-btn">
                                                            <select  class="dropdown-toggle btn btn-primary" v-model="criterio">
                                                                <option class="form-group" value="name">Nombre</option>
                                                                <option class="form-group" value="descripcion">correo</option>

                                                            </select>
                                                            <button class="btn btn-primary" @click="listarUsuario(1,buscar,criterio)">
                                                                <i class="fa fa-search"></i> Search
                                                            </button>
                                                        </div>
                                                        <input type="text"  v-model="buscar" @keyup.enter="listarUsuario(1,buscar,criterio)" placeholder="Nombre a buscar" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>Correo</th>
                                                <th>telefono</th>
                                                <th>Rol</th>
                                                <th>Acciones</th>
                                                <th>Estado</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(usuario, index) in arrayUsuario" :key="usuario.id_usuario">
                                                <td v-text="usuario.id_usuario"></td>
                                                <td class="btn btn-link" v-text="usuario.name"></td>
                                                <td v-text="usuario.email"></td>
                                                <td v-text="usuario.telefono"></td>
                                                <td v-text="usuario.rol"></td>
                                                <td>
                                                    <button  class="btn btn-warning" @click="AbrirModal('usuario','actualizar',usuario)">
                                                        <i class="fa  fa-pencil"></i>
                                                    </button>
                                                    <button type="button"  class="btn btn-danger" @click="eliminarUsuario(usuario.id_usuario,index)">
                                                        <i class="fa  fa-trash-o"></i>
                                                    </button>

                                                </td>
                                                <td>
                                                    <template v-if="usuario.condicion">
                                                          <button type="button" class="btn btn-danger" @click="desactivarUsuario(usuario.id_usuario)" ></button>
                                                    </template>
                                                    <template v-else="usuario.condicion">

                                                            <button type="button" class="btn btn-success" @click="activarUsuario(usuario.id_usuario)" ></button>

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
                name: '',
                email:'',
                password:'',
                telefono:'',
                id_roles:0,
               id_usuario:0,
                arrayUsuario: [],
                arrayRol: [],
                modal: 0,
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
                criterio:'name',
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

            listarUsuario(page,buscar,criterio){

                let me =this;
                var url='/usuario?page='+ page + '&buscar='+buscar + '&criterio'+criterio;
                axios.get(url).then(function (response) {
                    var  respuesta=response.data;
                    me.arrayUsuario= respuesta.users.data;
                    me.pagination=respuesta.pagination;


                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            listarRoles(){
                let me =this;
                var url='/roles/listarRoles';
                axios.get(url).then(function (response) {
                    var  respuesta=response.data;
                    me.arrayRol = respuesta.roles;



                })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                me.pagination.current_page=page;
                me.listarUsuario(page,buscar,criterio);

            },
            RegistrarUsuario(){


                let me =this;
                axios.post('/usuario/registrar',{
                    'name':this.name,
                    'email':this.email,
                    'password':this.password,
                    'telefono':this.telefono,
                    'condicion':this.condicion,
                    'id_roles':this.id_roles


                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUsuario(1,'','nombre' );
                    console.log(response);
                    swal("Exito", "Se inserto correctamente!", "success");
                })
                    .catch(function (error) {
                        console.log("es un error de post");
                    });

            },
            ActualizarUsuario(){

                let me =this;
                axios.put('/usuario/actualizar',{
                    'name':this.name,
                    'email':this.email,
                    'password':this.password,
                    'telefono':this.telefono,
                    'id_usuario': this.id,
                    'id_roles':this.id_roles
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUsuario(1,'','nombre'  );
                    console.log(response);
                    swal("Exito", "Se Actualizo correctamente!", "success");
                })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            eliminarUsuario(id_usuario){
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

                        axios.delete('/usuario/'+id_usuario).then(response=>{
                            id:id_usuario
                            console.log(response);
                        }).then(function (response) {
                            me.listarUsuario(1,'','nombre' );
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

            desactivarUsuario(id_usuario){

                let me =this;
                axios.put('/usuario/desactivar',{
                 'id':id_usuario
                }).then(function (response) {

                    me.listarUsuario(1,'','nombre'  );
                    console.log(response);
                    swal("Exito", "Se Actualizo correctamente!", "success");
                })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            activarUsuario(id_usuario){
                swal({
                    title: 'Estas seguro de desactivar al usuario?',
                    text: "Podras activarlo despues",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        let me =this;
                        axios.put('/usuario/activar',{
                            'id':id_usuario
                        }).then(function (response) {
                            me.listarUsuario(1,'','nombre');
                            swal(

                                'Estatus cambiado!',
                                'Haz desactivado un usuario.',
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
                this.tituloModal='';
                this.name='';
                this.email='';
                this.password='';
                this.telefono='';
                this.id_roles=0;

            },
            AbrirModal(modelo,accion,data=[]){
                this.listarRoles();
                switch (modelo) {
                    case "usuario":
                    {

                        switch (accion) {
                            case "registrar": {
                                this.modal =1;
                                this.tituloModal='Registrar Herramienta';
                                this.name='';
                                this.email='';
                                this.password='';
                                this.telefono='';
                                this.id_roles=0;
                                this.tipoAccion =1;
                                break;
                            }

                            case 'actualizar': {
                                this.modal =1;
                                this.tituloModal='Actualizar categoria';
                                this.tipoAccion =2;
                                this.name=data['name'];
                                this.email=data['email'];
                                this.password=data['password'];
                                this.telefono=data['telefono'];
                                this.id=data['id_usuario'];
                                this.id_roles=data['id_roles'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarUsuario(1,this.buscar,this.criterio);

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
