<template>
  <div class="min-h-screen flex flex-col bg-gray-100">
    <header class="bg-green-700 text-white py-4 shadow-md">
      <div class="container mx-auto flex justify-between items-center px-6">
        <div>
          <h1 class="text-2xl font-semibold">Almeida Supermercado</h1>
        </div>
        <nav>
          <router-link to="/" class="text-white hover:text-gray-300 mx-4 transition-colors duration-300">Inicio</router-link>
          <router-link to="/registrar" class="text-white hover:text-gray-300 mx-4 transition-colors duration-300">Registrar</router-link>
        </nav>
      </div>
    </header>

    <main class="flex justify-center items-center h-screen">
      <div class="w-full max-w-md">
        <h1 class="text-3xl font-semibold mb-4 text-center">Login</h1>
        <form @submit.prevent="login" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
          <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input v-model="email" id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Digite seu email">
          </div>

          <div class="mb-6">
            <label for="senha" class="block text-gray-700 text-sm font-bold mb-2">Senha</label>
            <input v-model="password" id="senha" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" placeholder="***********">
          </div>

          <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
          </div>
        </form>
      </div>
    </main>
  </div>
</template>

<script>
import axios from 'axios';
import { useToast } from 'vue-toastification';

export default {
  data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    login() {
      const toast = useToast();
      const data = {
        email: this.email,
        password: this.password
      };

      axios.post('http://127.0.0.1:8000/api/login', data)
        .then(response => {
          const token = response.data.data.token;
          localStorage.setItem('authToken', token);
          toast.success('Login bem-sucedido!');
          this.$router.push('/');
        })
        .catch(error => {
          console.error('Erro ao fazer login:', error);
          toast.error('Erro ao fazer login: ' + (error.response.data.message || 'Por favor, tente novamente.'));
        });
    }
  }
};
</script>

<style>
/* Estilos adicionais podem ser colocados aqui */
</style>
