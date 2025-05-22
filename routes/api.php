<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Departament;
use App\Models\Functionary;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


route::post('/departament', function (Request $request) {
    $departament = new Departament(); // instanciando  o mesmo que criar um registro na tabela
    $departament->name = $request->name;
    $departament->save();// salvando o registro no banco de dados
    return response()->json([
        'message' => 'Departamento criado com sucesso!',
        'departament' => $departament
    ]);

});
Route::post('/functionary', function (Request $request) {
    $functionary = new Functionary(); // instanciando  o mesmo que criar um registro na tabela
    $functionary->name = $request->name;
    $functionary->email = $request->email;
    $functionary->departament_id = $request->departament_id;
    $functionary->save();// salvando o registro no banco de dados
    return response()->json([
        'message' => 'Funcionário criado com sucesso!',
        'functionary' => $functionary
    ]);

});
Route::get('/list-departaments', function () {
    $departaments = Departament::all();
    return response()->json($departaments);
});

Route::get('/list-functionaries', function () {
    $functionaries = Functionary::all();
    return response()->json($functionaries);
});

Route::get('/id-functionary/{id}', function ($id) {
    $functionaries = Functionary::find($id);
    if (!$functionaries) {
        return response()->json(['message' => 'Funcionário não encontrado'], 404);
    }
    return response()->json($functionaries);
});

// Atualizar Funcionário
Route::put('/functionary/{id}', function (Request $request, $id) {
    $functionary = Functionary::find($id);
    if (!$functionary) {
        return response()->json(['message' => 'Funcionário não encontrado'], 404);
    }
    $functionary->update($request->all());
    return response()->json(['message' => 'Funcionário atualizado!', 'functionary' => $functionary]);
});

// Deletar Funcionário
Route::delete('/functionary/{id}', function ($id) {
    $functionary = Functionary::find($id);
    if (!$functionary) {
        return response()->json(['message' => 'Funcionário não encontrado'], 404);
    }
    $functionary->delete();
    return response()->json(['message' => 'Funcionário deletado!']);
});

// Atualizar Departamento
Route::put('/departament/{id}', function (Request $request, $id) {
    $departament = Departament::find($id);
    if (!$departament) {
        return response()->json(['message' => 'Departamento não encontrado'], 404);
    }
    $departament->update($request->all());
    return response()->json(['message' => 'Departamento atualizado!', 'departament' => $departament]);
});

// Deletar Departamento
Route::delete('/departament/{id}', function ($id) {
    $departament = Departament::find($id);
    if (!$departament) {
        return response()->json(['message' => 'Departamento não encontrado'], 404);
    }
    $departament->delete();
    return response()->json(['message' => 'Departamento deletado!']);
});

// Listar Funcionários com seus Departamentos
Route::get('/functionaries-with-departament', function () {
    return Functionary::with('departament')->get();
});
//método with() do Eloquent para trazer os dados relacionados em uma única consulta, aproveitando os relacionamentos definidos nas suas models.

// Listar Departamentos com seus Funcionários
Route::get('/departaments-with-functionaries', function () {
    return Departament::with('functionaries')->get();
});

// Buscar Departamento de um Funcionário
Route::get('/functionary/{id}/departament', function ($id) {
    $functionary = Functionary::with('departament')->find($id);
    if (!$functionary) {
        return response()->json(['message' => 'Funcionário não encontrado'], 404);
    }
    return response()->json($functionary->departament);
});

// Buscar Funcionários de um Departamento
Route::get('/departament/{id}/functionaries', function ($id) {
    $departament = Departament::with('functionaries')->find($id);
    if (!$departament) {
        return response()->json(['message' => 'Departamento não encontrado'], 404);
    }
    return response()->json($departament->functionaries);
});
