<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    use HttpResponses;

    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos ou Faltando', 422, $validator->errors());
        }

        $created = User::create($validator->validated());

        if ($created) {
            return $this->response('Usuário Cadastrado', 200, $created);
        }
        return $this->error('Usuário não Cadastrado', 400);
    }


    public function show($id)
    {
        return new UserResource(User::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
       $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
       ]);

       if($validator->fails()){
        return $this->error('Validação dos dados falhou', 422, $validator->errors());
       }

       $validated = $validator->validated();

       $updated = User::find($id)->update([
        'name' => $validated['name'],
        'email' =>  $validated['email'],
        'password' =>  $validated['password'],
       ]);

       if($updated){
        return $this->response('Usuário Atualizado com Sucesso', 200, $request->all());
       }

       return $this->error('Usuário não atualizado', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->error('Usuário não encontrado', 404);
        }

        $deleted = $user->delete();

        if ($deleted) {
            return $this->response('Usuário deletado com sucesso', 200);
        }

        return $this->error('Usuário não deletado', 400);
    }
}