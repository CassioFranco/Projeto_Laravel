<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\DTO\Supports\UpdateLocalizacaoDTO;
use App\Http\Controllers\Controller;
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
}


