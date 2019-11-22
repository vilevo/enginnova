@extends('inc.template')

@section('titre')
	Enginnova Community - questions
@endsection

@section('header')
<!-- Page breadcrumb -->
 <section id="mu-page-breadcrumb" style="background-color: #337AB7;">
   <div class="container">
     <div class="row" style="background-color: #337AB7;">
       <div class="col-md-12">
         <div class="mu-page-breadcrumb-area">
           <h2 class="pull-left">Enginnova Learning Program</h2>
           <ol class="breadcrumb pull-right">
            <li><a href="{{ url('acceuil') }}"><i class="fa fa-home"></i>Acceuil</a></li>            
            <li class="active" style="color: gold;">learning Program Pro</li>
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
                  <p>C’est un programme hautement compétitif orienté vers le développement professionnel à travers des formations qui sont en phase et alignées avec le besoin du marché pour former des développeurs de logiciels , des ingénieurs pour alimenter des équipes de technologie et des entreprises du monde entier. Il vise à construire un pont entre talent et opportunité . Il comprend une formation présentielle et une formation à distance basée sur des projets avec les équipes opérationnelles internes d’Enginnova dans les domaines d’Intelligence Artificielle , Réalité virtuelle et Objets Connectés.</p>
                  <ul>
                    <li><h5 style="color: #337AB7;"><b>Types de compétences</b></h5>Le programme couvre des compétences techniques avancées telles que l’Intelligence Artificielle, la réalité virtuelle, Objets Connectés....  Il enseigne également l'éthique de travail et compétences en équipe telles que la communication, le professionnalisme, le leadership , l’innovation et l'intégration.</li>
                    <li><h5 style="color: #337AB7;"><b>Les formations</b></h5>Les formations sont à 70% pratiques et à 30% théoriques. Elles ont pour objectifs non seulement de se rendre compétitif sur le marché de l’emploi, mais également de développer une certaine autonomie à identifier des besoins créer des solutions innovantes répondant à ces besoins.</li>
                  </ul>
                  <h3>Intelligence Artificielle</h3>
                  <p>Chaque module type dure 4 heures et débute par un cours théorique permettant d’aborder le sujet avant de céder la place à la réalisation d’exercices et de projets, ceci afin de consolider les acquis et d’inscrire l’apprenant dans une logique plus globale d’un projet IA.</p>
                  <h4>LES MODULES DE LA FORMATION SUR L'IA</h4>
                  <ul>
                  	<li><h5><span class="label label-success">1</span> Introduction à l'IA : Applications et management</h5></li>
                  	<li><h5><span class="label label-success">2</span> Les bases du Machine Learning</h5></li>
                  	<li><h5><span class="label label-success">3</span> Prérequis Mathématiques pour data science</h5></li>
                  	<li><h5><span class="label label-success">4</span> Data Analyse</h5></li>
                  	<li><h5><span class="label label-success">5</span> Les modèles de prédiction</h5></li>
                  	<li><h5><span class="label label-success">6</span> Introduction à Sickit Learn</h5></li>
                  	<li><h5><span class="label label-success">7</span> Déploiement de son projet IA dans le cloud</h5></li>
                  </ul>
    			  <?php $type = "Learning-program-pro"; ?>
                  <a href='{{ url("formation-inscription/{$type}") }}' class="btn btn-primary"><i class="fa fa-long-arrow-right"></i><b>S'inscrire</b></a>
                  	<hr>
                  <h3>Réalité Virtuelle</h3>
                  <p>Chaque module type dure 4 heures et débute par un cours théorique permettant d’aborder le sujet avant de céder la place à la réalisation d’exercices et de projets, ceci afin de consolider les acquis et d’inscrire l’apprenant dans une logique plus globale d’un projet RV.</p>
                  <h4>LES MODULES DE LA FORMATION SUR la RV</h4>
                  <ul>
                  	<li><h5><span class="label label-success">1</span> Introduction aux technologies immersives</h5></li>
                  	<li><h5><span class="label label-success">2</span> Prise en main des logiciels de modélisation</h5></li>
                  	<li><h5><span class="label label-success">3</span> Utilisation de Unity 3D : Les bases</h5></li>
                  	<li><h5><span class="label label-success">4</span> Utilisation de Unity 3D : Les modules</h5></li>
                  	<li><h5><span class="label label-success">5</span> Utilisation des autres logiciels de RV</h5></li>
                  	<li><h5><span class="label label-success">6</span> Introduction à la réalité augmentée</h5></li>
                  	<li><h5><span class="label label-success">7</span> Création d'une application de réalité virtuelle et réalité augmentée</h5></li>
                  </ul>
                    <a href='{{ url("formation-inscription/{$type}") }}' class="btn btn-primary"><i class="fa fa-long-arrow-right"></i><b>S'inscrire</b></a>
                  	<hr>
                  <h3>Leadership entrepreneurial et innovation</h3>
                  <p>Chaque module type dure 4 heures et débute par un cours théorique permettant d’aborder le sujet avant de céder la place à la réalisation d’exercices et de projets, ceci afin de consolider les acquis et d’inscrire l’apprenant dans une logique plus globale d’un projet.</p>
                  <h4>LES MODULES DE LA FORMATION</h4>
                  <ul>
                  	<li><h5><span class="label label-success">1</span>  Comment identifier un besoin de son environnement ?</h5></li>
                  	<li><h5><span class="label label-success">2</span> Comment palier à un besoin</h5></li>
                  	<li><h5><span class="label label-success">3</span>  Les principes pour développer de l’innovation</h5></li>
                  	<li><h5><span class="label label-success">4</span>  Monétiser ses idées</h5></li>
                  	<li><h5><span class="label label-success">5</span> Profil clé du leadeur</h5></li>
                  	<li><h5><span class="label label-success">6</span> Atelier pratique</h5></li>
                  </ul>
                    <a href='{{ url("formation-inscription/{$type}") }}' class="btn btn-primary"><i class="fa fa-long-arrow-right"></i><b>S'inscrire</b></a><br>
                    <h4><a href="{{ url('learn-to-code-from-scratch') }}"><i class="fa fa-angle-double-right"></i> Découvrir aussi enginnova learn 2 code from scratch</a></h4>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="mu-about-us-right">
                <a id="mu-abtus-video" href="https://www.youtube.com/embed/HN3pm9qYAUs" target="mutube-video">
                  <img src='{{asset("elp_files/assets/img/about-us.jpg")}}' alt="img">
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
