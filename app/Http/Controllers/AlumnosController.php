<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumnosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = DB::table('alumnos')->leftJoin('notas', 'alumnos.id', '=', 'notas.alumno_id')->get();

        return [
            'status' => true,
            'data' => $alumnos
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'alumno_nombre' => 'required',
            'alumno_apellido' => 'required',
            'alumno_nivel' => 'required',
            'alumno_nacimiento' => 'required'
        ]);

        $alumno = Alumno::create($request->all());

        return [
            'status' => true,
            'data' => $alumno
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $alumno = DB::table('alumnos')->leftJoin('notas', 'alumnos.id', '=', 'notas.alumno_id')->where('alumnos.id', '=', $id)->get();

        return [
            'status' => true,
            "data" => $alumno
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alumno $alumno)
    {
        $request->validate([
            'alumno_nombre' => 'required',
            'alumno_apellido' => 'required',
            'alumno_nivel' => 'required',
            'alumno_nacimiento' => 'required'
        ]);
 
        $alumno->update($request->all());
 
        return [
            "status" => true,
            "data" => $alumno,
            "msg" => "Alumno actualizado"
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumno $alumno)
    {
        $alumno->delete();

        return [
            "status" => true,
            "data" => $alumno,
            "msg" => "Alumno eliminado con exito"
        ];
    }
}
