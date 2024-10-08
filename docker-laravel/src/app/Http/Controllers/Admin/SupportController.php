<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateItensDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\DTO\Supports\UpdateLocalizacaoDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItens;
use App\Http\Requests\StoreLocalizacao;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller{

    public function __construct(
        protected SupportService $service)
    {}

    public function index(Request $request){

        $supports = $this->service->paginate(
            page:$request->get('page',1),
            totalPerPage: $request->get('per_page', 1),
            filter: $request -> filter,
        );

        $filters=['filter'=> $request->get('filter', '')];

        return view('admin/supports/index', compact('supports', 'filters'));
    }

    public function show(string|int $id){

        // Support::find($id)
        // Support::where('id',$id)->first();
        // Support::where('id','!=',$id)->first();

        if(!$support = $this->service->findOne($id)){
            return back();
        }

        return view('admin/supports/show', compact('support'));

    }

    public function create(){
        return view('admin/supports/create');
    }

    public function store(StoreUpdateSupport $request, Support $support){

        $this->service->new(CreateSupportDTO::MakeFromRequest($request));


        return redirect()->route('supports.index');
    }


    public function edit(string|int $id){
        if(!$support = $this->service->findOne($id)){
            return back();
        }

        return view('admin/supports.edit',compact('support'));

    }

    public function editlocal(string|int $id){
        if(!$support = $this->service->findOne($id)){
            return back();
        }

        return view('admin/supports.editlocal',compact('support'));

    }

    public function additem(string|int $id){
        if(!$support = $this->service->findOne($id)){
            return back();
        }

        return view('admin/supports.additem',compact('support'));

    }

    public function updateitens(StoreItens $request,Support $support, string $id){

        $support = $this->service->updateitens(UpdateItensDTO::MakeFromRequest($request));

        if(!$support){
            return back();
        }

        // $support->subject = $request->subject;
        // $support->body = $request->body;
        // $support->save();

        return redirect()->route('supports.show', $id);

    }

    public function updatelocalizacao(StoreLocalizacao $request,Support $support, string $id){

        $support = $this->service->updatelocalizacao(UpdateLocalizacaoDTO::MakeFromRequest($request));

        if(!$support){
            return back();
        }

        // $support->subject = $request->subject;
        // $support->body = $request->body;
        // $support->save();



        return redirect()->route('supports.show', $id);

    }

    public function update(StoreUpdateSupport $request,Support $support, string $id){

        $support = $this->service->update(UpdateSupportDTO::MakeFromRequest($request));

        if(!$support){
            return back();
        }

        // $support->subject = $request->subject;
        // $support->body = $request->body;
        // $support->save();



        return redirect()->route('supports.index');

    }

    public function destroy(string $id){

        $this->service->delete($id);

        return redirect()->route('supports.index');
    }

    public function trocarItems(Request $request)
    {
        $support = $request->validate([
            'explorador1_id' => ['required', 'exists:exploradors,id'],
            'explorador2_id' => ['required', 'exists:exploradors,id'],
            'item_explorador1' => ['required', 'exists:items,id'],
            'item_explorador2' => ['required', 'exists:items,id'],
        ]);

        $explorador1_id = StoreUpdateSupport::find($request->explorador1_id);
        $explorador2_id = StoreUpdateSupport::find($request->explorador2_id);
        $itemExplorador1 = StoreItens::find($request->item_explorador1);
        $itemExplorador2 = StoreItens::find($request->item_explorador2);



        if ($itemExplorador1->explorador_id !== $explorador1_id->id) {
            return response()->json(['error' => 'Item não pertence ao Explorador 1.'], );
        }
        if ($itemExplorador2->explorador_id !== $explorador2_id->id) {
            return response()->json(['error' => 'Item não pertence ao Explorador 2.'], );
        }


        if ($itemExplorador1->valor !== $itemExplorador2->valor) {
            return response()->json(['error' => 'Os items devem ter o mesmo valor.'], );
        }

        $itemExplorador1->explorador_id = $explorador2_id->id;
        $itemExplorador2->explorador_id = $explorador1_id->id;
        $itemExplorador1->save();
        $itemExplorador2->save();

        return response()->json([
            'message' => 'Trocado com sucesso!',
            'explorador1' => [
                'id' => $explorador1_id->id,
                'nome' => $explorador1_id->name,
                'item_trocado' => $itemExplorador1,
            ],
            'explorador2' => [
                'id' => $explorador2_id->id,
                'nome' => $explorador2_id->name,
                'item_trocado' => $itemExplorador2,
            ],
        ]);

}
}
