<template>
  <form @submit.prevent="onSubmit">
    <span class="help is-danger" v-text="errors"></span>

    <div class="field">
      <div class="control">
        <input
          class="input"
          type="name"
          placeholder="Qual o nome do usuário"
          v-model="name"
          @keydown="errors = ''"
        />
        <input
          class="input"
          type="email"
          placeholder="E-mail"
          v-model="email"
          @keydown="errors = ''"
        />
        <input
          class="input"
          type="password"
          placeholder="Senha"
          v-model="password"
          @keydown="errors = ''"
        />
        <input
          class="input"
          type="address"
          placeholder="Endereço"
          v-model="address"
          @keydown="errors = ''"
        />
        <input
          class="input"
          type="phone"
          placeholder="Telefone"
          v-model="phone"
          @keydown="errors = ''"
        />
      </div>
    </div>

    <button
      class="button is-primary"
      v-bind:class="{ 'is-loading': isLoading }"
    >
      Adicionar usuário
    </button>
  </form>
</template>

<script>
import axios from 'axios';
import { API_BASE_URL } from '../config';

export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      address: '',
      phone: '',
      errors: '',
      isLoading: false,
    };
  },
  methods: {
    onSubmit() {
      this.isLoading = true;
      this.postUser();
      this.getAllUsers();
    },
    async postUser() {
      axios
        .post(API_BASE_URL + '/users', this.$data)
        .then((response) => {
          this.name = '';
          this.isLoading = false;
          this.$emit('completed', response.data.data);
        })
        .catch((error) => {
          // handle authentication and validation errors here
          this.errors = error.response.data.errors;
          this.isLoading = false;
        });
    },
    async getAllUsers() {
      const response = await axios.get(API_BASE_URL + '/users');
      this.$data.users = response.data.data;
      console.log(response);
    },
  },
};
</script>
