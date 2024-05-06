<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class OpenLibraryBooksController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('q');
        $searchType = $request->input('type', 'all');
        $page = $request->input('page', 1);
        $maxResults = 6; // Número de resultados por página
        $offset = ($page - 1) * $maxResults; // Cálculo del desplazamiento para la paginación
        $searchField = $this->determineSearchField($searchType);
    
        $cacheKey = "search_{$searchField}_{$searchTerm}_page_{$page}";
        $client = new Client();
    
        try {
            $books = Cache::remember($cacheKey, 3600, function () use ($client, $searchField, $searchTerm, $page, $maxResults, $offset) {
                $response = $client->request('GET', 'https://openlibrary.org/search.json', [
                    'query' => [
                        'q' => $searchField . $searchTerm,
                        'page' => $page,
                        'limit' => $maxResults,
                        'offset' => $offset
                    ]
                ]);
                return json_decode($response->getBody()->getContents(), true);
            });
    
            if (isset($books['error'])) {
                Log::error('Open Library API Error:', [$books['error']]);
                throw new \Exception("Open Library API returned an error: " . $books['error']['message']);
            }
    
            $covers = $this->fetchCovers($books['docs'], $client);
    
            $totalItems = $books['numFound'];
            $paginator = new LengthAwarePaginator(
                $books['docs'],
                $totalItems,
                $maxResults,
                $page,
                [
                    'path' => $request->url(),
                    'query' => $request->query() // Para mantener los parámetros de búsqueda en la paginación
                ]
            );
    
            if (Auth::check()) {
                // Si el usuario está autenticado, devuelve la vista para usuarios logueados
                return view('catalogo.search-results-logged', [
                    'books' => $paginator,
                    'covers' => $covers,
                    'searchTerm' => $searchTerm,
                    'searchType' => $searchType
                ]);
            } else {
                // Si el usuario no está autenticado, devuelve la vista para usuarios no logueados
                return view('catalogo.search-results', [
                    'books' => $paginator,
                    'covers' => $covers,
                    'searchTerm' => $searchTerm,
                    'searchType' => $searchType
                ]);
            }
    
        } catch (\Exception $e) {
            Log::error('Search exception:', ['message' => $e->getMessage()]);
            return back()->withErrors(['msg' => 'Error al buscar libros: ' . $e->getMessage()]);
        }
    }


    private function determineSearchField($searchType)
    {
        switch ($searchType) {
            case 'title':
                return 'title:';
            case 'author':
                return 'author:';
            case 'isbn':
                return 'isbn:';
            default:
                return '';
        }
    }

    private function fetchCovers(array $docs)
    {
        $covers = [];
        foreach ($docs as $book) {
            if (isset($book['cover_i'])) {
                $cover_id = $book['cover_i'];
                $covers[$book['key']] = "https://covers.openlibrary.org/b/id/{$cover_id}-L.jpg";
            } else {
                // Asigna una URL de imagen por defecto si no hay cover_i
                $covers[$book['key']] = asset('images/libros/default_cover.webp');  
            }
        }
        return $covers;
    }    
}