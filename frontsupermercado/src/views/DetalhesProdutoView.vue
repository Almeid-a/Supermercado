<template>
  <div>
    <div v-if="!showModalConfirmacao && product" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
        <div class="flex justify-between items-center px-6 py-3">
          <h2 class="text-xl font-semibold text-center flex-1">{{ product.Nome }}</h2>
          <button @click="fecharModal" class="text-gray-600 hover:text-gray-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        <div class="p-6">
          <div class="w-full h-64 mb-4 overflow-hidden rounded-lg">
            <img :src="product.Foto" :alt="product.Nome" class="object-contain h-full w-full">
          </div>
          <p class="text-gray-700 mb-2"><span class="font-semibold">Preço:</span> {{ formatCurrency(product.Preço) }}</p>
          <p class="text-gray-700 mb-2"><span class="font-semibold">Tipo:</span> {{ product.Tipo }}</p>
          <p class="text-gray-700 mb-2"><span class="font-semibold">Quantidade:</span> {{ product.Quantidade }}</p>
          <div class="flex justify-center mt-6">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4" @click="handleEditar">Editar</button>
            <button class="bg-red-500 hover:bg-red-900 text-white font-bold py-2 px-4 rounded" @click="confirmarExclusao">Deletar</button>
          </div>
        </div>
      </div>
    </div>

    <div v-if="showModalConfirmacao" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white rounded-lg shadow-lg w-full max-w-sm p-6">
        <h3 class="text-xl font-semibold mb-4 text-center">Confirmação de Exclusão</h3>
        <p class="text-gray-700 mb-6 text-center">Você tem certeza que deseja excluir este produto?</p>
        <div class="flex justify-center">
          <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-4" @click="cancelarExclusao">Cancelar</button>
          <button class="bg-red-500 hover:bg-red-900 text-white font-bold py-2 px-4 rounded" @click="deletarProduto">Confirmar</button>
        </div>
      </div>
    </div>

    <div v-if="showModalEdicao && produtoEditado" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
        <div class="flex justify-between items-center px-6 py-3">
          <h2 class="text-xl font-semibold text-center flex-1">Editar Produto</h2>
          <button @click="fecharModalEdicao" class="text-gray-600 hover:text-gray-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        <div class="p-6">
          <div class="mb-4">
            <label class="block text-gray-700">Nome</label>
            <input v-model="produtoEditado.Nome" class="border border-gray-300 rounded px-3 py-2 w-full">
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Preço</label>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">R$</span>
              <input v-model="produtoEditado.Preço" @input="formatPrice" class="border border-gray-300 rounded py-2 pl-8 pr-3 w-full" type="text">
            </div>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Tipo</label>
            <input v-model="produtoEditado.Tipo" class="border border-gray-300 rounded px-3 py-2 w-full">
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Quantidade</label>
            <input v-model="produtoEditado.Quantidade" @input="validateQuantity" class="border border-gray-300 rounded px-3 py-2 w-full" type="number">
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Foto (URL)</label>
            <input v-model="produtoEditado.Foto" @input="onImageUrlChange" class="border border-gray-300 rounded px-3 py-2 w-full">
          </div>
          <div class="flex justify-center mt-6">
            <button class="bg-red-500 hover:bg-red-900 text-white font-bold py-2 px-4 rounded mr-4" @click="fecharModalEdicao">Cancelar</button>
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" @click="salvarEdicao">Salvar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { useToast } from 'vue-toastification';

export default {
  props: {
    product: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      showModalConfirmacao: false,
      showModalEdicao: false,
      produtoEditado: null
    };
  },
  setup() {
    const toast = useToast();
    return { toast };
  },
  methods: {
    fecharModal() {
      this.$emit('close');
    },
    confirmarExclusao() {
      this.showModalConfirmacao = true;
    },
    cancelarExclusao() {
      this.showModalConfirmacao = false;
    },
    deletarProduto() {
      const token = localStorage.getItem('authToken');
      if (!token) {
        return;
      }

      axios.delete(`http://localhost:8000/api/produtos/${this.product.id}`, {
        headers: {
          'Accept': 'application/json',
          Authorization: `Bearer ${token}`
        }
      })
      .then(response => {
        this.toast.success(`"${this.product.Nome}" deletado com sucesso.`);
        this.$emit('produto-deletado', this.product.id);
        this.fecharModal();
      })
      .catch(error => {
        this.toast.error('Erro ao deletar o produto.');
      });
    },
    handleEditar() {
      this.produtoEditado = { ...this.product };
      this.showModalEdicao = true;
    },
    salvarEdicao() {
      const token = localStorage.getItem('authToken');
      if (!token) {
        return;
      }

      const { id, Nome, Preço, Tipo, Quantidade, Foto } = this.produtoEditado;

      axios.put(`http://localhost:8000/api/produtos/${id}`, {
        nome: Nome,
        preco: Preço,
        tipo: Tipo,
        quantidade: Quantidade,
        foto: Foto
      }, {
        headers: {
          'Accept': 'application/json',
          Authorization: `Bearer ${token}`
        }
      })
      .then(response => {
        this.toast.success(`"${Nome}" atualizado com sucesso.`);
        this.$emit('produto-atualizado', id);
        this.fecharModalEdicao();
        this.fecharModal();
      })
      .catch(error => {
        this.toast.error('Erro ao atualizar o produto.');
      });
    },
    fecharModalEdicao() {
      this.showModalEdicao = false;
    },
    formatPrice(event) {
      let value = event.target.value;
      value = value.replace(/\D/g, '');
      value = (value / 100).toFixed(2);
      event.target.value = parseFloat(value).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
      this.produtoEditado.Preço = value;
    },
    validateQuantity(event) {
      let value = event.target.value;
      value = value.replace(/[^\d]/g, '');
      this.produtoEditado.Quantidade = parseInt(value, 10);
    },
   
    onImageUrlChange(event) {
      this.produtoEditado.Foto = event.target.value;
    },
    formatCurrency(value) {
      return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
      }).format(value);
    },
  }
};
</script>

<style scoped>
/* Estilos adicionais podem ser colocados aqui */
</style>
