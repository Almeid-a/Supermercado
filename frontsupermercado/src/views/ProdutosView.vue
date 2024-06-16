<template>
  <div class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-green-700 text-white py-4 shadow-md">
      <div class="container mx-auto flex justify-between items-center px-6">
        <div>
          <h1 class="text-3xl font-bold">Almeida Supermercado</h1>
        </div>
        <nav class="flex items-center">
          <router-link to="/" class="text-white hover:text-gray-300 mx-4">Início</router-link>
          <router-link v-if="!isLoggedIn" to="/login" class="text-white hover:text-gray-300 mx-4">Login</router-link>
          <router-link v-if="!isLoggedIn" to="/registrar" class="text-white hover:text-gray-300 mx-4">Registrar</router-link>
          <button v-if="isLoggedIn" @click="logout" class="text-white hover:text-gray-300 mx-4">Logout</button>
        </nav>
      </div>
    </header>

    <main class="container mx-auto py-8 flex-grow">
      <h2 class="text-4xl font-bold text-center mb-10">Produtos</h2>
      <div class="flex justify-between items-center mb-6">
        <select v-model="selectedCategory" @change="filterProducts" class="border border-gray-300 rounded px-3 py-2">
          <option value="">Todas as categorias</option>
          <option v-for="category in categories" :key="category" :value="category">{{ category }}</option>
        </select>
        <input v-model="searchQuery" @input="filterProducts" class="border border-gray-300 rounded px-3 py-2" type="text" placeholder="Buscar por nome">
        <button @click="adicionarProduto" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
          Cadastrar Produto
        </button>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <div v-for="product in filteredProducts" :key="product.id" class="bg-white rounded-lg shadow-md p-4 transition duration-300 ease-in-out transform hover:scale-105">
          <div @click="showModal(product)" class="cursor-pointer">
            <img :src="product.Foto" :alt="product.Nome" class="w-full h-48 object-contain rounded-t-lg mb-4">
            <h3 class="text-xl font-semibold text-gray-800">{{ product.Nome }}</h3>
            <p class="text-gray-600 mb-2">Preço: <span class="text-lg font-bold text-green-600">{{ formatCurrency(product.Preço) }}</span></p>
            <p class="text-gray-600 mb-2">Tipo: {{ product.Tipo }}</p>
            <p class="text-gray-600 mb-2">Quantidade: {{ product.Quantidade }}</p>
          </div>
        </div>
      </div>

      <DetalhesProdutoView 
        :product="selectedProduct" 
        v-if="selectedProduct" 
        @close="hideModal" 
        @produto-deletado="handleProdutoDeletado"
        @produto-atualizado="handleProdutoAtualizado" 
      />
    </main>

    <footer class="bg-green-700 text-white py-6">
      <div class="container mx-auto text-center">
        <p>&copy; 2024 Almeida Supermercado. Todos os direitos reservados.</p>
      </div>
    </footer>
  </div>
</template>

<script>
import axios from 'axios';
import DetalhesProdutoView from '../views/DetalhesProdutoView.vue';

export default {
  components: {
    DetalhesProdutoView
  },
  data() {
    return {
      products: [],
      filteredProducts: [],
      selectedProduct: null,
      searchQuery: '',
      selectedCategory: '',
      categoriesList: []
    };
  },
  computed: {
    isLoggedIn() {
      return !!localStorage.getItem('authToken');
    },
    categories() {
      return this.categoriesList;
    }
  },
  methods: {
    fetchProducts() {
      const token = localStorage.getItem('authToken');

      axios.get('http://localhost:8000/api/produtos', {
        headers: {
          'Accept': 'application/json',
          'Authorization': `Bearer ${token}`
        }
      })
      .then(response => {
        this.products = response.data.data;
        this.filteredProducts = this.products;
        this.extractCategories();
      })
      .catch(error => {
        console.error('Erro ao buscar produtos:', error);
        if (error.response.status === 401) {
          this.$router.push('/login');
        }
      });
    },
    extractCategories() {
      const allCategories = this.products.map(product => product.Tipo);
      this.categoriesList = [...new Set(allCategories)];
    },
    formatCurrency(value) {
      return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
      }).format(value);
    },
    filterProducts() {
      let filteredProducts = this.products;

      if (this.searchQuery.trim() !== '') {
        filteredProducts = filteredProducts.filter(product =>
          product.Nome.toLowerCase().includes(this.searchQuery.trim().toLowerCase())
        );
      }

      if (this.selectedCategory !== '') {
        filteredProducts = filteredProducts.filter(product =>
          product.Tipo === this.selectedCategory
        );
      }

      this.filteredProducts = filteredProducts;
    },
    adicionarProduto() {
      this.$router.push('/cadastrar');
    },
    showModal(product) {
      this.selectedProduct = product;
    },
    hideModal() {
      this.selectedProduct = null;
    },
    handleProdutoDeletado(productId) {
      this.products = this.products.filter(product => product.id !== productId);
      this.filteredProducts = this.filteredProducts.filter(product => product.id !== productId);
      this.selectedProduct = null;
      this.extractCategories();
    },
    handleProdutoAtualizado(productId) {
      this.fetchProducts();
      this.selectedProduct = null;
    },
    logout() {
      localStorage.removeItem('authToken');
      this.$router.push('/login');
    }
  },
  mounted() {
    if (this.isLoggedIn) {
      this.fetchProducts();
    } else {
      console.error('Token não encontrado. Redirecionando para a página de login.');
      this.$router.push('/login');
    }
  }
};
</script>

<style>
/* Estilos adicionais podem ser colocados aqui */
</style>
