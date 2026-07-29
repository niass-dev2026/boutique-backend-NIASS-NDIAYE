<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nouveau produit</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('produits.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nom</label>
                        <input type="text" name="nom" value="{{ old('nom') }}" class="w-full border rounded p-2">
                        @error('nom') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Prix (FCFA)</label>
                        <input type="number" step="0.01" name="prix" value="{{ old('prix') }}" class="w-full border rounded p-2">
                        @error('prix') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Stock</label>
                        <input type="number" name="stock" value="{{ old('stock') }}" class="w-full border rounded p-2">
                        @error('stock') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Catégorie</label>
                        <select name="categorie_id" class="w-full border rounded p-2">
                            <option value="">-- Choisir --</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}" @selected(old('categorie_id') == $categorie->id)>
                                    {{ $categorie->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('categorie_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Description</label>
                        <textarea name="description" class="w-full border rounded p-2">{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Créer</button>
                    <a href="{{ route('produits.index') }}" class="ml-2 text-gray-600">Annuler</a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>