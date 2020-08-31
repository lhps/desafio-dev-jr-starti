<template>
  <div class="container-fluid">
    <div>
      <div class="container">
        <div class="container-content" style="margin-top: 250px;">
          <div class="container-header">
            <h5 class="container-title" style="font-size:35px;">Login</h5>
          </div>

          <div class="d-flex justify-content-center p-4">
            <form @submit="onSubmit">
              <div class="form-group">
                <input
                  required
                  style="width:350px;"
                  type="email"
                  name="email"
                  class="form-control form-control-lg"
                  placeholder="E-mail"
                  v-model="form.email"
                />
              </div>
              <div class="form-group">
                <input
                  required
                  style="width:350px;"
                  type="password"
                  name="password"
                  class="form-control form-control-lg"
                  placeholder="Senha"
                  v-model="form.password"
                />
              </div>

              <div class="form-group">
                <button class="btn btn-info btn-block btn-lg" type="submit">
                  Entrar
                </button>
              </div>
              <div class="alert alert-danger" v-if="errorMsg">
                {{ errorMsg }}
              </div>
            </form>
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
  name: 'Form',
  data() {
    return {
      form: {
        email: '',
        password: '',
      },
      errorMsg: '',
    };
  },
  props: {
    msg: String,
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      this.login();
    },
    async login() {
      var data = this;

      axios
        .post(API_BASE_URL + '/session', this.$data.form)
        .catch(function(error) {
          if (error.response.status == '404') {
            data.errorMsg = error.response.data;
          }
        })
        .then(function(response) {
          data.newUser = { name: '', email: '', phone: '', address: '' };
          if (response.status == '404') {
            data.errorMsg = response.data;
          } else {
            data.$router.push('crud');
          }
        });

      console.log('passei aqui', this.$data.form);
    },
  },
};
</script>
