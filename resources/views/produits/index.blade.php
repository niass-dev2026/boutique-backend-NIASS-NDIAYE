<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Produits</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if (in_array(auth()->user()->role, ['gestionnaire', 'admin']))
                    <a href="{{ route('produits.create') }}" class="inline-block mb-4 px-4 py-2 bg-indigo-600 text-white rounded">
                        + Nouveau produit
                    </a>
                @endif

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="p-2">Nom</th>
                            <th class="p-2">Prix</th>
                            <th class="p-2">Stock</th>
                            <th class="p-2">Catégorie</th>
                            <th class="p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produits as $produit)
                            <tr class="border-b">
                                <td class="p-2">{{ $produit->nom }}</td>
                                <td class="p-2">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</td>
                                <td class="p-2">{{ $produit->stock }}</td>
                                <td class="p-2">{{ $produit->categorie->nom }}</td>
                                <td class="p-2 space-x-2">
                                    <a href="{{ route('produits.show', $produit) }}" class="text-blue-600">Voir</a>

                                    @if (in_array(auth()->user()->role, ['gestionnaire', 'admin']))
                                        <a href="{{ route('produits.edit', $produit) }}" class="text-yellow-600">Modifier</a>
                                        <form action="{{ route('produits.destroy', $produit) }}" method="POST" class="inline" onsubmit="return confirm('Confirmer la suppression ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600">Supprimer</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>