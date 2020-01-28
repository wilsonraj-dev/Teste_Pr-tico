<!DOCTYPE html>
    <html lang ="pt-br">
        <head>
            <meta charset="utf-8">
            <meta name="author" content="Wilson Junior">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no">
            <title>Teste Prático</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
            crossorigin="anonymous">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
            <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
        </head>

        <body>

    
            <div id="app">
               <div class="container-fluid">
                   <div class="row bg-dark">
                        <div class="col-lg-12">
                            <p class="text-center text-light display-4 pt-2" style="font-size: 25px;">Teste Prático</p>
                        </div>
                   </div>
               </div> 

               <div class="container">
                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <h3 class="text-info">Registrar Produtos</h3>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-info float-right" @click="showAddModal=true">
                                <i class="fas fa-user"></i>&nbsp;&nbsp; Add Novo Produto
                            </button>
                        </div>
                    </div>
                    <hr class="bg-info">
                    <div class="alert alert-danger" v-if="errorMsg">
                        {{ errorMsg }}
                    </div>
                    <div class="alert alert-success" v-if="successMsg">
                       {{ successMsg }}
                    </div>

                    <!--Exibir Registros-->
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center bg-info text-light">
                                        <th>ID</th>
                                        <th>Produto</th>
                                        <th>Descrição</th>
                                        <th>Preço</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center" v-for="user in users">
                                        <td>{{ user.id }}</td>
                                        <td>{{ user.produto }}</td>
                                        <td>{{ user.descricao }}</td>
                                        <td>{{ user.preco }}</td>
                                        <td><a href="#" class="text-success" @click="showEditModal=true; selectUser(user);"><i class="fas fa-edit"></i></a></td>
                                        <td><a href="#" class="text-danger" @click="showDeleteModal=true; selectUser(user);"><i class="fas fa-trash-alt"></i></a></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
               </div>

               <!--Add Novo Produto-->
               <div id="overlay" v-if="showAddModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Novo Produto</h5>
                                <button type="button" class="close" @click="showAddModal=false">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body p-4">
                                <form action="#" method="POST">
                                    <div class="form-group">
                                        <input type="text" name="produto" class="form-control form-control-lg" placeholder="Produto" v-model="newUser.produto">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="descricao" class="form-control form-control-lg" placeholder="Descrição" v-model="newUser.descricao">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="preco" step="0.01" min="0.01" max="999999" class="form-control form-control-lg" placeholder="Preço" v-model="newUser.preco">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-info btn-block btn-lg" @click="showAddModal=false; addUser(); clearMsg();">Add Produto</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
               </div>


               <!--Editar Modelo de Produto-->
               <div id="overlay" v-if="showEditModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Produto</h5>
                            <button type="button" class="close" @click="showEditModal=false">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body p-4">
                            <form action="#" method="POST">
                                <div class="form-group">
                                    <input type="text" name="produto" class="form-control form-control-lg" v-model="currentUser.produto">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="descricao" class="form-control form-control-lg" v-model="currentUser.descricao">
                                </div>
                                <div class="form-group">
                                    <input type="number" name="preco" step="0.01" min="0.01" max="999999" class="form-control form-control-lg" v-model="currentUser.preco">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-info btn-block btn-lg" @click="showEditModal=false; updateUser(); clearMsg();">Editar Produto</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
             </div>


                <!--Excluir Modelo de Produto-->
                <div id="overlay" v-if="showDeleteModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Excluir Produto</h5>
                                <button type="button" class="close" @click="showDeleteModal=false">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body p-4">
                                <h4 class="text-danger">Eii!! Tem certeza que deseja excluir esse produto?</h4>
                                <h5>Quer mesmo excluir '{{ currentUser.produto }}'?</h5>
                                <hr>
                                <button class="btn btn-danger btn-lg" @click="showDeleteModal=false; deleteUser(); clearMsg();">Sim, quero excluir</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <button class="btn btn-success btn-lg" @click="showDeleteModal=false">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/vue"></script>
            <script>
                var app = new Vue({
                    el:'#app',
                    data: { 
                        errorMsg: "",
                        successMsg: "",
                        showAddModal: false,
                        showEditModal: false,
                        showDeleteModal: false,
                        users: [],
                        newUser: {produto: "", descricao: "", preco: ""},
                        currentUser: {}
                    },
                    mounted: function(){
                        this.getAllUsers();
                    },
                    methods: {
                        getAllUsers(){
                            axios.get("http://localhost/Teste_Pratico/processa.php?action=read").then(function(response){
                                if(response.data.error){
                                    app.errorMsg = response.data.message;
                                }
                                else{
                                    app.users = response.data.users;
                                }
                            });
                        },
                        addUser(){
                            var formData = app.toFormData(app.newUser);
                            axios.post("http://localhost/Teste_Pratico/processa.php?action=create", formData).then(function(response){
                                app.newUser = {produto: "", descricao: "", preco: ""};
                                if(response.data.error){
                                    app.errorMsg = response.data.message;
                                }
                                else{
                                    app.successMsg = response.data.message;
                                    app.getAllUsers();
                                }
                            });
                        },

                        updateUser(){
                            var formData = app.toFormData(app.currentUser);
                            axios.post("http://localhost/Teste_Pratico/processa.php?action=update", formData).then(function(response){
                                app.currentUser = {};
                                if(response.data.error){
                                    app.errorMsg = response.data.message;
                                }
                                else{
                                    app.successMsg = response.data.message;
                                    app.getAllUsers();
                                }
                            });
                        },

                        deleteUser(){
                            var formData = app.toFormData(app.currentUser);
                            axios.post("http://localhost/Teste_Pratico/processa.php?action=delete", formData).then(function(response){
                                app.currentUser = {};
                                if(response.data.error){
                                    app.errorMsg = response.data.message;
                                }
                                else{
                                    app.successMsg = response.data.message;
                                    app.getAllUsers();
                                }
                            });
                        },
                        toFormData(obj){
                            var fd = new FormData();
                            for(var i in obj){
                                fd.append(i, obj[i]);
                            }
                            return fd;
                        },
                        selectUser(user){
                            app.currentUser = user;
                        },
                        clearMsg(){
                            app.errorMsg = "";
                            app.successMsg = "";
                        }
                    }
                });
            </script>
        </body>
    </html>