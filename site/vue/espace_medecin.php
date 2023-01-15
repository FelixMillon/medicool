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

</style>


<div style="height: 88vh;padding-top: 6%;"> 
    <div class="d-flex justify-content-around">
        <div class="col-4">
            <div class="row align-items-center" style="height:100%;background:#86B9BB;  border-radius: 18px;">
                <div class="d-flex flex-column">
                    <div class="p-3"><h4 class="text-light"><u>GESTIONS DES PATIENTS</u></h4></div> 
                    <div class="p-3">
                        <select class="form-select w-50 text-center" style="border-radius:15px;">
                            <option selected>Sélectionner un patient</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justifiy-content-center" style="padding-top:6%">
        <div class="col-2"></div>
        <div class="col-4" style="padding-right:3%;"> 
            <div class="row" style="height:100%;background:#86B9BB;  border-radius: 18px;">
                    <div class="p-3"><h4 class="text-light"><u>INFORMATION DU COMPTE</u></h4></div> 
                    <div class="text-end text-light fs-6 col-5" style="margin-left : 4%">
                        Identifiant compte : 
                        <br>
                        Nom :
                        <br>
                        Spécialisation :
                        <br>
                        Email :
                        <br>
                        Tel :
                    </div>
                    <div class="col-1"></div>
                    <div class="text-start text-light fs-6 col-5" >
                        01
                        <br>
                        Dr John Doe
                        <br>
                        Généraliste
                        <br>
                        john.doe@medicool.fr
                        <br>
                        01 02 03 04 05
                    </div>
                </div>
        </div>
	    <div class="col-4" style="padding-left:3%"> 
            <div class="container row align-items-center" style="height:100%; background:#86B9BB;  border-radius: 18px;">
                <div class="d-flex flex-column">
                    <div class="p-3"><h4 class="text-light"><u>PLANNING</u></h4></div> 
                    <div class="p-3">
                        <a class="btn nav-link form w-50 text-center"> Mon planning </a>
                    </div>
                    <div class="p-3">
                        <a class="btn nav-link form w-50 text-center"> Mes rendes-vous </a>
                    </div>
                </div>
            </div>
	    </div>
	
	    <div class="col-2"></div>
    </div>
</div>
