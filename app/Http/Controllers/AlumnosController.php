<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumnosController extends Controller
{
    // Retornar alumnos y notas
    public function index()
    {
        $alumnos = DB::table('alumnos')->leftJoin('notas', 'alumnos.id', '=', 'notas.alumno_id')->get();

        return [
            'status' => true,
            'data' => $alumnos
        ];
    }

    // Almacenar nuevo alumno
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

    // Retornar un alumno en especifico con sus notas
    public function show(string $id)
    {
        $alumno = DB::table('alumnos')->leftJoin('notas', 'alumnos.id', '=', 'notas.alumno_id')->where('alumnos.id', '=', $id)->get();

        return [
            'status' => true,
            "data" => $alumno
        ];
    }

    // Actualizar un alumno en especifico
    public function update(Request $request, Alumno $alumno)
    {
        // Descomentar para exigir todos los campos de nuevo
        // $request->validate([
        //     'alumno_nombre' => 'required',
        //     'alumno_apellido' => 'required',
        //     'alumno_nivel' => 'required',
        //     'alumno_nacimiento' => 'required'
        // ]);

        $alumno->update($request->all());

        return [
            "status" => true,
            "data" => $alumno,
            "msg" => "Alumno actualizado"
        ];
    }

    // Remover un alumno en especifico y sus notas
    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        $notas = DB::table('notas')->where('alumno_id', '=', $alumno['id'])->delete();

        return [
            "status" => true,
            "data" => ['alumno' => $alumno, 'notas' => $notas],
            "msg" => "Alumno y notas eliminado con exito"
        ];
    }
}
