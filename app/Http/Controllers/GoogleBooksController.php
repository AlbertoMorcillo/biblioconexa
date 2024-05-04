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
        $searchType = $request->input('type', 'all');
        $page = $request->input('page', 1);
        $maxResults = 6;
        $startIndex = ($page - 1) * $maxResults;
    
        switch ($searchType) {
            case 'title':
                $query = 'intitle:"' . $searchTerm . '"';
                break;
            case 'author':
                $query = 'inauthor:"' . $searchTerm . '"';
                break;
            case 'isbn':
                $query = 'isbn:' . $searchTerm;
                break;
            default:
                $query = $searchTerm;
                break;
        }
    
        $client = new Client();
    
        try {
            $response = $client->request('GET', 'https://www.googleapis.com/books/v1/volumes', [
                'query' => [
                    'q' => $query,
                    'key' => config('services.google.api_key'),
                    'maxResults' => $maxResults,
                    'startIndex' => $startIndex
                ]
            ]);
    
            $books = json_decode($response->getBody()->getContents(), true);
    
            if (isset($books['error'])) {
                Log::error('Google API Error:', [$books['error']]);
                throw new \Exception("Google Books API returned an error: " . $books['error']['message']);
            }
    
            $view = Auth::check() ? 'catalogo.search-results-logged' : 'catalogo.search-results';
    
            return view($view, [
                'books' => $books,
                'currentPage' => $page,
                'totalPages' => ceil($books['totalItems'] / $maxResults),
                'searchTerm' => $searchTerm,
                'searchType' => $searchType
            ]);
            
        } catch (\Exception $e) {
            Log::error('Search exception:', ['message' => $e->getMessage()]);
            return back()->withErrors(['msg' => 'Error al buscar libros: ' . $e->getMessage()]);
        }
    }
    
}
