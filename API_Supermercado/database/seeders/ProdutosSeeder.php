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
                'nome' => 'Arroz Branco - Prato Fino',
                'preco' => 19.00,
                'tipo' => 'Alimento',
                'quantidade' => 3,
                'foto' => 'https://ibassets.com.br/ib.item.image.large/l-231f4e13e3b14fdba93a672ef17646e7.jpeg',
            ],
            [
                'nome' => 'Arroz Branco - Tio João',
                'preco' => 17.90,
                'tipo' => 'Alimento',
                'quantidade' => 5,
                'foto' => 'https://superprix.vteximg.com.br/arquivos/ids/174487-600-600/Arroz-Tio-Joao-Branco-1kg.png?v=636209529502870000',
            ],
            [
                'nome' => 'Arroz Branco - Tio Urbano',
                'preco' => 12.00,
                'tipo' => 'Alimento',
                'quantidade' => 7,
                'foto' => 'https://lojacentraldealimentos.com.br/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/t/i/tio_branco_5.png',
            ],
            [
                'nome' => 'Feijão Preto - Kicaldo',
                'preco' => 7.90,
                'tipo' => 'Alimento',
                'quantidade' => 11,
                'foto' => 'https://hiperideal.vtexassets.com/arquivos/ids/189112/165096.jpg?v=637528167673770000',
            ],
            [
                'nome' => 'Feijão Branco - Kicaldo',
                'preco' => 8.90,
                'tipo' => 'Alimento',
                'quantidade' => 13,
                'foto' => 'https://hiperideal.vtexassets.com/arquivos/ids/189107/14984.jpg?v=637528130777700000',
            ],
            [
                'nome' => 'Feijão Branco - Camil',
                'preco' => 8.90,
                'tipo' => 'Alimento',
                'quantidade' => 6,
                'foto' => 'https://s3-sa-east-1.amazonaws.com/superimg/img.produtos/7896006744115/img_1200_1.png',
            ],
            [
                'nome' => 'Detergente Ypê - Neutro',
                'preco' => 2.19,
                'tipo' => 'Limpeza',
                'quantidade' => 0,
                'foto' => 'https://a-static.mlcdn.com.br/450x450/detergente-liquido-ype-lava-loucas-neutro-500ml-embalagem-com-24-unidades/efacil/1709980/e49824e40fa56aabae218762bbff73c8.jpeg',
            ],
            [
                'nome' => 'Detergente Limpol - Cristal',
                'preco' => 2.19,
                'tipo' => 'Limpeza',
                'quantidade' => 5,
                'foto' => 'https://giassi.vtexassets.com/arquivos/ids/1157342/Detergente-Liquido-Cristal-Limpol-Squeeze-500ml.jpg?v=638509592578870000',
            ],
            [
                'nome' => 'Detergente Poti - Neutro',
                'preco' => 2.00,
                'tipo' => 'Limpeza',
                'quantidade' => 5,
                'foto' => 'https://images.tcdn.com.br/img/img_prod/613137/detergente_liquido_neutro_500ml_poti_1595_1_0f08cbd6c7219d47185a7b0e0bf3e32c.jpg',
            ],
            [
                'nome' => 'Sabão em Pó - Tixan Ypê',
                'preco' => 13.00,
                'tipo' => 'Limpeza',
                'quantidade' => 6,
                'foto' => 'https://cdn.awsli.com.br/800x800/1615/1615759/produto/68497522/6d9989215e.jpg',
            ],
            [
                'nome' => 'Sabão em Pó - Minuano',
                'preco' => 12.00,
                'tipo' => 'Limpeza',
                'quantidade' => 5,
                'foto' => 'https://acdn.mitiendanube.com/stores/001/289/535/products/404050_11-dffa5d70f31f0222ba16585163804836-1024-1024.png',
            ],
            [
                'nome' => 'Pasta de Dente - Colgate',
                'preco' => 3.00,
                'tipo' => 'Higiene',
                'quantidade' => 5,
                'foto' => 'https://i.zst.com.br/thumbs/12/2c/19/1953845152.jpg',
            ],
            [
                'nome' => 'Pasta de Dente - Oral B',
                'preco' => 4.50,
                'tipo' => 'Higiene',
                'quantidade' => 5,
                'foto' => 'https://static.paodeacucar.com/img/uploads/1/822/24974822.JPG',
            ],
            [
                'nome' => 'Sabonete - Protex',
                'preco' => 3.00,
                'tipo' => 'Higiene',
                'quantidade' => 5,
                'foto' => 'https://images.tcdn.com.br/img/img_prod/763758/sabonete_em_barra_protex_aveia_85g_11521_1_38fdbccaed20d88590785bc526699536.jpg',
            ],
            [
                'nome' => 'Sabonete - Francis',
                'preco' => 4.90,
                'tipo' => 'Higiene',
                'quantidade' => 4,
                'foto' => 'https://acdn.mitiendanube.com/stores/002/473/840/products/403275_11-3e2586f3ecddadfe5e16855466856011-1024-1024.png',
            ],
            [
                'nome' => 'Ração 15Kg Adulto - Pedigree',
                'preco' => 24.90,
                'tipo' => 'Pet',
                'quantidade' => 5,
                'foto' => 'https://cobasi.vteximg.com.br/arquivos/ids/1022627/Racao-Pedigree-Carne-Frango-e-Cereais-Caes-Adultos-Racas-Medias-e-Grandes-15-kg-1.jpg?v=638157734701200000',
            ],
            [
                'nome' => 'Ração Adulto - Gran Plus',
                'preco' => 17.90,
                'tipo' => 'Pet',
                'quantidade' => 4,
                'foto' => 'https://images.tcdn.com.br/img/img_prod/1059813/racao_gran_plus_choice_frango_e_carne_caes_adultos_15kg_27351_1_840f0a4657b6db484f8b73f4714a5455.png',
            ],
        ];

        // Insere os produtos no banco de dados
        foreach ($produtos as $produto) {
            Produtos::create($produto);
        }
    }
}
