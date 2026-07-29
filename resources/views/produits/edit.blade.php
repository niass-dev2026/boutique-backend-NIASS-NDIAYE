<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifier le produit</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('produits.update', $produit) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nom</label>
                        <input type="text" name="nom" value="{{ old('nom', $produit->nom) }}" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Prix (FCFA)</label>
                        <input type="number" step="0.01" name="prix" value="{{ old('prix', $produit->prix) }}" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Stock</label>
                        <input type="number" name="stock" value="{{ old('stock', $produit->stock) }}" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Catégorie</label>
                        <select name="categorie_id" class="w-full border rounded p-2">
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}" @selected(old('categorie_id', $produit->categorie_id) == $categorie->id)>
                                    {{ $categorie->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Description</label>
                        <textarea name="description" class="w-full border rounded p-2">{{ old('description', $produit->description) }}</textarea>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Enregistrer</button>
                    <a href="{{ route('produits.index') }}" class="ml-2 text-gray-600">Annuler</a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>