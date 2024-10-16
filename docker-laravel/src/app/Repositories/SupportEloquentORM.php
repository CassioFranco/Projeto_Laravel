<?php

namespace App\Repositories;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateItensDTO;
use App\DTO\Supports\UpdateLocalizacaoDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Models\Support;
use App\Repositories\SupportRepositoryinterface;
use App\Repositories\PaginationInterface;
use stdClass;

class SupportEloquentORM implements SupportRepositoryinterface {

    public function __construct(protected Support $model){

    }

    public function paginate(int $page=1, int $totalPerPage=15, string $filter=null): PaginationInterface{

        $result = $this->model
                    ->where(function($query) use ($filter){
                        if ($filter) {
                            $query->where('nome',$filter);
                            $query->orWhere('idade','like',"%{$filter}%");
                        }
                    })
                    ->paginate($totalPerPage, ['*'], 'page', $page);

        return new PaginationPresenter($result);
    }

    public function getAll(string $filter=null): array{

        return $this->model
                    ->where(function($query) use ($filter){
                        if ($filter) {
                            $query->where('nome',$filter);
                            $query->orWhere('idade','like',"%{$filter}%");
                        }
                    })
                    ->get()
                    ->toArray();
    }

    public function findOne(string $id): stdClass|null{

        $support = $this->model->find($id);
        if(!$support){
            return null;
        }

        return (object)$support->toArray();
    }

    public function delete(string $id): void{

        $this->model->findOrFail($id)->delete();
    }

    public function new(CreateSupportDTO $dto): stdClass{

        $support = $this->model->create(
            (array) $dto

        );

        return (object) $support->toArray();

    }
    public function update(UpdateSupportDTO $dto): stdClass|null{

        if (!$support= $this->model->find($dto->id)){
            return null;
        }

        $support -> update(
            (array) $dto
        );
        return(object) $support->toArray();
    }

    public function updatelocalizacao(UpdateLocalizacaoDTO $dto): stdClass|null{

        if (!$support= $this->model->find($dto->id)){
            return null;
        }

        $support -> update(
            (array) $dto
        );
        return(object) $support->toArray();
    }

    public function updateitens(UpdateItensDTO $dto): stdClass|null{

        if (!$support= $this->model->find($dto->id)){
            return null;
        }

        $support -> update(
            (array) $dto
        );
        return(object) $support->toArray();
    }

}
