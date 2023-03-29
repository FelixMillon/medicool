<style>


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
border-radius: 10px;
transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
background : white;
color : black;
}

.btn-blue{
    background:#86B9BB;  
    color : white;
}
</style>


<div style="height: 88vh;padding-top: 10%;"> 
    <div class="container d-flex  flex-wrap text-light" style="height:75%;width:50%;background:#86B9BB;  border-radius: 11px;"> 
        <div class="col-12">
           <div class="p-3 fs-4"><u>Votre compte est bloqué </u></div> </a>
        </div>
        <div class="col-6 fs-5 text-end" style="padding-top:1%;">Compte email :</div>
        <div class="col-6 fs-5 text-start" style="padding: 1% 0 0 2%;">{{email}}</div>
        <div class="col-6 fs-5 text-end" style="padding-top:1%;">Numéro du compte :</div>
        <div class="col-6 fs-5 text-start" style="padding: 1% 0 0 2%;">{{numuser}}</div>

        <div class="col-12 fs-5" style="text-align: justify; padding-left:5%;">
        Raison :<br> Votre compte a été bloqué suite à 3 tentatives de connexion échouées. <br>
        Pour récupèrer votre compte il vous faudra choisir l'une des deux options ci-dessous</div>

        <div class="col-6" style="padding-top:1%; ">
            <a class="btn form w-75 text-center "> Via question secrète  </a>
        </div>
        <div class="col-6" style="padding-top:1%;">
            <a class="btn form w-75 text-center "> Via e-mail  </a>
        </div>
    </div>

  
    
</div>



   
    

