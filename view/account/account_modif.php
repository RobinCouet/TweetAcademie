<?php require(ROOT . '/view/header.php'); ?>
<div class="container well">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <h1>Modifier mon Compte <br/></h1>
        </div>
    </div>
    <form method="post">
        <div class="row">
            <div class="col-md-offset-2 col-md-3">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <?php echo '<input type="text" class="form-control" 
                    id="nom" placeholder="Nom" name="nom" value="' . 
                    $_SESSION["firstname"] . '">'?>
                    
                </div>
            </div>
            <div class="col-md-offset-1 col-md-3">
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <?php 
                    echo '<input type="text" class="form-control" id="prenom"
                    placeholder="Prénom" name="prenom" value="' . 
                    $_SESSION["name"] . '">';
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-3">
                <div class="form-group">
                    <?php 
                    if ($_SESSION["sexe"] == "MALE")
                        echo "<label class=\"radio-inline\"><input 
                    type=\"radio\" name=\"sexe\" value=\"MALE\" checked>
                    Homme</label><label class=\"radio-inline\"><input 
                    type=\"radio\" name=\"sexe\" value=\"FEMALE\">Femme</label>
                    <label class=\"radio-inline\"><input type=\"radio\" 
                        name=\"sexe\" value=\"A\">Autre</label>";
                        elseif ($_SESSION["sexe"] == "FEMALE")
                            echo "<label class=\"radio-inline\"><input 
                        type=\"radio\" name=\"sexe\" value=\"MALE\" >Homme
                    </label>
                    <label class=\"radio-inline\"><input type=\"radio\" 
                        name=\"sexe\" value=\"FEMALE\" checked>Femme</label>
                        <label 
                        class=\"radio-inline\"><input type=\"radio\"
                        name=\"sexe\"
                        value=\"A\">Autre</label>";
                        else 
                            echo "<label class=\"radio-inline\"><input 
                        type=\"radio\" name=\"sexe\" value=\"MALE\" >Homme
                    </label>
                    <label class=\"radio-inline\"><input type=\"radio\"
                     name=\"sexe\" value=\"FEMALE\">Femme</label>
                     <label class=\"radio-inline\"><input type=\"radio\"
                         name=\"sexe\"
                         value=\"A\" checked>Autre</label>";
                         ?>
                     </div>
                 </div>
                 <div class='col-md-offset-1 col-md-3'>
                    <div class="form-group">
                     <label for="birthdate">Date de naissance</label>
                     <?php echo '<input type="date" class="form-control" 
                     name="birthdate" id="birthdate" value="' .
                     $_SESSION["birthdate"] . '"/>'; ?>
                 </div>
             </div>
         </div>
         <div class="row">
            <div class="col-md-offset-2 col-md-3">
                <div class="form-group">
                    <label for="place">Adresse</label>
                    <?php 
                    echo '<input type="text" class="form-control"
                    name="place" 
                    id="place" value="' . $_SESSION["place"] . '" />';
                    ?>
                </div>
            </div>
            <div class="col-md-offset-1 col-md-3">
                <div class="form-group">
                    <label for="phone_number">Numero de telephone</label>
                    <?php 
                    echo '<input type="text" class="form-control"
                    name="phone_number" 
                    id="phone_number" value="' . $_SESSION["phone_number"]
                    . '" />';
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-3">
                <div class="form-group">
                    <label for="mail">Email address</label>
                    <?php 
                    echo '<input type="email" class="form-control" id="mail"
                    placeholder="Enter email" name="mail" value="' . 
                    $_SESSION["mail"] . '">';
                    ?>

                </div>
            </div>
            <div class="col-md-offset-1 col-md-3">
                <div class="form-group">
                    <label for="pseudo">Login</label>
                    <?php 
                    echo '<input type="text" class="form-control"
                    id="pseudo"
                    placeholder="Enter login" name="pseudo" value="' . 
                    $_SESSION["login"] . '">';
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-2 col-md-3">
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password">
                </div>
            </div>
            <div class="col-md-offset-1 col-md-3">
                <div class="form-group">
                    <label for="vpassword">Vérification mot de passe</label>
                    <input type="password" class="form-control" id="vpassword" placeholder="Vérification mot de passe" name="vpassword">
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-offset-6 col-md-3">
                <button type="submit" class="btn btn-primary" name="submit">Envoyer mes informations</button>
            </div>
        </div>
    </form>
    <?php echo $this->success;
    ?>
    <br>
    <form method="post">
        <div class="row">
            <div class="col-md-offset-2 col-md-3">
                <div class="form-group">
                    <label for="desc">Description</label>
                    <input type="text" class="form-control" id="desc" placeholder="Votre description" name="desc">
                </div>
            </div>
            <div class="col-md-offset-1 col-md-3">
                <div class="form-group">
                    <label for="hexa">Votre thême</label>
                    <input type="color" class="form-control" id="hexa" name="hexa">
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-offset-6 col-md-3">
                <button type="submit" class="btn btn-primary" name="theme">Envoyer mes informations</button>
            </div>
        </div>
    </form>
    <br>
    <form method="post">
     <div class="row">
        <div class="col-md-offset-6 col-md-3">
            <button type="submit" class="btn btn-primary" name="delete">Supprimer mon compte</button>
        </div>
    </div>
</form>
<form method="POST" enctype="multipart/form-data">  
    <label for="profile">Photo de profil</label>
    <input type="file" name="profil" id="profile">
    <input type="submit" name="profil_submit">
</form>
<form method="POST" enctype="multipart/form-data">
    <label for="cover">Photo de couverture</label>
    <input type="file" name="cover" id="cover">
    <input type="submit" name="cover_submit">
</form>
</div>
