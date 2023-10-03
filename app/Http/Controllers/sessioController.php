<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Salle;
use App\Models\Classe;
use App\Models\Sessio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\sessionRequest;

class sessioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
      public function create( sessionRequest $request )
    {            
             foreach ($request->input('sessions') as $sessionData) {

                if (isset($sessionData['salle_id'])) {
                    $salle = Salle::find($sessionData['salle_id']);
                }
                
                if(!$salle){
                    return response()->json('cette classe existe pas');
                }

                $cours=Cours::where('id',$sessionData['cours_id'])->first();
                if(!$cours){
                    return response()->json('cours non planifier');
                }

                $sessionExist = Sessio::where('cours_id', $cours->id)
                ->where('heure_debut', $sessionData['heure_debut'])
                ->where('nbr_heure', $sessionData['nbr_heure'])
                ->where('date', $sessionData['date'])
                ->first();
            if($sessionExist ){
                return response()->json('session deja planifier');
            }

           
                $session = Sessio::create([
                    'cours_id' => $cours->id,
                    'date' => now(),
                    'heure_debut' => $sessionData['heure_debut'],
                    'heure_fin' => $sessionData['heure_fin'],
                    'nbr_heure' => $sessionData['nbr_heure'],
                    'type' => $sessionData['type'],
                    'salle_id'=>$salle->id,
                ]);
                if ($sessionData['type'] === 'presentiel') {
                    
                    $session->salle_id = $salle->id;
                }
                
                

                if ($sessionData['nbr_heure'] > $cours->nombre_heure) {
                    return response()->json(['error' => 'Le nombre d\'heures de la session est supérieur au nombre d\'heures du cours.'], 400);
                }
                
                $session->classes()->attach($sessionData['classes']);

                $session->save();
                    
                }
                
                return response()->json(['message' => 'Cours planifié avec succès']);
            }
            
           
        
        


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sessio $sessio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sessio $sessio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sessio $sessio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sessio $sessio)
    {
        //
    }
}
