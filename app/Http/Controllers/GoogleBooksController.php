<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleBooksController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('q'); // Asegúrate de que el nombre del parámetro coincide con el nombre del campo de entrada en tu formulario
        $client = new Client();

        try {
            $response = $client->request('GET', 'https://www.googleapis.com/books/v1/volumes', [
                'query' => [
                    'q' => $searchTerm,
                    'key' => config('services.google.api_key')
                ]
            ]);

            $books = json_decode($response->getBody()->getContents(), true);
            return view('catalogo.search-results', ['books' => $books]);
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Error al buscar libros: ' . $e->getMessage()]);
        }
    }
}