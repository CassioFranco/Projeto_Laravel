<?php

namespace App\DTO\Supports;

use App\Enums\SupportStatus;
use App\Http\Requests\StoreUpdateSupport;

class UpdateSupportDTO{

    public function __construct(
        public $id,
        public string $nome,
        public SupportStatus $status,
        public string $idade,
        public string $latitude,
        public string $longitude,
        public string $inventario
        ){

    }

    public static function MakeFromRequest(StoreUpdateSupport $request, string $id =null): self{
        return new self (
            $id ?? $request->id,
            $request->nome,
            SupportStatus::A,
            $request->idade,
            $request->latitude,
            $request->longitude,
            $request->inventario,
        );

    }
}
