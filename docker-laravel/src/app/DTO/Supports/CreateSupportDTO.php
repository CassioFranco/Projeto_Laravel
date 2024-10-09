<?php

namespace App\DTO\supports;

use App\Enums\SupportStatus;
use App\Http\Requests\StoreUpdateSupport;

class CreateSupportDTO{

    public function __construct(
        public string $nome,
        public SupportStatus $status,
        public string $idade,



        ){



    }

    public static function MakeFromRequest(StoreUpdateSupport $request): self{
        return new self (
            $request->nome,
            SupportStatus::A,
            $request->idade,


        );
    }
}
