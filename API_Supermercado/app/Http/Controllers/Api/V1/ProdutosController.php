<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProdutosResource;
use App\Models\Produtos;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutosController extends Controller
{

    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProdutosResource::collection(Produtos::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'tipo' => 'required|string|max:255',
            'quantidade' => 'required|integer',
            'foto' => 'nullable|string|max:255',
        ]);

        // Verifica se a validação falhou
        if ($validator->fails()) {
            return $this->error('Dados inválidos', 422, $validator->errors());
        }

        $created = Produtos::create($validator->validated());

        if ($created) {
            return $this->response('Produto Cadastrado', 200, $created);
        }
        return $this->error('Produto não Cadastrado', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new ProdutosResource(Produtos::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       $validator = Validator::make($request->all(), [
        'nome' => 'required|string|max:255',
        'preco' => 'required|numeric',
        'tipo' => 'required|string|max:255',
        'quantidade' => 'required|integer',
        'foto' => 'nullable|string|max:255',
       ]);

       if($validator->fails()){
        return $this->error('Validação dos dados falhou', 422, $validator->errors());
       }

       $validated = $validator->validated();

       $updated = Produtos::find($id)->update([
        'nome' => $validated['nome'],
        'preco' =>  $validated['preco'],
        'tipo' =>  $validated['tipo'],
        'quantidade' =>  $validated['quantidade'],
        'foto' =>  $validated['foto'],
       ]);

       if($updated){
        return $this->response('Produto Atualizado com Sucesso', 200, $request->all());
       }

       return $this->error('Produto não atualizado', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produtos = Produtos::find($id);

        if (!$produtos) {
            return $this->error('Produto não encontrado', 404);
        }

        // Tenta deletar o usuário
        $deleted = $produtos->delete();

        if ($deleted) {
            return $this->response('Produto deletado com sucesso', 200);
        }

        return $this->error('Produto não deletado', 400);
    }
}