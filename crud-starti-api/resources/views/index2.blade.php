<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aplicação CRUD usando Vue.js, PHP & MySQLi</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/3e47a1d6cd.js" crossorigin="anonymous"></script>

  <style type="text/css">
    #overlay {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      background: rgba(0, 0, 0, 0.6);
    }
  </style>
</head>

<body>
  <div id="app">
    <div class="container-fluid">
      <div class="row bg-dark">
        <div class="col-lg-12">
          <p class="text-center text-light display-4 pt-2" style="font-size:25px;">Aplicação CRUD usando Vue.js, PHP &
            MySQLi</p>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row mt-3">
        <div class="col-lg-6">
          <h3 class="text-info"> Usuários registrados</h3>
        </div>
        <div class="col-lg-6">
          <button class="btn btn-info float-right" @click="showAddModal=true">
            <i class="fas fa-user"></i>&nbsp;&nbsp;Adicionar novo usuário
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

      <!-- Displaying Records -->
      <div class="row">
        <div class="col-lg-12">
          <table class="table table-bordered table-striped">
            <thead>
              <tr class="text-center bg-info text-light">
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Editar</th>
                <th>Deletar</th>
              </tr>
            </thead>
            <tbody>
              <tr class="text-center" v-for="user in users">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.phone }}</td>
                <td>
                  <a href="#" class="text-success" @click="showEditModal=true; selectUser(user);">
                    <i class="fas fa-edit"></i>
                  </a>
                </td>
                <td>
                  <a href="#" class="text-danger" @click="showDeleteModal=true; selectUser(user);">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Add New User Modal -->
    <div id="overlay" v-if="showAddModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Adicionar novo usuário</h5>
            <button type="button" class="close" @click="showAddModal=false">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-4">
            <form action="#" method="POST">
              <div class="form-group">
                <input type="text" name="name" class="form-control form-control-lg" placeholder="Nome"
                  v-model="newUser.name">
              </div>
              <div class="form-group">
                <input type="email" name="email" class="form-control form-control-lg" placeholder="E-mail"
                  v-model="newUser.email">
              </div>
              <div class="form-group">
                <input type="tel" name="phone" class="form-control form-control-lg" placeholder="Telefone"
                  v-model="newUser.phone">
              </div>
              <div class="form-group">
                <button class="btn btn-info btn-block btn-lg"
                  @click="showAddModal=false; addUser(); clearMsg();">Adicionar
                  usuário</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit User Modal -->
    <div id="overlay" v-if="showEditModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar usuário</h5>
            <button type="button" class="close" @click="showEditModal=false">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-4">
            <form action="#" method="POST">
              <div class="form-group">
                <input type="text" name="name" class="form-control form-control-lg" v-model="currentUser.name">
              </div>
              <div class="form-group">
                <input type="email" name="email" class="form-control form-control-lg" v-model="currentUser.email">
              </div>
              <div class="form-group">
                <input type="tel" name="phone" class="form-control form-control-lg" v-model="currentUser.phone">
              </div>
              <div class="form-group">
                <button class="btn btn-info btn-block btn-lg"
                  @click="showEditModal=false; updateUser(); clearMsg();">Atualizar
                  usuário</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete User Modal -->
    <div id="overlay" v-if="showDeleteModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Deletar usuário</h5>
            <button type="button" class="close" @click="showDeleteModal=false">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-4">
            <h4 class="text-danger">Você tem certeza que deseja deletar esse usuário ?</h4>
            <h5> Você está tentando deletar '{{ currentUser.name }}' </h5>
            <hr>
            <button class="btn btn-danger btn-lg" @click="showDeleteModal=false; deleteUser(); clearMsg();">Sim</button>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <button class="btn btn-success btn-lg" @click="showDeleteModal=false">Não</button>
          </div>
        </div>
      </div>
    </div>


  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"
    integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg=="
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
  <script type="text/javascript" src="../js/main.js"></script>
</body>

</html>
