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

/*
root pour les utilisateurs
*/

Route::get('/', 'VisiteurController@index')->name('acceuil');
Route::get('acceuil', 'VisiteurController@index')->name('acceuil');
Route::get('learn-to-code-from-scratch', 'LearnscratchController@index')->name('learn2CodeFromScratch');
Route::get('Learning-program-pro', 'LearnproController@index')->name('LearningProgramPro');
Route::get('enginnova-community', 'VisiteurController@enginnovaCommunity')->name('enginnovaCommunity');
Route::get('enginnova-mentors', 'MentorController@index')->name('enginnova_mentors');
Route::get('enginnova-users', 'VisiteurController@userList')->name('enginnova_users');
Route::get('question/{id}', 'VisiteurController@showQuestion')->where('id','[0-9]+');
Route::get('freelance', 'VisiteurController@freelance')->name('freelance');
Route::get('freelance-projet/{id}', 'VisiteurController@showFprojets')->where('id','[0-9]+');
Route::get('contact', 'ContactController@index')->name('contact');
Route::get('formation-inscription/{type}', 'VisiteurController@formationAdd');
Route::get('lire-activite/{id}', 'VisiteurController@LireActivite')->where('id', '[0-9]+');
Route::get('geeking/{id}', 'VisiteurController@geeking')->where('id', '[0-9]+');
Route::get('conditions-generales', 'VisiteurController@conditions_generales');
//fetch route
Route::get('/fetch-mentor/{id}', 'MentorController@fetchMentor')->where('id', '[0-9]+');
Route::post('/fetchQuestions', 'VisiteurController@fetchQuestions')->name('fetchQuestions');
Route::post('/fetchUser', 'VisiteurController@fetchUser')->name('fetchUser');

//form route
Route::post('add-fs', 'LearnscratchController@create');
Route::post('add-fp', 'LearnproController@create');

Auth::routes();

//admin route
Route::group(['middleware' => ['admin']], function(){
Route::get('admin/administrateur', 'AdministrateurController@index')->name('admin.administrateur');
Route::get('admin/cv-inactif', 'AdministrateurController@cvInactif')->name('admin.cv');
Route::get('admin/freelance-projets
', 'AdministrateurController@fProjet')->name('admin.freelance');
Route::get('admin/projets-boost', 'AdministrateurController@projetAboost')->name('admin.boost');
Route::get('admin/manif', 'AdministrateurController@manif')->name('admin.manif');
Route::get('admin/slider-acceuil', 'AdministrateurController@sliderList');
Route::get('admin/slider-edit/{id}', 'AdministrateurController@sliderEdit')->where('id','[0-9]+');
Route::post('admin/slider-update/{id}', 'AdministrateurController@sliderUpdate')->where('id','[0-9]+');
Route::get('admin/new-activite', 'AdministrateurController@newActivite');
Route::post('admin/create-activite', 'AdministrateurController@createActivite');
Route::get('admin/edit-activite/{id}', 'AdministrateurController@editActivite')->where('id','[0-9]+');
Route::post('admin/update-activite/{id}', 'AdministrateurController@updateActivite')->where('id','[0-9]+');
Route::get('admin/trucs-astuces', 'AdministrateurController@newAstuce');
Route::post('admin/create-astuce', 'AdministrateurController@createAstuce');
Route::get('admin/edit-astuce/{id}', 'AdministrateurController@editAstuce')->where('id','[0-9]+');
Route::post('admin/update-astuce/{id}', 'AdministrateurController@updateAstuce')->where('id','[0-9]+');
Route::get('admin/delete-slide/{id}', 'AdministrateurController@destroySlide')->where('id','[0-9]+');
Route::get('admin/delete-activite/{id}', 'AdministrateurController@destroyActivite')->where('id','[0-9]+');
Route::get('admin/delete-astuce/{id}', 'AdministrateurController@destroyAstuce')->where('id','[0-9]+');
Route::post('admin/traite-projets', 'AdministrateurController@traiteFprojet');
Route::get('admin/traite-users', 'AdministrateurController@traiteUsers');
Route::get('admin/admin-cv/{id}', 'AdministrateurController@cv')->where('id','[0-9]+');
Route::get('admin/admin-freelanceProjet/{id}', 'AdministrateurController@freelanceProjet')->where('id','[0-9]+');
Route::get('admin/events', 'EventsController@index')->name('admin.events');
Route::get('admin/edit-user/{id}', 'UserController@admin_edit_user')->where('id','[0-9]+');
Route::get('admin/activer-cv/{id}', 'AdministrateurController@activerCv')->where('id','[0-9]+');
Route::get('admin/gestion-mentor', 'AdministrateurController@gestionMentor');
Route::post('admin/activer-freelanceProjet/{id}', 'AdministrateurController@activerFprojet')->where('id','[0-9]+');
Route::post('admin/traite-projets', 'AdministrateurController@traiteFprojet');
Route::post('admin/traite-users', 'AdministrateurController@traiteUsers');
Route::post('admin/activer-boosterProjet/{id}', 'AdministrateurController@boosterProjet')->where('id','[0-9]+');
Route::post('admin/add-events', 'EventsController@addEvents')->name('admin_addEvent');
Route::post('admin/add-mentor', 'AdministrateurController@newMentor')->name('add_mentor');
Route::post('/admin/fetch-user', 'UserController@AdminFetchUser')->name('fetch_user');
});

//user route
Route::get('user/home', 'HomeController@index')->name('user.home');
Route::get('user/add-post', 'HomeController@add_post')->name('addPost');
Route::get('user/enginnova-community', 'PostController@index')->name('user.enginnovaCommunity');
Route::get('user/edit-question/{id}', 'PostController@edit')->where('id','[0-9]+');
Route::get('user/deleteQuestion/{id}', 'PostController@destroy')->where('id','[0-9]+');
Route::get('user/edit-solution/{id}', 'commentaireController@edit')->where('id','[0-9]+');
Route::get('user/deleteSolution/{idc}/{id}', 'CommentaireController@destroy')->where(['idc','[0-9]+'],['id','[0-9]+']);
Route::get('user/like-solution/{idc}/{idu}/{id}', 'NoteController@like')->where(['idc','[0-9]+'],['idu','[0-9]+'],['id','[0-9]+']);
Route::get('user/unlike-solution/{idc}/{idu}', 'NoteController@unlike')->where(['idc','[0-9]+'],['idu','[0-9]+']);
Route::get('user/freelance', 'FreelanceController@index')->name('user.freelance');
Route::get('user/freelance-projet/{id}', 'FreelanceController@show')->where('id','[0-9]+');
Route::get('user/add-projet', 'HomeController@add_projet')->name('addProjet');
Route::get('user/question/{id}', 'PostController@show')->where('id','[0-9]+');
Route::get('user/edit-projet/{id}', 'FreelanceController@edit')->where('id','[0-9]+');
Route::get('user/deleteProjet/{id}', 'FreelanceController@destroy')->where('id','[0-9]+');
Route::get('user/profil/{id}', 'UserController@show')->name('user.profil');
Route::get('user/postuler-au-Projet/{id}', 'ParcoursController@postuler')->where('id','[0-9]+');
Route::get('user/supprime-candidature/{id}', 'ParcoursController@deleteCandidature')->where('id','[0-9]+');
Route::get('user/error', 'ErrorController@post_not_found');
Route::get('user/test', 'CommentaireController@index');
Route::get('user/questions-categorie/{id}', 'PostController@categorie')->where('id','[0-9]+');
Route::get('user/projets-categorie/{id}', 'FreelanceController@categorie')->where('id','[0-9]+');
Route::get('user/best-fprojets', 'FreelanceController@bestProjet')->name('user.best_freelance');
Route::get('user/gestion-projet/{id}', 'GestionprojetController@index')->name('user.gestion_projet');
Route::get('/user/CV/{id}', 'CvController@fetch')->where('id','[0-9]+');
Route::get('user/notifier-candidat-selectionne/{idu}/{idp}', 'GestionprojetController@selectionner')->where(['idu','[0-9]+'],['idp','[0-9]+']);
Route::get('user/annuler-candidat-selection/{idu}/{idp}', 'GestionprojetController@deSelectionner')->where(['idu','[0-9]+'],['idp','[0-9]+']);
Route::get('user/accepte-job/{idu}/{idp}', 'GestionprojetController@accepteJob')->where(['idu','[0-9]+'],['idp','[0-9]+']);
Route::get('user/workspace/{id}', 'WorkspaceController@index')->where('id','[0-9]+');
Route::get('/user/workspace-discussions/{id}', 'WorkspaceController@fetch_chats')->where('id','[0-9]+');
Route::get('user/user/delete-tache/{idt}/{idp}', 'TeamplanningController@destroy')->where(['idt','[0-9]+'],['idp','[0-9]+']);
Route::get('user/tache-faite/{idt}/{idp}', 'TeamplanningController@tacheFaite')->where(['idt','[0-9]+'],['idp','[0-9]+']);
Route::get('user/end-projet/{idp}/{idw}', 'GestionprojetController@endProjet')->where(['idp','[0-9]+'],['idw','[0-9]+']);
Route::get('user/the-end/{idp}/{idw}', 'GestionprojetController@theEnd')->where(['idp','[0-9]+'],['idw','[0-9]+']);
Route::get('user/geeking/{id}', 'AstuceController@show')->where('id','[0-9]+');
Route::get('user/add-projet-benevolat', 'HomeController@add_projet_benevolat')->name('projet_benevolat');

/*
root pour les requettes de l'utilisateur
*/
Route::post('user/insertQuestion', 'PostController@create');
Route::post('user/updateQuestion/{id}', 'PostController@update')->where('id','[0-9]+');
Route::post('user/addSolution', 'CommentaireController@create');
Route::post('user/updateSolution/{id}', 'CommentaireController@update')->where('id','[0-9]+');
Route::post('user/insertProjet', 'FreelanceController@create');
Route::post('user/insertProjetBenevolat', 'ProjetbenevolatController@create');
Route::post('user/updateProjet/{id}', 'FreelanceController@update')->where('id','[0-9]+');
Route::post('user/mettre-a-jour-avatar', 'UserController@store');
Route::post('user/updateProfil/{id}', 'UserController@update')->where('id','[0-9]+');
Route::post('user/mettre-a-jour-cv/{id}', 'CvController@updateCv')->where('id','[0-9]+');
Route::post('user/booster-projet/{id}', 'BoosterpController@create')->where('id','[0-9]+');
Route::post('/user/fetch', 'HomeController@fetch')->name('user.fetch');
Route::post('user/selectioner-candidats', 'GestionprojetController@selectionner');
Route::post('user/teamchat-add/{id}', 'TeamchatController@teamchatAdd')->where('id','[0-9]+');
Route::post('user/add-teamplanning/{id}', 'TeamplanningController@planningAdd')->where('id','[0-9]+');
Route::post('user/add-observation/{idu}/{idw}', 'ObservationController@create')->where(['idu','[0-9]+'],['idw','[0-9]+']);
Route::post('/user/noter-participant', 'ObservationController@update');


