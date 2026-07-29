<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $produit->nom }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <p><strong>Prix :</strong> {{ number_format($produit->prix, 0, ',', ' ') }} FCFA</p>
                <p><strong>Stock :</strong> {{ $produit->stock }}</p>
                <p><strong>Catégorie :</strong> {{ $produit->categorie->nom }}</p>
                <p class="mb-4"><strong>Description :</strong> {{ $produit->description }}</p>

                <h3 class="font-semibold mb-2">Acheteurs de ce produit</h3>
                <ul class="list-disc pl-5">
                    @forelse ($produit->acheteurs as $acheteur)
                        <li>{{ $acheteur->nom }} — quantité : {{ $acheteur->pivot->quantite }} le {{ $acheteur->pivot->date_achat }}</li>
                    @empty
                        <li>Aucun acheteur pour ce produit.</li>
                    @endforelse
                </ul>

                <a href="{{ route('produits.index') }}" class="inline-block mt-4 text-gray-600">← Retour</a>
            </div>
        </div>
    </div>
</x-app-layout>