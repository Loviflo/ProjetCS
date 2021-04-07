


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ex1</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">

</head>
<body  onload="displayIngredients()">
    <nav>
    <a class="navbar-brand" href="http://zemeo.com/exam2/html/kemeo/index.php">Accueil</a>

        <ul>
            <li class="nav-item active">
                <a class="nav-link" href="http://zemeo.com/exam2/html/kemeo/index_ex1.php">Reporting de Formation <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="http://zemeo.com/exam2/html/kemeo/index_ex2.php">API Star Wars <span class="sr-only">(current)</span></a>
            </li>
        </ul>


</nav>    
    <!--        FORM POP UP SALARIE-->

    <div id ="formSalarie" class="formSalarie">

        <div>
                <h1>Inscription Salarié</h1>
            <br>
            <div class="div_salarie_form">
                <input id ="prenom_form" type="text" placeholder="Prénom...">
                <input id ="nom_form" type="text" placeholder="Nom...">
            </div>
            <br>
            <div class="div_date_form">
                <div>
                    <label  for="date_debut_form">Date de début:</label>
                    <br>
                        <input id="date_debut_form" type="date">
                </div>
                <div>
                    <label for="date_fin_form">Date de fin:</label>
                    <br>
                        <input id="date_fin_form" type="date">
                </div>
            </div>
                <br>
                <select id ='formation_form'>
                    <option>--Choisir une formation--</option>
                    <option  value='Allemand'>Allemand</option><option  value='Anglais'>Anglais</option><option  value='Assistance informatique'>Assistance informatique</option><option  value='Excel'>Excel</option><option  value='Expert digital marketing'>Expert digital marketing</option><option  value='Francais'>Francais</option><option  value='Les bases du marketing'>Les bases du marketing</option><option  value='Maintenance informatique'>Maintenance informatique</option><option  value='Marketing digital'>Marketing digital</option><option  value='Power Point'>Power Point</option>                </select>
            <br><br>
                <textarea id="commentaire_form" rows="4" cols="50" placeholder="Commentaire..."></textarea>
                <br><br>
                <input type="button" onclick="inscriptionSalarie()" value="Confirmer">
                <input type="button" onclick="annulerFormSalarie()" value="Annuler">

        </div>
    </div>


        <h1>Reporting de Formation</h1>
        <div class="div_afficher">
            <button name = "afficher" value="afficher" onclick="afficherFiltre()" id ="bouton"></button>
        </div>

        <br>

<!--        //CHECKBOXE-->
        <div id ="fonction_hidden" class="fonction_hidden">
        <div class="div_checkbox">

            <div class="column">
                <p>Salarié</p>
                <label>David Zerbib<div class='input_check'><input type='checkbox' value='David Zerbib'   name='radioSalarie' id='radioSalarie' class='checkedS'></div></label><label>Dylan BESONHE<div class='input_check'><input type='checkbox' value='Dylan BESONHE'   name='radioSalarie' id='radioSalarie' class='checkedS'></div></label><label>Fabrice LEMAIRE<div class='input_check'><input type='checkbox' value='Fabrice LEMAIRE'   name='radioSalarie' id='radioSalarie' class='checkedS'></div></label><label>Jordan ZOUBERT<div class='input_check'><input type='checkbox' value='Jordan ZOUBERT'   name='radioSalarie' id='radioSalarie' class='checkedS'></div></label><label>Louis MECHITOUA<div class='input_check'><input type='checkbox' value='Louis MECHITOUA'   name='radioSalarie' id='radioSalarie' class='checkedS'></div></label><label>Salome FUKS<div class='input_check'><input type='checkbox' value='Salome FUKS'   name='radioSalarie' id='radioSalarie' class='checkedS'></div></label><label>Sebastien BLOCHET<div class='input_check'><input type='checkbox' value='Sebastien BLOCHET'   name='radioSalarie' id='radioSalarie' class='checkedS'></div></label><label>Victor PICAUD<div class='input_check'><input type='checkbox' value='Victor PICAUD'   name='radioSalarie' id='radioSalarie' class='checkedS'></div></label>            </div>

            <div class="vr"></div>

            <div class="column">
                <p>Groupe</p>
                <label>Informatique<div class='input_check'><input type='checkbox' id='radioGroupe' value='Informatique'   name='radioGroupe' class='checkedG'></div></label><label>Langues<div class='input_check'><input type='checkbox' id='radioGroupe' value='Langues'   name='radioGroupe' class='checkedG'></div></label><label>Marketing<div class='input_check'><input type='checkbox' id='radioGroupe' value='Marketing'   name='radioGroupe' class='checkedG'></div></label><label>Office365<div class='input_check'><input type='checkbox' id='radioGroupe' value='Office365'   name='radioGroupe' class='checkedG'></div></label>            </div>

            <div class="vr"></div>

            <div class="column">
                <p>Formation</p>
                <label >Allemand<div class='input_check'><input type='checkbox' id='radioFormation' value='Allemand'  name='radioFormation' class='checkedF' ></div></label><label >Anglais<div class='input_check'><input type='checkbox' id='radioFormation' value='Anglais'  name='radioFormation' class='checkedF' ></div></label><label >Assistance informatique<div class='input_check'><input type='checkbox' id='radioFormation' value='Assistance informatique'  name='radioFormation' class='checkedF' ></div></label><label >Excel<div class='input_check'><input type='checkbox' id='radioFormation' value='Excel'  name='radioFormation' class='checkedF' ></div></label><label >Expert digital marketing<div class='input_check'><input type='checkbox' id='radioFormation' value='Expert digital marketing'  name='radioFormation' class='checkedF' ></div></label><label >Francais<div class='input_check'><input type='checkbox' id='radioFormation' value='Francais'  name='radioFormation' class='checkedF' ></div></label><label >Les bases du marketing<div class='input_check'><input type='checkbox' id='radioFormation' value='Les bases du marketing'  name='radioFormation' class='checkedF' ></div></label><label >Maintenance informatique<div class='input_check'><input type='checkbox' id='radioFormation' value='Maintenance informatique'  name='radioFormation' class='checkedF' ></div></label><label >Marketing digital<div class='input_check'><input type='checkbox' id='radioFormation' value='Marketing digital'  name='radioFormation' class='checkedF' ></div></label><label >Power Point<div class='input_check'><input type='checkbox' id='radioFormation' value='Power Point'  name='radioFormation' class='checkedF' ></div></label>            </div>
            <div class="vr"></div>

            <div>
                <p>Période</p>
                <input type="month" id='radioDateDebut'  name='radioDateDebut'>
            </div>

        </div>
        <br>
        <div class="btn_filtre">
            <button onclick="filterTab()" id="myInput" >Filtrer</button>
            <button onclick="filterRenitialise()" id="myInput" >Réinitialiser</button>
        </div>
        </div>
    <br><br>
        <div style="text-align:center;">
            <input oninput="research()" class="search" type="text" id="search-user" placeholder="Recherche...">
        </div>
        <br><br>
        <div id="div_ing">
        </div>
    <br>

</body>
</html>

<script>
    var checkG = 0;
    var checkF = 0;
    var checkS = 0;
    //verifier que 1 checkbox est checked
    var checkboxes = document.getElementsByClassName("checkedG");
    for (i=0; i<checkboxes.length; i++) { // boucle for //
        if (checkboxes[i].checked == true){
            checkG++;
        }
    }
    var checkboxes = document.getElementsByClassName("checkedF");
    for (i=0; i<checkboxes.length; i++) { // boucle for //
        if (checkboxes[i].checked == true){
            checkF++;
        }
    }
    var checkboxes = document.getElementsByClassName("checkedS");
    for (i=0; i<checkboxes.length; i++) { // boucle for //
        if (checkboxes[i].checked == true){
            checkS++;
        }
    }

    if (checkG == 0 ||checkF == 0 || checkS == 0 ){

        function displayIngredients() {

            const request = new XMLHttpRequest();
            request.open('GET', 'php_traitement_ex1/traitement_ex1.php');
            request.onreadystatechange = function () {
                if (request.readyState === 4) { // la requete est terminée
                    const divIngredients = document.getElementById('div_ing');
                    divIngredients.innerHTML = request.responseText;
                }
            };
            request.send();

        }
    }
    function research() {
        const list = document.getElementById('div_ing');
        const search = document.getElementById('search-user').value;
        let user = search.trim();

        const request = new XMLHttpRequest();
        request.open('GET', 'php_traitement_ex1/traitement_ex1.php?user=' + user);
        request.onreadystatechange = function() {
            if(request.readyState === 4 ) {
                list.innerHTML = request.responseText;
            } 
        };
        request.send();
    }
   function filterTab(){

       var checkG = 0;
       var checkF = 0;
       var checkS = 0;
       const periode = document.getElementById('radioDateDebut').value;

       const tab = document.getElementById('div_ing');

       //verifier que 1 checkbox est checked
       var checkboxes = document.getElementsByClassName("checkedG");
       for (i=0; i<checkboxes.length; i++) { // boucle for //
           if (checkboxes[i].checked == true){
               checkG++;

           }
       }
       var checkboxes = document.getElementsByClassName("checkedF");
       for (i=0; i<checkboxes.length; i++) { // boucle for //
           if (checkboxes[i].checked == true){
               checkF++;
           }
       }
       var checkboxes = document.getElementsByClassName("checkedS");
       for (i=0; i<checkboxes.length; i++) { // boucle for //
           if (checkboxes[i].checked == true){
               checkS++;
           }
       }



       var groupe="" ;
       var checkboxes = document.getElementsByClassName("checkedG");

       for (i=0; i<checkboxes.length; i++) { // boucle for //
           if (checkboxes[i].checked) { // si la boite est cochée //
               groupes = checkboxes[i].value; // Ajouter l'élément à la liste //
               groupe += groupes + '/'
           }
       }

       var formation ="";
       var checkboxes = document.getElementsByClassName("checkedF");
       for (i=0; i<checkboxes.length; i++) { // boucle for //
           if (checkboxes[i].checked) { // si la boite est cochée //
               formations = checkboxes[i].value; // Ajouter l'élément à la liste //
               formation += formations + '/'

           }
       }

       var salarie ="";
       var checkboxes = document.getElementsByClassName("checkedS");
       for (i=0; i<checkboxes.length; i++) { // boucle for //
           if (checkboxes[i].checked) { // si la boite est cochée //
               salaries = checkboxes[i].value; // Ajouter l'élément à la liste //
               salarie += salaries + '/'

           }
       }

       if (checkF==0){
           var formation ="";
           var checkboxes = document.getElementsByClassName("checkedF");
           for (i=0; i<checkboxes.length; i++) { // boucle for //
               if (checkboxes[i].checked == false) { // si la boite est cochée //
                   formations = checkboxes[i].value; // Ajouter l'élément à la liste //
                   formation += formations + '/'
               }
           }
       }

       if (checkG==0){
           var groupe="" ;
           var checkboxes = document.getElementsByClassName("checkedG");

           for (i=0; i<checkboxes.length; i++) { // boucle for //
               if (checkboxes[i].checked == false) { // si la boite est cochée //
                   groupes = checkboxes[i].value; // Ajouter l'élément à la liste //
                   groupe += groupes + '/'

               }
           }
       }

       if (checkS==0){
           var salarie ="";
           var checkboxes = document.getElementsByClassName("checkedS");
           for (i=0; i<checkboxes.length; i++) { // boucle for //
               if (checkboxes[i].checked == false) { // si la boite est cochée //
                   salaries = checkboxes[i].value; // Ajouter l'élément à la liste //
                   salarie += salaries + '/'

               }
           }
       }

       const request = new XMLHttpRequest();
       request.open('GET', 'php_traitement_ex1/traitement_ex1.php?groupe=' + groupe +'&&formation='+formation +'&&salarie='+salarie+'&&periode='+periode);
       request.onreadystatechange = function() {
           if(request.readyState === 4 ) {
               tab.scrollTop = tab.scrollHeight;
               tab.innerHTML = request.responseText;
           }
       };
       request.send();
   }

    function filterRenitialise(){
         document.getElementById('radioDateDebut').value = "";


        var checkboxes = document.getElementsByClassName("checkedG");
        for (i=0; i<checkboxes.length; i++) { // boucle for //
            if (checkboxes[i].checked == true){
                checkboxes[i].checked = false;
            }
        }
        var checkboxes = document.getElementsByClassName("checkedF");
        for (i=0; i<checkboxes.length; i++) { // boucle for //
            if (checkboxes[i].checked == true){
                checkboxes[i].checked = false;
            }
        }
        var checkboxes = document.getElementsByClassName("checkedS");
        for (i=0; i<checkboxes.length; i++) { // boucle for //
            if (checkboxes[i].checked == true){
                checkboxes[i].checked = false;
            }
        }
        displayIngredients();
    }
    //innerHtml button
    document.getElementById("bouton").innerHTML = "Afficher les filtres &#8681;";
    
    function afficherFiltre(){

        if (document.getElementById("bouton").value == "afficher") {
            document.getElementById("fonction_hidden").style.display = "block"
            document.getElementById("bouton").innerHTML = "Cacher les filtres ⇧";
            document.getElementById("bouton").value = "cacher"
        }else{
            document.getElementById("fonction_hidden").style.display = "none"
            document.getElementById("bouton").innerHTML = "Afficher les filtres &#8681;";
            document.getElementById("bouton").value = "afficher"
        }
    }

    function formSalarie(){
        document.getElementById("formSalarie").style.display = "flex"
    }
    function annulerFormSalarie(){
        document.getElementById("formSalarie").style.display = "none"
    }
    function inscriptionSalarie(){

        const form = document.getElementById('reponse_form');
        var nomForm = document.getElementById("nom_form").value
        var prenomForm = document.getElementById("prenom_form").value
        var formationForm = document.getElementById("formation_form").value
        var dateDebutForm = document.getElementById("date_debut_form").value
        var dateFinForm = document.getElementById("date_fin_form").value
        var commentaireForm = document.getElementById("commentaire_form").value

        nomForm = nomForm.toUpperCase();
        console.log(dateDebutForm);
        console.log(dateFinForm);

        if (nomForm == '' || prenomForm=='' || formationForm=='--Choisir une formation--' || dateDebutForm=='' || dateFinForm=='' || commentaireForm==''){
           return alert("Verifiez que tous les champs soient bien remplis")
        }

        var pattern = new RegExp(/[~`!#$%\^&*+=\-\[\]\';,/{}|\":<>\?]/); //unacceptable chars
        if (pattern.test(nomForm) || pattern.test(prenomForm) || pattern.test(commentaireForm)) {
            return alert("Caractères spéciaux non autorisés");
        }
        console.log(nomForm);
        console.log(prenomForm);
        console.log(formationForm);
        console.log(dateDebutForm);
        console.log(dateFinForm);
        console.log(commentaireForm);

        const request = new XMLHttpRequest();
        request.open('GET', 'php_traitement_ex1/traitement_ex1.php?nomForm=' + nomForm +'&&prenomForm='+prenomForm +'&&formationForm='+formationForm +'&&dateDebutForm='+dateDebutForm +'&&dateFinForm='+dateFinForm +'&&commentaireForm='+commentaireForm);
        request.onreadystatechange = function() {
            if(request.readyState === 4 ) {
                alert(request.responseText);
            }
        };
        request.send();
    }

</script>