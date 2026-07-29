<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catégories</h2>
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
                    <a href="{{ route('categories.create') }}" class="inline-block mb-4 px-4 py-2 bg-indigo-600 text-white rounded">
                        + Nouvelle catégorie
                    </a>
                @endif

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="p-2">Nom</th>
                            <th class="p-2">Description</th>
                            <th class="p-2">Nb produits</th>
                            <th class="p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $categorie)
                            <tr class="border-b">
                                <td class="p-2">{{ $categorie->nom }}</td>
                                <td class="p-2">{{ $categorie->description }}</td>
                                <td class="p-2">{{ $categorie->produits_count }}</td>
                                <td class="p-2 space-x-2">
                                    <a href="{{ route('categories.show', $categorie) }}" class="text-blue-600">Voir</a>

                                    @if (in_array(auth()->user()->role, ['gestionnaire', 'admin']))
                                        <a href="{{ route('categories.edit', $categorie) }}" class="text-yellow-600">Modifier</a>
                                        <form action="{{ route('categories.destroy', $categorie) }}" method="POST" class="inline" onsubmit="return confirm('Confirmer la suppression ?');">
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