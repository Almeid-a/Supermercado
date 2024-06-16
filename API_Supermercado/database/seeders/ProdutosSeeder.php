<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produtos;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Produtos fictícios de exemplo
        $produtos = [
            [
                'nome' => 'Arroz',
                'preco' => 9.99,
                'tipo' => 'Alimento',
                'quantidade' => 100,
                'foto' => 'arroz.jpg',
            ],
            [
                'nome' => 'Feijão',
                'preco' => 6.50,
                'tipo' => 'Alimento',
                'quantidade' => 80,
                'foto' => 'feijao.jpg',
            ],
            [
                'nome' => 'Sabonete',
                'preco' => 2.99,
                'tipo' => 'Higiene',
                'quantidade' => 120,
                'foto' => 'sabonete.jpg',
            ],
            [
                'nome' => 'Detergente',
                'preco' => 4.75,
                'tipo' => 'Limpeza',
                'quantidade' => 90,
                'foto' => 'detergente.jpg',
            ],
            [
                'nome' => 'Shampoo',
                'preco' => 12.99,
                'tipo' => 'Higiene',
                'quantidade' => 60,
                'foto' => 'shampoo.jpg',
            ],
            [
                'nome' => 'Leite',
                'preco' => 3.49,
                'tipo' => 'Alimento',
                'quantidade' => 70,
                'foto' => 'leite.jpg',
            ],
            [
                'nome' => 'Cereal',
                'preco' => 8.25,
                'tipo' => 'Alimento',
                'quantidade' => 50,
                'foto' => 'cereal.jpg',
            ],
            [
                'nome' => 'Lâmpada',
                'preco' => 15.99,
                'tipo' => 'Elétrico',
                'quantidade' => 40,
                'foto' => 'lampada.jpg',
            ],
            [
                'nome' => 'Biscoitos',
                'preco' => 4.49,
                'tipo' => 'Alimento',
                'quantidade' => 110,
                'foto' => 'biscoitos.jpg',
            ],
            [
                'nome' => 'Escova de Dentes',
                'preco' => 3.75,
                'tipo' => 'Higiene',
                'quantidade' => 85,
                'foto' => 'escova_de_dentes.jpg',
            ],
        ];

        // Insere os produtos no banco de dados
        foreach ($produtos as $produto) {
            Produtos::create($produto);
        }
    }
}
