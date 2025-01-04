<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use ApiResponses;

    //Mostrar libros
    public function index(Request $request)
    {
        $query = Book::with('author');

        // Filtrado
        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if ($request->has('author_name')) {
            $query->whereHas('author', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('author_name') . '%');
            });
        }

        // Ordenamiento
        if ($request->has('sort_by')) {
            $query->orderBy($request->input('sort_by'), $request->input('order', 'asc'));
        }

        // Paginación simplificada
        $books = $query->simplePaginate($request->input('per_page', 10));

        // Verificar si hay resultados
        if ($books->isEmpty()) {
            return $this->successResponse('No hay libros', [], 200);
        }

        return $this->successResponse('Libros encontrados', $books, 200);
    }

    //Crear libro
    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());
        return $this->successResponse('Libro creado correctamente', $book, 201);
    }

    //Mostrar libro por id
    public function show($id)
    {
        $book = Book::with('author')->find($id);

        if (!$book) {
            return $this->notFoundResponse('Libro no encontrado');
        }

        return $this->successResponse('Libro encontrado', $book, 200);
    }

    //Actualizar libro
    public function update(UpdateBookRequest $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return $this->notFoundResponse('Libro no encontrado');
        }

        $book->update($request->validated());
        return $this->successResponse('Libro actualizado correctamente', $book, 200);
    }

    //Eliminar libro
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return $this->notFoundResponse('Libro no encontrado');
        }

        $book->delete();
        return $this->successResponse('Libro eliminado correctamente', [], 200);
    }
}
