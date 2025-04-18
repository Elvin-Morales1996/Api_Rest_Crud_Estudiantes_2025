<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estudiantes;
use Illuminate\Support\Facades\Validator;


class EstudiantesController extends Controller
{
    /**
     * metodo que me mostrara todos los datos
     */
    public function index()
    {
        //
        $estudiantes = Estudiantes::all();//Estudiantes es el modelo
        //primera forma de hacerlo
        /*if ($estudiantes->isEmpty()) {
            $data =[
                'message'=> 'no se encontraron estudiantes',
                'status'=> 200
            ];
            return response()->json($data, 400);
        }*/
        //segunda forma
            $data =[
            'estudiantes' => $estudiantes,
            'status' => 200
        ];
        return response()->json($data, 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validar los datos ejemplo que el correo contenga el formato y que sea unico
        $validar = Validator::make($request->all(),[
            'nombre'=>'required|max:200',
            'correo'=>'required|email|unique:estudiantes',
           'celular'=>'required|digits:8',
            'programacion'=>'required|in:php,js,javascript,java,c++,c#'
        ]);

//         si hay un error en los datos
        if ($validar->fails()) {
            $data = [
                'message'=>'error en la validacion de los datos',
                'error'=>$validar->errors(),
                'status'=>400

            ];
            //dentro del if
            return response()->json($data,400);


        }
        //crear el estudiante y lo sube a la base de datos
        $estudiantes = Estudiantes::create([
            'nombre'=>$request->nombre,
            'correo'=>$request->correo,
            'celular'=>$request->celular,
            'programacion'=>$request->programacion
        ]);


        //si tiene error al subir los datos a la base de datos
        if (!$estudiantes) {
            $data =[
                'message'=>'error al crear el estudiante',
                'status'=>500
            ];
            //dentro del if
            return response()->json($data, 500);
        }


        //me retorna los datos me los muestra
        $data = [
            'estudiantes'=>$estudiantes,
            'status'=>201
        ];


        return response()->json($data,201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $estudiantes = Estudiantes::find($id);
        if (!$estudiantes) {
            $data = [
                'message'=>'estudiante no encontrado',
                'status'=>400
            ];
            return response()->json($data, 400);
        }

        $data =[
            'estudiantes'=>$estudiantes,
            'status'=>200
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $estudiantes=Estudiantes::find($id);

        if (!$estudiantes) {
            $data =[
                'message'=>'estudiante no encontrado',
                'status'=>404
            ];
            return response()->json($data,404);
        }

        $validar = Validator::make($request->all(),[
            'nombre'=>'required|max:200',
            'correo'=>'required|email|unique:estudiantes',
           'celular'=>'required|digits:8',
            'programacion'=>'required|in:php,js,javascript,java,c++',
        ]);

        if ($validar->fails()) {
            $data = [
                'message'=>'error en las validaciones',
                'error'=>$validar->errors(),
                'status'=>400
            ];
            return response()->json($data, 400);
        }

        $estudiantes->nombre = $request->nombre;
        $estudiantes->correo = $request->correo;
        $estudiantes->celular = $request->celular;
        $estudiantes->programacion = $request->programacion;

        $estudiantes->save();

        $data=[
            'message'=>'estudiante actualizado',
            'estudiantes'=>$estudiantes,
            'status'=>200
        ];

        return response()->json($data,200);



    }



    //editar un estudiante pero con el campo especifico
    public function patch(Request $request, string $id){
        $estudiantes=Estudiantes::find($id);

        if (!$estudiantes) {
            $data =[
                'message'=>'estudiante no encontrado',
                'status'=>404
            ];
            return response()->json($data,404);
        }

        //return response()->json($data,404);

        $validar = Validator::make($request->all(),[
            'nombre'=>'max:200',
            'correo'=>'email|unique:estudiantes',
           'celular'=>'digits:8',
            'programacion'=>'in:php,js,javascript,java,c++',
        ]);

        if ($validar->fails()) {
            $data = [
                'message'=>'error en las validaciones',
                'error'=>$validar->errors(),
                'status'=>400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('nombre')) {
            $estudiantes->nombre = $request->nombre;
        }

        if ($request->has('correo')) {
            $estudiantes->correo = $request->correo;
        }

        if ($request->has('celular')) {
            $estudiantes->celular = $request->celular;
        }

        if ($request->has('programacion')) {
            $estudiantes->programacion = $request->programacion;
        }



        $estudiantes->save();

        $data = [
            'message'=>'estudiante actualizado',
            'estudiantes'=>$estudiantes,
            'status'=>200
        ];

        return response()->json($data, 200);

    }










    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //Estudiantes
        $estudiantes = Estudiantes::find($id);
        //$estudiantes==null
        if (!$estudiantes) {
            $data = [
                'message'=>'estudiante no encontrado',
                'status'=>404
            ];
            return response()->json($data,404);
        }

        $estudiantes->delete();
        $data = [
            'message'=>'estudiante eliminado',
            'status'=>200
        ];

        return response()->json($data,200);
    }
}
