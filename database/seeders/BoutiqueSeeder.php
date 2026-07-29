<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Acheteur;
use App\Models\Achat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BoutiqueSeeder extends Seeder
{
    public function run(): void
    {
        // Comptes de test
        User::create([
            'name' => 'Admin',
            'email' => 'admin@boutique.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Gestionnaire',
            'email' => 'gestionnaire@boutique.com',
            'password' => Hash::make('password123'),
            'role' => 'gestionnaire',
        ]);

        User::create([
            'name' => 'Employé',
            'email' => 'employe@boutique.com',
            'password' => Hash::make('password123'),
            'role' => 'employe',
        ]);

        // Catégories
        $electronique = Categorie::create([
            'nom' => 'Électronique',
            'description' => 'Appareils électroniques et accessoires',
        ]);

        $alimentation = Categorie::create([
            'nom' => 'Alimentation',
            'description' => 'Produits alimentaires divers',
        ]);

        // Produits
        $telephone = Produit::create([
            'nom' => 'Téléphone Samsung A15',
            'prix' => 150000,
            'stock' => 20,
            'description' => 'Smartphone Android double SIM',
            'categorie_id' => $electronique->id,
        ]);

        Produit::create([
            'nom' => 'Riz parfumé 25kg',
            'prix' => 18500,
            'stock' => 50,
            'description' => 'Sac de riz parfumé importé',
            'categorie_id' => $alimentation->id,
        ]);

        // Acheteur
        $acheteur = Acheteur::create([
            'nom' => 'Fatou Diop',
            'email' => 'fatou.diop@example.com',
            'telephone' => '771234567',
        ]);

        // Achat
        Achat::create([
            'quantite' => 1,
            'date_achat' => now(),
            'produit_id' => $telephone->id,
            'acheteur_id' => $acheteur->id,
        ]);
    }
}