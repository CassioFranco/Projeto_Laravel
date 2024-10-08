<?php

namespace App\Repositories;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateItensDTO;
use App\DTO\Supports\UpdateLocalizacaoDTO;
use App\DTO\Supports\UpdateSupportDTO;
use stdClass;

interface SupportRepositoryinterface{

    public function paginate(int $page=1, int $totalPerPage=15, string $filter=null): PaginationInterface;
    public function getAll(string $filter=null): array;
    public function findOne(string $id): stdClass|null;
    public function delete(string $id): void;
    public function new(CreateSupportDTO $dto): stdClass;
    public function update(UpdateSupportDTO $dto): stdClass|null;
    public function updatelocalizacao(UpdateLocalizacaoDTO $dto): stdClass|null;
    public function updateitens(UpdateItensDTO $dto): stdClass|null;

}
