<template>
  <div class="min-h-screen flex flex-col bg-gray-100">
    <header class="bg-green-700 text-white py-4 shadow-md">
      <div class="container mx-auto flex justify-between items-center px-6">
        <div>
          <h1 class="text-3xl font-bold">Almeida Supermercado</h1>
        </div>
        <nav class="flex items-center">
          <router-link to="/produtos" class="text-white hover:text-gray-300 mx-4 transition-colors duration-300">Gerenciar Produtos</router-link>
          <router-link v-if="!isLoggedIn" to="/login" class="text-white hover:text-gray-300 mx-4 transition-colors duration-300">Login</router-link>
          <router-link v-if="!isLoggedIn" to="/registrar" class="text-white hover:text-gray-300 mx-4 transition-colors duration-300">Registrar</router-link>
          <button v-if="isLoggedIn" @click="logout" class="text-white hover:text-gray-300 mx-4 transition-colors duration-300">Logout</button>
        </nav>
      </div>
    </header>

    <section class="relative bg-cover bg-center py-24" style="background-image: url('https://www.lopes.com.br/blog/wp-content/uploads/2016/11/Compras-no-supermercado-1.jpg');">
      <div class="absolute inset-0 bg-black opacity-50"></div>
      <div class="container mx-auto text-center text-white relative z-10">
        <h2 class="text-5xl font-bold mb-4 drop-shadow-md">Bem-vindo</h2>
        <p class="text-2xl mb-6 drop-shadow-md">Aqui você encontra todos os produtos que precisa!</p>
      </div>
    </section>

    <main class="container mx-auto py-12 flex-grow px-6">
      <h2 class="text-4xl font-bold text-center mb-10">Nossos Produtos</h2>

      <div v-for="category in categories" :key="category" class="mb-8">
        <h3 class="text-3xl font-bold mb-4">{{ category }}</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
          <div v-for="product in productsPorCategoria(category)" :key="product.id" class="bg-white rounded-lg shadow-md p-4 transition duration-300 ease-in-out transform hover:scale-105">
            <img :src="product.Foto" :alt="product.Nome" class="w-full h-48 object-contain rounded-t-lg mb-4">
            <h3 class="text-xl font-semibold text-gray-800">{{ product.Nome }}</h3>
            <p class="text-gray-600 mb-2">Preço: <span class="text-lg font-bold text-green-600">{{ formatCurrency(product.Preço) }}</span></p>
            <p class="text-gray-600 mb-2">Tipo: {{ product.Tipo }}</p>
            <p class="text-gray-600 mb-2">Quantidade: {{ product.Quantidade }}</p>
          </div>
        </div>
      </div>
    </main>

    <footer class="bg-green-700 text-white py-6 mt-auto">
      <div class="container mx-auto text-center">
        <p>&copy; 2024 Almeida Supermercado. Todos os direitos reservados.</p>
      </div>
    </footer>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: []
    };
  },
  computed: {
    isLoggedIn() {
      return !!localStorage.getItem('authToken');
    },
    categories() {
      return [...new Set(this.products.map(product => product.Tipo))];
    }
  },
  methods: {
    logout() {
      localStorage.removeItem('authToken');
      this.$router.push('/login');
    },
    loadProducts() {
      const token = localStorage.getItem('authToken');

      axios.get('http://127.0.0.1:8000/api/produtos', {
        headers: {
          'Accept': 'application/json',
          'Authorization': `Bearer ${token}`
        }
      })
      .then(response => {
        this.products = response.data.data || response.data;
      })
      .catch(error => {
        console.error('Erro ao carregar produtos:', error);
      });
    },
    formatCurrency(value) {
      return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
      }).format(value);
    },
    productsPorCategoria(category) {
      return this.products.filter(product => product.Tipo === category);
    }
  },
  mounted() {
    if (this.isLoggedIn) {
      this.loadProducts();
    } else {
      console.error('Token não encontrado. Redirecionando para a página de login.');
      this.$router.push('/login');
    }
  }
};
</script>

<style scoped>
body {
  font-family: 'Inter', sans-serif;
}
</style>
