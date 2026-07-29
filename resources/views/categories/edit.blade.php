<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifier la catégorie</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('categories.update', $categorie) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nom</label>
                        <input type="text" name="nom" value="{{ old('nom', $categorie->nom) }}" class="w-full border rounded p-2">
                        @error('nom') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Description</label>
                        <textarea name="description" class="w-full border rounded p-2">{{ old('description', $categorie->description) }}</textarea>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Enregistrer</button>
                    <a href="{{ route('categories.index') }}" class="ml-2 text-gray-600">Annuler</a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>