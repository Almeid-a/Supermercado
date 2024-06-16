<template>
    <div class="min-h-screen flex flex-col bg-gray-100">
      <header class="bg-green-700 text-white py-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
          <div class="flex items-center">
            <h1 class="text-2xl font-semibold">Almeida Supermercado</h1>
          </div>
          <nav class="flex items-center">
            <router-link to="/produtos" class="text-white hover:text-gray-300 mx-4 transition-colors duration-300">Produtos</router-link>
            <a v-if="isLoggedIn" @click="logout" class="text-white hover:text-gray-300 mx-4 transition-colors duration-300 cursor-pointer">Logout</a>
          </nav>
        </div>
      </header>
  
      <main class="container mx-auto py-8">
        <h1 class="text-3xl font-semibold mb-6 text-center">Adicionar Produto</h1>
        <form @submit.prevent="addProduct">
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
              Nome do Produto
            </label>
            <input v-model="newProduct.name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Digite o nome do produto">
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
              Preço
            </label>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">R$</span>
              <input v-model="newProduct.price" @input="formatPrice" class="shadow appearance-none border rounded w-full py-2 pl-8 pr-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="price" type="text" placeholder="Digite o preço do produto">
            </div>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
              Tipo
            </label>
            <input v-model="newProduct.type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="type" type="text" placeholder="Digite o tipo do produto">
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
              Quantidade
            </label>
            <input v-model="newProduct.quantity" @input="validateQuantity" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="quantity" type="number" placeholder="Digite a quantidade do produto" min="0">
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="imageUrl">
              URL da Foto do Produto
            </label>
            <input v-model="newProduct.imageUrl" @input="onImageUrlChange" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="imageUrl" type="text" placeholder="Digite a URL da foto do produto">
            <img v-if="previewImage" :src="previewImage" alt="Pré-visualização da Foto" class="mt-4 max-w-xs">
          </div>
          <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
              Adicionar Produto
            </button>
          </div>
        </form>
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
  import { useToast } from 'vue-toastification';
  
  export default {
    data() {
      return {
        products: [],
        newProduct: {
          name: '',
          price: '',
          type: '',
          quantity: 0,
          imageUrl: ''
        },
        previewImage: null
      };
    },
    methods: {
      formatPrice(event) {
        let value = event.target.value;
        value = value.replace(/\D/g, '');
        value = (value / 100).toFixed(2);
        event.target.value = parseFloat(value).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        this.newProduct.price = value;
      },
      validateQuantity(event) {
        let value = event.target.value;
        if (value < 0) {
          event.target.value = 0;
          this.newProduct.quantity = 0;
        } else {
          this.newProduct.quantity = value;
        }
      },
      onImageUrlChange(event) {
        this.previewImage = event.target.value;
      },
      addProduct() {
        const toast = useToast();
  
        const productData = {
          nome: this.newProduct.name,
          preco: parseFloat(this.newProduct.price.replace(',', '.')),
          tipo: this.newProduct.type,
          quantidade: parseInt(this.newProduct.quantity),
          foto: this.newProduct.imageUrl
        };
  
        const token = localStorage.getItem('authToken');
        if (!token) {
          console.error('Token não encontrado no localStorage');
          return;
        }
  
        axios.post('http://localhost:8000/api/produtos', productData, {
          headers: {
            'Accept': 'application/json',
            Authorization: `Bearer ${token}`
          }
        })
        .then(response => {
          console.log(response.data);
          this.newProduct = { name: '', price: '', type: '', quantity: 0, imageUrl: '' };
          this.previewImage = null;
          toast.success('Produto cadastrado com sucesso!');
        })
        .catch(error => {
          console.error('Erro ao adicionar produto:', error);
          toast.error('Erro ao cadastrar produto.');
        });
      },
      logout() {
        const token = localStorage.getItem('authToken');
        if (!token) {
          console.error('Token não encontrado no localStorage');
          return;
        }
  
        axios.post('http://localhost:8000/api/logout', null, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        .then(response => {
          console.log(response.data);
          localStorage.removeItem('authToken');
          this.$router.push('/');
        })
        .catch(error => {
          console.error('Erro ao fazer logout:', error);
        });
      }
    },
    computed: {
      isLoggedIn() {
        return !!localStorage.getItem('authToken');
      }
    }
  };
  </script>
  
  <style>
  /* Estilos adicionais podem ser colocados aqui */
  </style>
  