<?php

namespace App\DTO\Supports;

use App\Enums\SupportStatus;
use App\Http\Requests\StoreItens;



class UpdateItensDTO{

    public function __construct(
        public $id,
        public SupportStatus $status,
        public string $inventario
        ){

    }

    public static function MakeFromRequest(StoreItens $request, string $id =null): self{
        return new self (
            $id ?? $request->id,
            SupportStatus::A,
            $request->inventario,
        );

    }
}
