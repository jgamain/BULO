<div class="header row">
			<div class="navbar navbar-default navbar-fixed-top">
				<div class="navbar-inner">
					<h1 class="navbar-header">
						<a class="navbar-brand" href="index.html">
							<img src="images/logo.jpg" alt="BULO" class="logo">
						</a>
					</h1>
					<ul class="nav navbar-nav pull-right" id="dd">
						<li id="accueil">
							<a href="index.php">
								<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
								<br />Accueil
							</a>
						</li>
						<li id="catalogue">
							<a href="catalogue.php">
								<span class="glyphicon glyphicon-book" aria-hidden="true"></span>
								<br />Catalogue
							</a>
						</li>
						<li class="popover-markup" id="compte">
							<a href="#" class="trigger" data-placement="bottom">
								<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
								<br />Mon compte
								<div class="content hide">
									<form method="post" class="form-popover" action="connexion.php">
										<div class="form-group">
											<label for="login">Login</label>
											<input type="text" class="form-control" name="login" id="login" placeholder="Entrez votre login">
										</div>
										<div class="form-group">
											<label for="pwd">Mot de passe</label>
											<input type="password" class="form-control" name="pwd" id="pwd" placeholder="Entrez votre mot de passe">
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-info">Connexion</button>
										</div>
									</form>
									<a href="inscription.php">Vous n'êtes pas encore inscrit ?</a>
								</div>
							</a>
						</li>
						<li class="dropdown" id="infos">
							<a data-toggle="dropdown">
								<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
								<br />Infos pratiques<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="horaires_et_acces.php">Horaires et accès</a></li>
								<li><a href="reglement.php">Règlement intérieur et tarifs</a></li>
								<li><a href="#">Nous contacter</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
</div>