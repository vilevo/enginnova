@extends('inc.template')

@section('titre')
	Enginnova Community - questions
@endsection

@section('header')
<!-- Page breadcrumb -->
<?php $type="learn-to-code-from-scratch"; ?>
 <section id="mu-page-breadcrumb" style="background-color: #337AB7;">
   <div class="container">
     <div class="row" style="background-color: #337AB7;">
       <div class="col-md-12">
         <div class="mu-page-breadcrumb-area">
           <h2 class="pull-left">Enginnova Learning Program</h2>
           <ol class="breadcrumb pull-right">
            <li><a href="{{ url('acceuil') }}"><i class="fa fa-home"></i>Acceuil</a></li>            
            <li class="active" style="color: gold;">learn 2 Code From Scratch</li>
            <li><a href='{{ url("formation-inscription/{$type}") }}' class="btn btn-warning" style="font-weight: bold;">S'incrire à la formation</a></li>
          </ol>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- End breadcrumb -->
@endsection

@section('layout_main_content')
<!-- Start about us -->
  <section id="mu-about-us">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-about-us-area">
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <div class="mu-about-us-left">
                  <!-- Start Title -->
                  <div class="mu-title">
                    <h2>A Propos</h2>
                  </div>
                  <!-- End Title -->
                  <p>Il comprend une formation présentielle et une formation à distance basées sur des cours vulgarisés portés sur l’Informatique et donnés par les membres de Enginnova Community. Il dispose de deux niveaux Types de compétences Technologiques transmises Les bases de la programmation , apprentissage des langues Python , Ruby , Java , PHP , devOps, Cloud computing, dev designer...En plus de ces langages, vous serez formés aux méthodes de gestion de projets les plus utilisées dans l’univers web.</p>
                  <ul>
                    <li><h5 style="color: #337AB7;"><b>Débutant</b></h5>Nombre d’étudiants dans la classe :  10 à 20  Conditions :  Toute personne passionnées des nouvelles technologies , aucune âge limite . Frais de formation (en FCFA) :1 personne = 15.000 ; Duo = 14.000 ; Trio = 12.000 ; Groupe de 5 personnes = 10.000 Possibilité de Cours du soir : Oui</li>
                    <li><h5 style="color: #337AB7;"><b>Junior</b></h5>Nombre d’étudiants dans la classe :  10 à 20  Conditions :  Toute personne passionnées des nouvelles technologies , aucune âge limite . Frais de formation (en FCFA) :1 personne = 25.000 ; Duo = 24.000 ; Trio = 22.000 ; Groupe de 5 personnes = 20.000 Possibilité de Cours du soir : Oui</li>
                    <li><h5 style="color: #337AB7;"><b>Sénior</b></h5>Nombre d’étudiants dans la classe :  10 à 20  Conditions :  Toute personne passionnées des nouvelles technologies , aucune âge limite . Frais de formation (en FCFA) :1 personne = 15.000 ; Duo = 14.000 ; Trio = 12.000 ; Groupe de 5 personnes = 10.000 Possibilité de Cours du soir : Oui</li>
                  </ul>
                  <a href='{{ url("formation-inscription/{$type}") }}' class="btn btn-primary"><i class="fa fa-long-arrow-right"></i><b>S'inscrire</b></a><br>
                  <h4><a href="{{ url('Learning-program-pro') }}"><i class="fa fa-angle-double-right"></i> Découvrir aussi enginnova learning program pro</a></h4>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="mu-about-us-right">
                <a id="mu-abtus-video" href="https://www.youtube.com/embed/BurO7YRxDhk" target="mutube-video">
                  <img src='{{asset("elp_files/assets/img/degrad.png")}}' alt="img">
                </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End about us -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3 style="color: #337AB7;">INFORMATIONS CLÉS</h3>
					<ul>
						<li><b>Aucun prérequis pour intégrer la formation. Le programme est ouvert à tous ! Nous accueillons des candidats curieux, motivés et désireux d’apprendre.</b></li>
						<li><b>Durée 80 heures (21 jours), les cours en présentiel se déroulent  du lundi au vendredi. Les 3 dernières semaines de formation sont allouées à la réalisation d’un projet réel permettant de consolider les apprentissages et outils enseignés pendant le cursus.</b></li>
						<li><b>Les prochaines sessions Nous proposons 4 à 5 sessions par an. N’hésitez pas à nous contacter pour connaître la date de la prochaine.</b></li>
						<li><b>Se rencontrer Nous organisons tous les mois des “After code” qui permettent de se rencontrer afin d’échanger sur votre projet et sur la formation.</b></li>
						<li><b>Frais de formation (en FCFA) : 10.000 Par module ; 50.000 pour la formation complète (6 modules)</b></li>
						<li><b>Possibilité de Cours du soir : Oui</b></li>
						<li><b>Possibilité de réduction des frais de formation : Oui</b></li>
					</ul>
			</div>
		</div>
	</div>
@endsection

@section('footer')

@endsection

@section('formulaire')
<div class="modal fade" id="boosterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="exampleModalLabel">Mettre en avant son projet</h4>
    </div>
    
    <form id="cvForm" class="contactform" action='{{ url("user/booster-projet/")}}' method="POST">
                          {{csrf_field()}}
    <div class="modal-body">
         <div class="form-group">
          <label for="profession">Veuillez choisir la duré de votre forfait</label>
            <h5>Une semaine => 2500FCFA</h5>
            <h5>Deux semaine => 5000FCFA</h5>
            <select class="form-control" name="forfait">
              
            </select>
            <span style="font-size: 0.8em; color: maroon;">Pour le moment seul flooz et Tmoney sont acceptés</span>
          </div>
        <br>
    </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Enregistrer</button>
      </div>
      </form>    
  </div> 
  </div>
  </div>
@endsection