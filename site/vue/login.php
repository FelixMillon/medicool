<style>
input::placeholder {
    font-weight: bold;
    opacity: .5;
}
body{
  justify-content: unset;
}

.form{
	display: block;
width: 100%;
padding: .375rem .75rem;
font-size: 1rem;
font-weight: 400;
line-height: 1.5;
color: #212529;
background-color: #fff;
background-clip: padding-box;
border: 1px solid #ced4da;
-webkit-appearance: none;
-moz-appearance: none;
appearance: none;
border-radius: .25rem;
transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
background : #3B7476;
color : white;
}

</style>

<div class="row" style="height: 88vh; margin : 0; padding : 0;" >
	<div class="col-4"></div>
	<div class="col-4 text-light"> 
		<form method="post" class="d-flex flex-column bd-highlight mb-3">
			<div class="p-2 bd-highlight">
				<div style="padding-top : 20%;">
				</div>
			</div>
			<div class="p-2 bd-highlight">
				<div class="container" style="width: 75%; padding: 5% 10% 5% 10%; background:#86B9BB; border-radius:25px;"> 
					<img src="img/logo_login.png" class="bi me-2 img" style="width: 10vw;" role="img" alt=""> 
					<input type="text" class="form text-center" name="email" placeholder="IDENTIFIANT">  <br>
					<input type="password" class="form text-center" name="mdp"  placeholder="MOT DE PASSE"> 
		
					<div class="d-flex justify-content-center" style="width: 75%; padding:5% 13% 0px 13%;" > 
						<input type="submit" class="col-6 form" name="seConnecter" value="Se Connecter" style="margin-right : 5%; border : 5px solid white; border-radius: 15px">
						<input type="reset"  class="col-6 form" value="Annuler" style="margin-right : 5%; border : 5px solid white; border-radius: 15px">
					</div>
				
					<div class="d-flex justify-content-between align-items-center" style="padding-top: 5%">
						<div class="col-6">
							<input type="checkbox" class="form-check-input" id="same-address">
							<label class="form-check-label text-light" for="same-address">
							<small>Se souvenir de moi</small> 
							</label>
						</div>
						<div class="col-6">
							<a href="index.jsp?page=0" class="nav-link link-light"> <small>  Mot de passe oublié ? </small></a> 
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="col-4"></div>
</div>