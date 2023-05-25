<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotasController extends Controller
{
    // Listas todas las notas y su alumno
    public function index()
    {
        $notas = DB::table('notas')->join('alumnos', 'notas.alumno_id', '=', 'alumnos.id')->get();

        return [
            'status' => true,
            'data' => $notas
        ];
    }

    // Agregar nota a alumno
    public function store(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required',
            'nota_materia' => 'required',
            'nota_puntos' => 'required',
        ]);

        $nota = Nota::create($request->all());

        return [
            'status' => true,
            'data' => $nota,
            'msg' => 'Nota cargada satisfactoriamente'
        ];
    }

    // Retornar notas de un alumno en especifico
    public function show(string $id_alumno)
    {
        $notas = DB::table('notas')->where('alumno_id', '=', $id_alumno)->get();

        return [
            'status' => true,
            'data' => $notas,
            'msg' => "Notas del alumno con ID N° {$id_alumno}"
        ];
    }

    // Actualizar nota en especifica de un alumno
    public function update(Request $request, string $id_nota)
    {
        $request->validate([
            'alumno_id' => 'required',
            'nota_puntos' => 'required'
        ]);

        $id_alumno = $request->query('alumno_id');

        $nota = DB::table('notas')->where('alumno_id', '=', $id_alumno)->where('id', '=', $id_nota)->update($request->all());

        return [
            'status' => true,
            'data' => $nota,
            'msg' => "Nota y materia actualizada satisfactoriamente al alumno con ID N° {$id_alumno}"
        ];
    }

    // Eliminar nota especifica de un alumno
    public function destroy(Nota $nota)
    {
        $nota->delete();

        return [
            "status" => true,
            "data" => $nota,
            "msg" => "Nota eliminadas con exito"
        ];
    }
}
