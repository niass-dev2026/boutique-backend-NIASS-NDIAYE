<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $categorie->nom }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <p class="mb-4 text-gray-600">{{ $categorie->description }}</p>

                <h3 class="font-semibold mb-2">Produits dans cette catégorie</h3>
                <ul class="list-disc pl-5">
                    @forelse ($categorie->produits as $produit)
                        <li>{{ $produit->nom }} — {{ number_format($produit->prix, 0, ',', ' ') }} FCFA</li>
                    @empty
                        <li>Aucun produit dans cette catégorie.</li>
                    @endforelse
                </ul>

                <a href="{{ route('categories.index') }}" class="inline-block mt-4 text-gray-600">← Retour</a>
            </div>
        </div>
    </div>
</x-app-layout>