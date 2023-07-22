<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use illuminate\Http\RedirectResponse;
use illuminate\Http\Response;
use illuminate\View\view;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $produtos =  produto::latest()->paginate(5);
        return view('produtos.index',compact('produtos'))
          ->with('1', (request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
       $request->validate([
        'descricao' => 'required',
        'qtd' => 'required',
        'precoUnitario' => 'required',
        'precoVenda' => 'required',

       ]);

       produto::create($request->all());

       return redirect()->route('produtos.index')
                        ->with('sucess','Produto criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto): View
    {
        return view('produtos.show',compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto): View
    {
        return view('produtos.edit',compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto): RedirectResponse
    {
        $request->validate([
            'descricao' => 'required',
            'qtd' => 'required',
            'precoUnitario' => 'required',
            'precoVenda' => 'required',
        ]);

        $produto->update($request->all());

        return redirect()->route('produtos.index')
                        ->with('success','Produto atualizado com sucesso.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto): RedirectResponse
    {
        $produto->delete();

        return redirect()->route('produtos.idex')
                        ->with('success','Produto excluido com sucesso.');
    }
}
