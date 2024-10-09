<?php

namespace App\Http\Controllers\Api;

use App\Adapters\ApiAdapter;
use App\DTO\supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItens;
use App\Http\Requests\StoreUpdateSupport;
use App\Http\Resources\SupportResource;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(
        protected SupportService $service,
    )
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $supports = $this->service->paginate(
            page:$request->get('page',1),
            totalPerPage: $request->get('per_page', 1),
            filter: $request -> filter,
        );

        return ApiAdapter::toJson($supports);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateSupport $request)
    {
        $support = $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );

        return new SupportResource($support);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$support = $this->service->findOne($id)){
            return response()->json([
                'error' => 'Not Found'
            ],404);
        }

        return new SupportResource($support);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSupport $request, string $id)
    {
        $support = $this->service->update(
            UpdateSupportDTO::MakeFromRequest($request,$id)
        );

        if(!$support){
            return response()->json([
                'error' => 'Not Found'
            ],404);
        }

        return new SupportResource($support);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!$this->service->findOne($id)){
            return response()->json([
                'error' => 'Not Found'
            ],404);
        }

        $this->service->delete($id);
        return response()->json([],204);


    }

    public function trocarItems(Request $request): JsonResponse

    {
        $troca = $request->validate([
            'explorador1_id' => ['required', 'exists:supports,id'],
            'explorador2_id' => ['required', 'exists:supports,id'],

        ]);

        $explorador1_id = Support::find($request->explorador1_id);
        $explorador2_id = Support::find($request->explorador2_id);

        $auxiliar = $explorador1_id;
        $explorador1_id = $explorador2_id;
        $explorador2_id = $auxiliar;


        $explorador1_id->save();
        $explorador2_id->save();

        return response()->json([
            'message' => 'Trocado com sucesso!',
            'explorador1' => [
                'id' => $explorador1_id->id,
                'nome' => $explorador1_id->name,

            ],
            'explorador2' => [
                'id' => $explorador2_id->id,
                'nome' => $explorador2_id->name,

            ],
        ]);

}
}
