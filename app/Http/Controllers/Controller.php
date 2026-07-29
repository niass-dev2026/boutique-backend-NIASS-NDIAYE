<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "API Gestion de boutique",
    description: "API REST pour la gestion des catégories, produits, acheteurs et achats — CCP 2026"
)]
#[OA\Server(
    url: "http://127.0.0.1:8000/api",
    description: "Serveur local de développement"
)]
abstract class Controller
{
    //
}