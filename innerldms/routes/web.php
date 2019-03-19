<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.login');
});

Route::get('/', 'SignupController@logout');
Route::get('signup', function () {
    return view('layouts.signup');
});

Route::get('home', function () {
    return view('layouts.documentReg');
});

Route::get('docreg', function () {
    return view('layouts.documentReg');
});

Route::get('foreign', function () {
    return view('layouts.foreign');
});
Route::get('alerts', function () {
    return view('layouts.notification');
});
Route::get('director', function () {
    return view('layouts.directors');
});

Route::get('insurance', function () {
    return view('layouts.insurance');
});

Route::post('saveuser', 'SignupController@saveUser');
Route::post('loginuser', 'SignupController@checkUser');

Route::post('savedocs', 'DocumentController@saveDocuments');
Route::get('dispdocs', 'DocumentController@dispDocuments');
Route::get('getdocnotifications','DocumentController@docNotification');
Route::get('deletedoc/{id}','DocumentController@DeleteDoc');
Route::get('editdoc/{id}','DocumentController@EditDoc');
Route::post('updatedocs','DocumentController@updateDoc');
Route::get('showdocuments/{id}','DocumentController@showDocuments');
Route::post('uploaddocimage','DocumentController@uploadDocumentImage');
Route::get('deletedocimage/{id}','DocumentController@deleteSelectedDocImage');


Route::post('saveforeignrecord', 'VisaController@saveForeignDocuments');
Route::get('dispforeignrecord', 'VisaController@dispForeignDocuments');
Route::get('getvisanotifications','VisaController@visaNotification');
Route::get('deletevisa/{id}','VisaController@deleteVisa');
Route::get('editvisa/{id}','VisaController@editVisa');
Route::post('updateforeignrecord','VisaController@updateForeignDocument');

Route::post('savedirector', 'DirectorController@saveDirector');
Route::get('dispdirector', 'DirectorController@dispDirector');
Route::get('getdirectoralert','DirectorController@directorNotification');
Route::get('deletedirector/{id}','DirectorController@deleteDirector');
Route::get('editdirector/{id}','DirectorController@editDirector');
Route::post('updatedirector','DirectorController@updateDirector');


Route::post('saveinsurance', 'InsuranceController@saveInsurance');
Route::get('dispinsurance', 'InsuranceController@dispInsurance');
Route::get('getinsurancealert','InsuranceController@insuranceNotification');
Route::get('deleteinsurance/{id}','InsuranceController@deleteInsurance');
Route::get('editinsurance/{id}','InsuranceController@editInsurance');
Route::post('updateinsurance','InsuranceController@updateInsurance');
Route::get('showinscertificates/{id}','InsuranceController@showInsCertificates');
Route::post('uploadinscertificate','InsuranceController@uploadInsCertificate');
Route::get('deleteinscertificate/{id}','InsuranceController@deleteInsCertificate');
