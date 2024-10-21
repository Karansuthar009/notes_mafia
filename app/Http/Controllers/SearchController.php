<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadFile; 

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search in title, category, username, description, etc.
        $results = UploadFile::where('title', 'LIKE', "%$query%")
            ->orWhere('category', 'LIKE', "%$query%")
            ->orWhere('username', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->orWhere('year', 'LIKE', "%$query%")
            ->orWhere('semester', 'LIKE', "%$query%")
            ->get();

        // Return the search results as JSON
        return response()->json($results);
    }
}
