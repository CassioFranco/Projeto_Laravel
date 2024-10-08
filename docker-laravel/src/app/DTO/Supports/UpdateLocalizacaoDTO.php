<?php

namespace App\DTO\Supports;

use App\Enums\SupportStatus;
use App\Http\Requests\StoreLocalizacao;


class UpdateLocalizacaoDTO{

    public function __construct(
        public $id,
        public SupportStatus $status,
        public string $latitude,
        public string $longitude,
        ){

    }

    public static function MakeFromRequest(StoreLocalizacao $request, string $id =null): self{
        return new self (
            $id ?? $request->id,
            SupportStatus::A,
            $request->latitude,
            $request->longitude,
        );

    }
}
