<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ProdutosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'Nome' => $this->nome,
            'Preço' => $this->preco,
            'Tipo' => $this->tipo,
            'Quantidade' => $this->quantidade,
            'Foto' => $this->foto,
            'DT_criação' => Carbon::parse($this->created_at)->format('d/m/Y H:i:s'),
            'DT_atualização' => Carbon::parse($this->updated_at)->format('d/m/Y H:i:s')
        ];
    }
}
