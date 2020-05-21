<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('users', 'UserAPIController');

Route::resource('services', 'ServiceAPIController');

Route::resource('pets', 'PetAPIController');

Route::resource('medical_records', 'MedicalRecordAPIController');

Route::resource('medical_histories', 'MedicalHistoryAPIController');

Route::resource('appointments', 'AppointmentAPIController');

Route::get('employees', 'UserAPIController@employees');

Route::get('medicalHistory/medicalRecords/{medicalHistoryId}', 'MedicalRecordAPIController@findByMedicalHistory');

Route::get('veterinaries', 'UserAPIController@veterinaries');