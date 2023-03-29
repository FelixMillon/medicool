function changecolor(id)
{
  document.getElementById(id).style.backgroundColor = "#d74e09";
}

function backcolor(id)
{
  document.getElementById(id).style.backgroundColor = "#f0f0c9";
}

function traiterNom() {
  let nom = document.getElementById("nom").value;
  nom = nom.toUpperCase();
  document.getElementById("nom").value = nom;

  const regex = /^[a-zA-Z\s]+$/;

  if (nom.length < 2) {
    document.getElementById("nom").style.backgroundColor = "red";
  }else if(nom == "") {
    document.getElementById("nom").style.backgroundColor = "";
  }else if(regex.test(nom)){
    document.getElementById("nom").style.backgroundColor = "green";
  }

}


function traiterLib() {
  let lib = document.getElementsByClassName("lib").value;
  document.getElementsByClassName("lib").value = lib;

  const regex = /^[a-zA-Z\s]+$/;

  if (lib.length < 2) {
    document.getElementsByClassName("lib").style.backgroundColor = "red";
  }else if(lib == "") {
    document.getElementsByClassName("lib").style.backgroundColor = "";
  }else if(regex.test(lib)){
    document.getElementsByClassName("lib").style.backgroundColor = "green";
  }

}





function traiterEmail() {
  let email = document.getElementById("email").value;

  const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;;

  if (regex.test(email)) {
      document.getElementById("email").style.backgroundColor = "green";
  } else if(email == "") {
    document.getElementById("email").style.backgroundColor = "";
  } else if(!regex.test(email)) {
      document.getElementById("email").style.backgroundColor = "red";
  }
}

