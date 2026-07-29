<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Acheteur;
use App\Models\Achat;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class AcheteurController extends Controller
{
    #[OA\Get(
        path: "/acheteurs",
        summary: "Lister tous les acheteurs",
        tags: ["Acheteurs"],
        responses: [new OA\Response(response: 200, description: "Liste des acheteurs")]
    )]
    public function index()
    {
        return response()->json(Acheteur::withCount('achats')->get());
    }

    #[OA\Post(
        path: "/acheteurs",
        summary: "Créer un acheteur",
        tags: ["Acheteurs"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["nom", "email"],
                properties: [
                    new OA\Property(property: "nom", type: "string", example: "Moussa Sarr"),
                    new OA\Property(property: "email", type: "string", example: "moussa.sarr@example.com"),
                    new OA\Property(property: "telephone", type: "string", example: "781234567"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Acheteur créé"),
            new OA\Response(response: 422, description: "Erreur de validation")
        ]
    )]
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:acheteurs,email',
            'telephone' => 'nullable|string|max:20',
        ]);

        $acheteur = Acheteur::create($validated);

        return response()->json($acheteur, 201);
    }

    #[OA\Get(
        path: "/acheteurs/{id}",
        summary: "Afficher le détail d'un acheteur",
        tags: ["Acheteurs"],
        parameters: [new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))],
        responses: [
            new OA\Response(response: 200, description: "Détail de l'acheteur avec historique d'achats"),
            new OA\Response(response: 404, description: "Acheteur non trouvé")
        ]
    )]
    public function show(Acheteur $acheteur)
    {
        $acheteur->load('achats.produit');
        return response()->json($acheteur);
    }

    #[OA\Put(
        path: "/acheteurs/{id}",
        summary: "Modifier un acheteur",
        tags: ["Acheteurs"],
        parameters: [new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "nom", type: "string", example: "Moussa Sarr"),
                    new OA\Property(property: "email", type: "string", example: "moussa.sarr@example.com"),
                    new OA\Property(property: "telephone", type: "string", example: "781234567"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Acheteur modifié"),
            new OA\Response(response: 422, description: "Erreur de validation")
        ]
    )]
    public function update(Request $request, Acheteur $acheteur)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:acheteurs,email,' . $acheteur->id,
            'telephone' => 'nullable|string|max:20',
        ]);

        $acheteur->update($validated);

        return response()->json($acheteur);
    }

    #[OA\Delete(
        path: "/acheteurs/{id}",
        summary: "Supprimer un acheteur",
        tags: ["Acheteurs"],
        parameters: [new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))],
        responses: [new OA\Response(response: 204, description: "Acheteur supprimé")]
    )]
    public function destroy(Acheteur $acheteur)
    {
        $acheteur->delete();
        return response()->json(null, 204);
    }

    #[OA\Post(
        path: "/acheteurs/{id}/acheter",
        summary: "Enregistrer un achat pour cet acheteur",
        tags: ["Acheteurs"],
        parameters: [new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["produit_id", "quantite", "date_achat"],
                properties: [
                    new OA\Property(property: "produit_id", type: "integer", example: 1),
                    new OA\Property(property: "quantite", type: "integer", example: 2),
                    new OA\Property(property: "date_achat", type: "string", format: "date", example: "2026-07-28"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Achat enregistré"),
            new OA\Response(response: 422, description: "Erreur de validation")
        ]
    )]
    public function acheter(Request $request, Acheteur $acheteur)
    {
        $validated = $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
            'date_achat' => 'required|date',
        ]);

        $achat = Achat::create([
            'produit_id' => $validated['produit_id'],
            'acheteur_id' => $acheteur->id,
            'quantite' => $validated['quantite'],
            'date_achat' => $validated['date_achat'],
        ]);

        return response()->json($achat->load('produit'), 201);
    }
}