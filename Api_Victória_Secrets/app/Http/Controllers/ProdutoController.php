<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function index()
    {
        return response()->json(Produto::all());
    }

    public function show($id)
    {
        $produto = Produto::find($id);
        return $produto
            ? response()->json($produto)
            : response()->json(['error' => 'Produto não encontrado'], 404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'categoria' => 'nullable|string|max:100',
            'imagem' => 'nullable|image|max:2048'
        ]);

        $path = null;
        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('produtos', 'public');
        }

        $produto = Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'categoria' => $request->categoria ?? 'Lingerie',
            'imagem' => $path,
        ]);

        return response()->json($produto, 201);
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);
        if (!$produto) return response()->json(['error' => 'Produto não encontrado'], 404);

        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'sometimes|required|numeric',
            'categoria' => 'nullable|string|max:100',
            'imagem' => 'nullable|image|max:2048'
        ]);

        $produto->fill($request->only(['nome', 'descricao', 'preco', 'categoria']));

        if ($request->hasFile('imagem')) {
            if ($produto->imagem) Storage::disk('public')->delete($produto->imagem);
            $produto->imagem = $request->file('imagem')->store('produtos', 'public');
        }

        $produto->save();

        return response()->json($produto);
    }

    public function destroy($id)
    {
        $produto = Produto::find($id);
        if (!$produto) return response()->json(['error' => 'Produto não encontrado'], 404);

        if ($produto->imagem) Storage::disk('public')->delete($produto->imagem);
        $produto->delete();

        return response()->json(['message' => 'Produto deletado com sucesso']);
    }
}
