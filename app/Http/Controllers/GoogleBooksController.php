<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class GoogleBooksController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('q');
        $client = new Client();

        try {
            $response = $client->request('GET', 'https://www.googleapis.com/books/v1/volumes', [
                'query' => [
                    'q' => $searchTerm,
                    'key' => config('services.google.api_key')
                ]
            ]);

            $books = json_decode($response->getBody()->getContents(), true);

            // Seleccionar la vista basada en el estado de autenticación del usuario
            $view = Auth::check() ? 'catalogo.search-results-logged' : 'catalogo.search-results';

            return view($view, ['books' => $books]);
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Error al buscar libros: ' . $e->getMessage()]);
        }
    }
}