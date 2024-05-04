<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OpenLibraryBooksController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('q');
        $searchType = $request->input('type', 'all');
        $page = $request->input('page', 1);
        $maxResults = 6;
        $offset = ($page - 1) * $maxResults;

        $searchField = '';
        switch ($searchType) {
            case 'title':
                $searchField = 'title:';
                break;
            case 'author':
                $searchField = 'author:';
                break;
            case 'isbn':
                $searchField = 'isbn:';
                break;
        }

        $client = new Client();
    
        try {
            $response = $client->request('GET', 'http://openlibrary.org/search.json', [
                'query' => [
                    'q' => $searchField . $searchTerm,
                    'page' => $page,
                    'limit' => $maxResults,
                    'offset' => $offset
                ]
            ]);
    
            $books = json_decode($response->getBody()->getContents(), true);
    
            if (isset($books['error'])) {
                Log::error('Open Library API Error:', [$books['error']]);
                throw new \Exception("Open Library API returned an error: " . $books['error']['message']);
            }

            // Fetch covers
            $covers = [];
            foreach ($books['docs'] as $book) {
                $isbn = $book['isbn'][0] ?? null;
                if ($isbn) {
                    $coverResponse = $client->request('GET', "https://covers.openlibrary.org/b/isbn/{$isbn}-L.jpg");
                    $covers[$isbn] = base64_encode($coverResponse->getBody()->getContents());
                }
            }

            // Calculating total pages
            $totalItems = $books['numFound'];
            $totalPages = ceil($totalItems / $maxResults);

            $view = Auth::check() ? 'catalogo.search-results-logged' : 'catalogo.search-results';
    
            return view($view, [
                'books' => $books['docs'], // Ensure to access 'docs' key for actual book data
                'covers' => $covers,
                'currentPage' => $page,
                'totalPages' => $totalPages,
                'searchTerm' => $searchTerm,
                'searchType' => $searchType
            ]);
            
        } catch (\Exception $e) {
            Log::error('Search exception:', ['message' => $e->getMessage()]);
            return back()->withErrors(['msg' => 'Error al buscar libros: ' . $e->getMessage()]);
        }
    }
}