<template>
  <div id="crud">
    <div class="container-fluid">
      <div class="row bg-dark">
        <div class="col-lg-11">
          <h1
            class="text-center text-light display-4 pt-2"
            style="font-size:30px;"
          >
            Aplicação CRUD usando Vue.js, PHP & MySQLi
          </h1>
        </div>
        <div class="col-lg-1">
          <button class="btn btn-info float-right mt-2" @click="logout()">
            Sair
            <i class="fa fa-sign-out"></i>
          </button>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row mt-3">
        <div class="col-lg-6">
          <h3 class="text-info">Usuários registrados</h3>
        </div>
        <div class="col-lg-6">
          <button class="btn btn-info float-right" @click="showAddModal = true">
            <i class="fas fa-user"></i>&nbsp;&nbsp;Adicionar novo usuário
          </button>
        </div>
      </div>
      <hr class="bg-info" />

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
                <th>Endereço</th>
                <th>Editar</th>
                <th>Deletar</th>
              </tr>
            </thead>
            <tbody>
              <tr class="text-center" v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.phone }}</td>
                <td>{{ user.address }}</td>
                <td>
                  <a
                    href="#"
                    class="text-success"
                    @click="
                      showEditModal = true;
                      selectUser(user);
                    "
                  >
                    <i class="fas fa-edit"></i>
                  </a>
                </td>
                <td>
                  <a
                    href="#"
                    class="text-danger"
                    @click="
                      showDeleteModal = true;
                      selectUser(user);
                    "
                  >
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
            <button type="button" class="close" @click="showAddModal = false">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-4">
            <form action="#" method="POST">
              <div class="form-group">
                <input
                  type="text"
                  name="name"
                  class="form-control form-control-lg"
                  placeholder="Nome"
                  v-model="newUser.name"
                />
              </div>
              <div class="form-group">
                <input
                  type="email"
                  name="email"
                  class="form-control form-control-lg"
                  placeholder="E-mail"
                  v-model="newUser.email"
                />
              </div>
              <div class="form-group">
                <input
                  type="password"
                  name="password"
                  class="form-control form-control-lg"
                  placeholder="Senha"
                  v-model="newUser.password"
                />
              </div>
              <div class="form-group">
                <input
                  type="tel"
                  name="phone"
                  class="form-control form-control-lg"
                  placeholder="Telefone"
                  v-model="newUser.phone"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  name="address"
                  class="form-control form-control-lg"
                  placeholder="Endereço"
                  v-model="newUser.address"
                />
              </div>
              <div class="form-group">
                <button
                  class="btn btn-info btn-block btn-lg"
                  @click="
                    showAddModal = false;
                    addUser();
                    clearMsg();
                  "
                >
                  Adicionar usuário
                </button>
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
            <button type="button" class="close" @click="showEditModal = false">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-4">
            <form action="#">
              <div class="form-group">
                <input
                  type="text"
                  name="name"
                  class="form-control form-control-lg"
                  v-model="currentUser.name"
                />
              </div>
              <div class="form-group">
                <input
                  type="email"
                  name="email"
                  class="form-control form-control-lg"
                  v-model="currentUser.email"
                />
              </div>
              <div class="form-group">
                <input
                  type="tel"
                  name="phone"
                  class="form-control form-control-lg"
                  v-model="currentUser.phone"
                />
              </div>
              <div class="form-group">
                <input
                  type="address"
                  name="address"
                  class="form-control form-control-lg"
                  v-model="currentUser.address"
                />
              </div>
              <div class="form-group">
                <button
                  class="btn btn-info btn-block btn-lg"
                  type="submit"
                  @click="
                    showEditModal = false;
                    updateUser();
                    clearMsg();
                  "
                >
                  Atualizar usuário
                </button>
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
            <button
              type="button"
              class="close"
              @click="showDeleteModal = false"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-4">
            <h4 class="text-danger">
              Você tem certeza que deseja deletar esse usuário ?
            </h4>
            <h5>Você está tentando deletar '{{ currentUser.name }}'</h5>
            <hr />
            <button
              class="btn btn-danger btn-lg"
              type="submit"
              @click="
                showDeleteModal = false;
                deleteUser();
                clearMsg();
              "
            >
              Sim
            </button>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <button
              class="btn btn-success btn-lg"
              @click="showDeleteModal = false"
            >
              Não
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { API_BASE_URL } from '../config';

export default {
  name: 'CRUD',
  data: function() {
    return {
      users: {},
      errorMsg: '',
      successMsg: '',
      showAddModal: false,
      showEditModal: false,
      showDeleteModal: false,
      newUser: { name: '', email: '', password: '', phone: '', address: '' },
      currentUser: {},
    };
  },
  created: function() {
    this.getAllUsers();
  },
  methods: {
    getAllUsers() {
      var data = this;
      axios.get(API_BASE_URL + '/users').then(function(response) {
        if (response.data.error) {
          this.errorMsg = response.data.message;
        } else {
          console.log(data);

          data.users = response.data.data;
        }
      });
    },
    addUser() {
      // var formData = this.toFormData(this.newUser);
      var data = this;
      console.log('data', data.newUser);

      axios
        .post(API_BASE_URL + '/users', data.newUser)
        .then(function(response) {
          data.newUser = { name: '', email: '', phone: '', address: '' };
          if (response.data.error) {
            data.errorMsg = response.data.message;
          } else {
            data.successMsg = response.data;
            data.getAllUsers();
          }
        });
    },
    updateUser() {
      var formData = this.toFormData(this.currentUser);
      console.log(this.currentUser);
      console.log(formData);
      var data = this;
      axios
        .put(API_BASE_URL + '/users/' + data.currentUser.id, data.currentUser)
        .then(function(response) {
          data.currentUser = {};
          if (response.data.error) {
            data.errorMsg = response.data;
          } else {
            console.log(response.data);
            data.successMsg = response.data;
            data.getAllUsers();
          }
        });
    },
    deleteUser() {
      var data = this;

      axios
        .post(API_BASE_URL + '/users/' + data.currentUser.id)
        .then(function(response) {
          data.currentUser = {};
          if (response.data.error) {
            data.errorMsg = response.data;
          } else {
            data.successMsg = response.data;
            data.getAllUsers();
          }
        });
    },
    toFormData(obj) {
      var formData = new FormData();
      for (var i in obj) {
        formData.append(i, obj[i]);
      }
      return formData;
    },
    selectUser(selectedUser) {
      this.currentUser = selectedUser;
    },
    clearMsg() {
      this.errorMsg = '';
      this.successMsg = '';
    },
    logout() {
      this.$router.push('/');
    },
  },
};
</script>
