<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/uploadImg', function (Request $request) {
    if ($request->file('attachment') != null) {
        try {
            $class = $request->get('class');
            $file_type = $request->get('file_type');
            $fileIdentity = $request->file('attachment');
            $tujuan_upload = public_path() . '/bin/img/' . $class . '/' . $file_type;
            $fileIdentity->move($tujuan_upload, $fileIdentity->getClientOriginalName());
            $urlSavedNPWP = url('/bin/img/' . $class . '/' . $file_type . '/' . $fileIdentity->getClientOriginalName());

            return response()
                ->json(['success' => true, 'message' => $urlSavedNPWP]);
        } catch (\Throwable $th) {
            return response()
                ->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }
});

Route::delete('/deleteImg', function (Request $request) {
    if ($request->get('q') != null) {
        try {
            unlink($request->get('q'));

            return response()
                ->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()
                ->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }
});
