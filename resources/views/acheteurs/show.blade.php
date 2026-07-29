<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $acheteur->nom }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p><strong>Email :</strong> {{ $acheteur->email }}</p>
                <p><strong>Téléphone :</strong> {{ $acheteur->telephone }}</p>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold mb-2">Historique des achats</h3>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="p-2">Produit</th>
                            <th class="p-2">Quantité</th>
                            <th class="p-2">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($acheteur->achats as $achat)
                            <tr class="border-b">
                                <td class="p-2">{{ $achat->produit->nom }}</td>
                                <td class="p-2">{{ $achat->quantite }}</td>
                                <td class="p-2">{{ $achat->date_achat }}</td>
                            </tr>
                        @empty
                            <tr><td class="p-2" colspan="3">Aucun achat enregistré.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold mb-4">Enregistrer un nouvel achat</h3>

                <form action="{{ route('acheteurs.acheter', $acheteur) }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Produit</label>
                        <select name="produit_id" class="w-full border rounded p-2">
                            <option value="">-- Choisir --</option>
                            @foreach ($produits as $produit)
                                <option value="{{ $produit->id }}">{{ $produit->nom }} ({{ $produit->stock }} en stock)</option>
                            @endforeach
                        </select>
                        @error('produit_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Quantité</label>
                        <input type="number" name="quantite" min="1" value="1" class="w-full border rounded p-2">
                        @error('quantite') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Date d'achat</label>
                        <input type="date" name="date_achat" value="{{ date('Y-m-d') }}" class="w-full border rounded p-2">
                        @error('date_achat') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Enregistrer l'achat</button>
                </form>
            </div>

            <a href="{{ route('acheteurs.index') }}" class="inline-block text-gray-600">← Retour</a>
        </div>
    </div>
</x-app-layout>