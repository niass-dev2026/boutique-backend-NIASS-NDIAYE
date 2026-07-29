<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class ProduitController extends Controller
{
    #[OA\Get(
        path: "/produits",
        summary: "Lister tous les produits",
        tags: ["Produits"],
        responses: [new OA\Response(response: 200, description: "Liste des produits")]
    )]
    public function index()
    {
        return response()->json(Produit::with('categorie')->get());
    }

    #[OA\Post(
        path: "/produits",
        summary: "Créer un produit",
        tags: ["Produits"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["nom", "prix", "stock", "categorie_id"],
                properties: [
                    new OA\Property(property: "nom", type: "string", example: "Écouteurs Bluetooth"),
                    new OA\Property(property: "prix", type: "number", example: 25000),
                    new OA\Property(property: "stock", type: "integer", example: 15),
                    new OA\Property(property: "description", type: "string", example: "Sans fil, autonomie 8h"),
                    new OA\Property(property: "categorie_id", type: "integer", example: 1),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Produit créé"),
            new OA\Response(response: 422, description: "Erreur de validation")
        ]
    )]
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $produit = Produit::create($validated);

        return response()->json($produit->load('categorie'), 201);
    }

    #[OA\Get(
        path: "/produits/{id}",
        summary: "Afficher le détail d'un produit",
        tags: ["Produits"],
        parameters: [new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))],
        responses: [
            new OA\Response(response: 200, description: "Détail du produit"),
            new OA\Response(response: 404, description: "Produit non trouvé")
        ]
    )]
    public function show(Produit $produit)
    {
        $produit->load('categorie', 'acheteurs');
        return response()->json($produit);
    }

    #[OA\Put(
        path: "/produits/{id}",
        summary: "Modifier un produit",
        tags: ["Produits"],
        parameters: [new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "nom", type: "string", example: "Écouteurs Bluetooth"),
                    new OA\Property(property: "prix", type: "number", example: 25000),
                    new OA\Property(property: "stock", type: "integer", example: 15),
                    new OA\Property(property: "description", type: "string", example: "Sans fil, autonomie 8h"),
                    new OA\Property(property: "categorie_id", type: "integer", example: 1),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Produit modifié"),
            new OA\Response(response: 422, description: "Erreur de validation")
        ]
    )]
    public function update(Request $request, Produit $produit)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $produit->update($validated);

        return response()->json($produit->load('categorie'));
    }

    #[OA\Delete(
        path: "/produits/{id}",
        summary: "Supprimer un produit",
        tags: ["Produits"],
        parameters: [new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))],
        responses: [new OA\Response(response: 204, description: "Produit supprimé")]
    )]
    public function destroy(Produit $produit)
    {
        $produit->delete();
        return response()->json(null, 204);
    }
}