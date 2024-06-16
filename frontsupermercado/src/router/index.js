import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/HomeView.vue'; // Ajuste o caminho conforme necessário
import Produtos from '../views/ProdutosView.vue'; // Ajuste o caminho conforme necessário
import Login from '../views/LoginView.vue';
import Registrar from '../views/RegistrarView.vue';
import Cadastrar from '../views/CadastrarProdutosView.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/produtos',
    name: 'Produtos',
    component: Produtos
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/registrar',
    name: 'Registrar',
    component: Registrar
  },
  {
    path: '/cadastrar',
    name: 'Cadastrar',
    component: Cadastrar
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL), // Use import.meta.env.BASE_URL
  routes
});

export default router;
