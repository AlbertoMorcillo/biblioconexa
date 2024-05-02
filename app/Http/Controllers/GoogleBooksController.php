<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GoogleBooksController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $apiKey = config('services.google.api_key');
        $response = Http::get("https://www.googleapis.com/books/v1/volumes", [
            'q' => $query,
            'key' => $apiKey
        ])->json();
    
        $books = $response['items'] ?? []; // Use null coalescence to handle missing 'items'
        
        if ($request->ajax()) {
            return response()->json(['books' => $books]);
        } else {
            return view('catalogo.search-results', compact('books'));
        }
    }
    
}
