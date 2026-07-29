<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class CategorieController extends Controller
{
    #[OA\Get(
        path: "/categories",
        summary: "Lister toutes les catégories",
        tags: ["Catégories"],
        responses: [
            new OA\Response(response: 200, description: "Liste des catégories")
        ]
    )]
    public function index()
    {
        return response()->json(Categorie::withCount('produits')->get());
    }

    #[OA\Post(
        path: "/categories",
        summary: "Créer une catégorie",
        tags: ["Catégories"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["nom"],
                properties: [
                    new OA\Property(property: "nom", type: "string", example: "Vêtements"),
                    new OA\Property(property: "description", type: "string", example: "Habits et accessoires"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Catégorie créée"),
            new OA\Response(response: 422, description: "Erreur de validation")
        ]
    )]
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:categories,nom',
            'description' => 'nullable|string',
        ]);

        $categorie = Categorie::create($validated);

        return response()->json($categorie, 201);
    }

    #[OA\Get(
        path: "/categories/{id}",
        summary: "Afficher le détail d'une catégorie",
        tags: ["Catégories"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Détail de la catégorie"),
            new OA\Response(response: 404, description: "Catégorie non trouvée")
        ]
    )]
    public function show(Categorie $categorie)
    {
        $categorie->load('produits');
        return response()->json($categorie);
    }

    #[OA\Put(
        path: "/categories/{id}",
        summary: "Modifier une catégorie",
        tags: ["Catégories"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "nom", type: "string", example: "Vêtements"),
                    new OA\Property(property: "description", type: "string", example: "Habits et accessoires"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Catégorie modifiée"),
            new OA\Response(response: 422, description: "Erreur de validation")
        ]
    )]
    public function update(Request $request, Categorie $categorie)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:categories,nom,' . $categorie->id,
            'description' => 'nullable|string',
        ]);

        $categorie->update($validated);

        return response()->json($categorie);
    }

    #[OA\Delete(
        path: "/categories/{id}",
        summary: "Supprimer une catégorie",
        tags: ["Catégories"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 204, description: "Catégorie supprimée")
        ]
    )]
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return response()->json(null, 204);
    }
}