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
consultausuariospordireccion
Route::post('/consulta','AsisController@consulta');*/

Route::post('/consultafechasalida','AsisController@consultafechasal');
Route::post('/desarmanombre','AsisController@desarmaname');
Route::post('/agregaferiados','AsisController@iniciarrayferiado');
Route::post('/fullname','AsisController@nombreunido');
Route::post('/consultareporte','AsisController@consultareport');
Route::post('/conusudire','AsisController@consdire');
Route::post('/primero','AsisController@subir');
Route::get('/retornapapeletas','AsisController@retpapeletas');
Route::post('/avatar','AsisController@myAvatar');
Route::get('/subirfoto','AsisController@subiendo');
Route::get('/pasantes','AsisController@obtienepasantes');
Route::post('/getusucontra','AsisController@getusuariocontra');
Route::post('/cusu','AsisController@solio');
Route::post('/adicionausuarios','AsisController@adicionausu');
Route::post('/actualizausuarios','AsisController@actualizausu');
Route::post('/eliminausuarios','AsisController@eliminausu');
Route::post('/configuracion','AsisController@consultactualiza');
Route::post('/actualizapapeleta','AsisController@actualizapapel');
Route::post('/actualizapapeletaentrega','AsisController@actualizapapelentregado');
Route::post('/actualizaestado','AsisController@actualizausuestado');
Route::post('/consultasuperusers','AsisController@consultasuperusuarios');
Route::get('/generate-pdf','HomeController@generatePDF');
Route::post('/consultasuperusufechas','AsisController@consultafechas');
Route::post('/consultapost','AsisController@consultapost');
Route::post('/consultacalendario','AsisController@consultacalendar');
Route::post('/cons','AsisController@consultacons');
Route::post('/cons1','AsisController@consultacons1');
Route::post('/cons2','AsisController@consultacons2');
Route::post('/obtienedepartamento','AsisController@obtienedepa');
Route::post('/cons3','AsisController@consultacons3');
Route::post('/cons4','AsisController@consultacons4');
Route::post('/consultadavid','AsisController@consultadavid');
Route::post('/consultasal','AsisController@consultaopesalida');
Route::post('/consultausuarios','AsisController@consultausuarios');
Route::post('/consultausuariosconbaja','AsisController@consultausuariosbaja');
Route::post('/consultausupordepa','AsisController@consultausupordep');
Route::post('/consultasalida','AsisController@consultasalida');
Route::post('/vistaprevia','AsisController@vistapreviapapeleta');
Route::post('/consultasalida2','AsisController@consultasalid2');
Route::resource('/dada','AsisController');
Route::get('/consulta','AsisController@consulta');
Route::get('/opera','AsisController@operacion');
/********************************PARA REPORTES******************************/
Route::post('/consultaestad','Reportes@consultaestadisticas');
Route::post('/dias_feriados','Reportes@diasferiadosyotros');
Route::post('/dias_permisos','Reportes@diaspermisos');
Route::post('/dias_permisos_usuario','Reportes@diaspermisosusuario');
Route::post('/dias_vacaciones','Reportes@diasvacaciones');
Route::post('/dias_vacaciones_usuario','Reportes@diasvacacionesusuario');
Route::get('/dias','Reportes@diass');
Route::post('/dias_excepcionales','Reportes@diasexcepcionales');
Route::post('/dias_inicios_meses','Reportes@diasiniciosmeses');

Route::post('/meses_reportes','Reportes@mesesreportes');
Route::post('/reporte_usuario','Reportes@reporteusuario');
Route::get('/reporte_usuario2','Reportes@reporteusuario2');
/*****************************FIN PARA REPORTES*****************************/




