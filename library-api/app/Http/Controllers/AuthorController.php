<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
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
            return response()->json([
                'message' => 'No authors found',
                'data' => [],
            ], 200);
        }
    
        return response()->json($authors, 200);
    }
    


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'nationality' => 'required|string|max:255',
        ]);

        $author = Author::create($validated);

        return response()->json($author, 201);
    }

    public function show($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['error' => 'Author not found'], 404);
        }

        return response()->json($author, 200);
    }

    public function update(Request $request, $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['error' => 'Author not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'birthdate' => 'sometimes|date',
            'nationality' => 'sometimes|string|max:255',
        ]);

        $author->update($validated);

        return response()->json($author, 200);
    }

    public function destroy($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['error' => 'Author not found'], 404);
        }

        $author->delete();

        return response()->json(['message' => 'Author deleted successfully'], 200);
    }
}
