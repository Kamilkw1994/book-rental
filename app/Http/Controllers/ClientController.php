<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Http\Resources\ClientsResource;

use App\Http\Requests\ClientRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection as Collection;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return ClientsResource::collection(Client::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request): JsonResponse
    {
        $client = Client::create($request->all());

        return response()->json(['message' => 'Client is create successfull', 'client' => new ClientResource($client)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): ClientResource
    {
        $client = Client::with(Client::RELATION_BOOKS)->findOrFail($id);

        return (new ClientResource($client));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $client = Client::findOrFail($id);
        $client->delete();
        
        return response()->json(['message' => 'Client is delete successfull'], 200);
    }
}
