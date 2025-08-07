<?php

namespace App\Http\Controllers;

use App\Models\MCPServer;
use App\Models\MCPAction;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Context7DemoController extends Controller
{
    /**
     * Show Context7 integration demo page
     */
    public function index()
    {
        $context7Server = MCPServer::where('slug', 'context7-docs')->first();
        
        if (!$context7Server) {
            return redirect()->route('mcp.servers')->with('error', 
                'Context7 example not found. Run: php artisan mcpeer:setup-context7'
            );
        }

        $actions = $context7Server->actions()->where('is_active', true)->get();

        return view('context7.demo', compact('context7Server', 'actions'));
    }

    /**
     * Demo query to Context7 API
     */
    public function demoQuery(Request $request): JsonResponse
    {
        $request->validate([
            'library' => 'required|string|max:100',
            'query' => 'required|string|max:500',
            'version' => 'nullable|string|max:20',
            'include_examples' => 'boolean'
        ]);

        try {
            $client = new Client(['timeout' => 30]);
            
            // Simulate Context7 API call (replace with real endpoint when available)
            $response = $this->simulateContext7Response(
                $request->input('library'),
                $request->input('query'),
                $request->input('version', 'latest'),
                $request->boolean('include_examples', true)
            );

            return response()->json([
                'success' => true,
                'data' => $response,
                'meta' => [
                    'library' => $request->input('library'),
                    'query' => $request->input('query'),
                    'version' => $request->input('version', 'latest'),
                    'timestamp' => now()->toISOString()
                ]
            ]);

        } catch (RequestException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Context7 API request failed: ' . $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Demo query failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Demo search across libraries
     */
    public function demoSearch(Request $request): JsonResponse
    {
        $request->validate([
            'search_term' => 'required|string|max:200',
            'languages' => 'nullable|array',
            'languages.*' => 'string|in:php,javascript,python,java,rust',
            'limit' => 'nullable|integer|min:1|max:50'
        ]);

        try {
            $response = $this->simulateSearchResponse(
                $request->input('search_term'),
                $request->input('languages', []),
                $request->input('limit', 10)
            );

            return response()->json([
                'success' => true,
                'data' => $response,
                'meta' => [
                    'search_term' => $request->input('search_term'),
                    'languages' => $request->input('languages', []),
                    'total_results' => count($response['results']),
                    'timestamp' => now()->toISOString()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Demo search failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Simulate Context7 documentation response
     */
    private function simulateContext7Response(string $library, string $query, string $version, bool $includeExamples): array
    {
        // Simulate realistic Context7 response based on library
        $responses = [
            'laravel' => [
                'documentation' => "Laravel {$version} - {$query}",
                'description' => 'Laravel is a web application framework with expressive, elegant syntax.',
                'examples' => $includeExamples ? [
                    [
                        'title' => 'Basic Route Definition',
                        'code' => "Route::get('/users', [UserController::class, 'index']);",
                        'language' => 'php'
                    ],
                    [
                        'title' => 'Eloquent Model',
                        'code' => "User::where('active', true)->get();",
                        'language' => 'php'
                    ]
                ] : [],
                'links' => [
                    'official_docs' => "https://laravel.com/docs/{$version}",
                    'github' => 'https://github.com/laravel/laravel'
                ]
            ],
            'react' => [
                'documentation' => "React {$version} - {$query}",
                'description' => 'A JavaScript library for building user interfaces.',
                'examples' => $includeExamples ? [
                    [
                        'title' => 'Functional Component',
                        'code' => "function Welcome(props) {\n  return <h1>Hello, {props.name}!</h1>;\n}",
                        'language' => 'javascript'
                    ]
                ] : [],
                'links' => [
                    'official_docs' => 'https://react.dev/',
                    'github' => 'https://github.com/facebook/react'
                ]
            ]
        ];

        return $responses[$library] ?? [
            'documentation' => "{$library} {$version} - {$query}",
            'description' => "Documentation for {$library} library.",
            'examples' => [],
            'links' => []
        ];
    }

    /**
     * Simulate search response
     */
    private function simulateSearchResponse(string $searchTerm, array $languages, int $limit): array
    {
        $results = [
            [
                'library' => 'Laravel',
                'language' => 'php',
                'relevance' => 0.95,
                'description' => 'PHP web framework with elegant syntax',
                'match_reason' => "Strong match for '{$searchTerm}' in routing and MVC patterns"
            ],
            [
                'library' => 'Express.js',
                'language' => 'javascript', 
                'relevance' => 0.87,
                'description' => 'Fast, unopinionated, minimalist web framework for Node.js',
                'match_reason' => "Good match for '{$searchTerm}' in web server functionality"
            ],
            [
                'library' => 'FastAPI',
                'language' => 'python',
                'relevance' => 0.82,
                'description' => 'Modern, fast web framework for building APIs with Python',
                'match_reason' => "Relevant for '{$searchTerm}' in API development"
            ]
        ];

        // Filter by languages if specified
        if (!empty($languages)) {
            $results = array_filter($results, function ($result) use ($languages) {
                return in_array($result['language'], $languages);
            });
        }

        // Apply limit
        $results = array_slice(array_values($results), 0, $limit);

        return [
            'results' => $results,
            'total_found' => count($results),
            'search_term' => $searchTerm,
            'filters' => [
                'languages' => $languages
            ]
        ];
    }
}
