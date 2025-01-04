<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    use ApiResponses;
    //Mostrar autores
    public function index(Request $request)
    {
        $query = Author::query();

        // Filtrado
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('nationality')) {
            $query->where('nationality', 'like', '%' . $request->input('nationality') . '%');
        }

        // Ordenamiento
        if ($request->has('sort_by')) {
            $query->orderBy($request->input('sort_by'), $request->input('order', 'asc'));
        }

        // Paginación simplificada
        $authors = $query->simplePaginate($request->input('per_page', 10));

        // Verificar si hay datos
        if ($authors->isEmpty()) {
            return $this->successResponse('No hay autores', [], 200);
        }

        return $this->successResponse('Autores encontrados', $authors, 200);
    }
    //Crear autor
    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create($request->validated());
        return $this->successResponse('Autor creado correctamente', $author, 201);
    }
    //Mostrar autor por id
    public function show($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return $this->notFoundResponse('Autor no encontrado');
        }

        return $this->successResponse('Autor encontrado', $author, 200);
    }
    //Actualizar autor
    public function update(UpdateAuthorRequest $request, $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return $this->notFoundResponse('Autor no encontrado');
        }

        $author->update($request->validated());
        return $this->successResponse('Autor actualizado correctamente', $author, 200);
    }
    //Eliminar autor
    public function destroy($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return $this->notFoundResponse('Autor no encontrado');
        }

        $author->delete();
        return $this->successResponse('Autor eliminado correctamente', [], 200);
    }
}
