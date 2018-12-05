<?php
DECLARE(strict_types=1);
function setFormRespNameAndID(string $statut,string $nom,string $prenom,string $sexe,
                                    string $nRegistre,string $email,string
                                    $mobile, string $telephone) {
    ?>
    <label class="inscriptionLabel">Lien de parenté :</label>
    <select id="<?php echo $statut?>" name="<?php echo $statut?>">
        <option value="père">Père</option>>
        <option value="mère">Mère</option>>
        <option value="tuteur">Tuteur</option>>
        <option value="tutrice">Tutrice</option>>
    </select>
    <br>
    <label class="inscriptionLabel">Nom:</label><br>
        <input type="text" id="<?php echo $nom ?>" name="<?php echo $nom ?>" size="30" maxlength="50"
               placeholder="Tapez ici le nom" value="<?php
        if(isset($_SESSION['inscription'][$nom]))
            echo $_SESSION['inscription'][$nom];?>" required >
        <span class='erreur'><?php
            if(isset($_SESSION['erreur'][$nom])) {
                echo $_SESSION['erreur'][$nom];
            }
            ?></span><br>
        <label class="inscriptionLabel">Prénom:</label><br>
        <input type="text" id="<?php echo $prenom ?>" name="<?php echo $prenom ?>" size="30" maxlength="50"
               placeholder="Tapez le prenom" value="<?php
        if(isset($_SESSION['inscription'][$prenom]))
            echo $_SESSION['inscription'][$prenom];?>" required >
        <span class='erreur'><?php
            if(isset($_SESSION['erreur'][$prenom])) {
                echo $_SESSION['erreur'][$prenom];
            }
            ?></span><br>
        <div class="inscriptionLabel">
            Choisissez :
            <label for="sexeF">F</label>
            <input type="radio" id="<?php echo $sexe ?>F" name="<?php echo $sexe ?>" value="Feminin">
            <label for="sexeH">M</label>
            <input type="radio" id="<?php echo $sexe ?>M" name="<?php echo $sexe ?>" value="Masculin">
            <span class='erreur'><?php
                if(isset($_SESSION['erreur'][$sexe])) {
                    echo $_SESSION['erreur'][$sexe];
                }
                ?></span><br>
        </div>
        <label class="inscriptionLabel">Numero registre national:</label><br>
        <input type="text" id="<?php echo $nRegistre ?>" name="<?php echo $nRegistre ?>" size="30" maxlength="11"
               placeholder="Tapez ici le registre national" value="<?php
        if(isset($_SESSION['inscription'][$nRegistre]))
            echo $_SESSION['inscription'][$nRegistre];?>" required >
    <span class='erreur'><?php
        if(isset($_SESSION['erreur'][$nRegistre])) {
            echo $_SESSION['erreur'][$nRegistre];
        }
        ?></span><br>
        <label class="inscriptionLabel">Email:</label><br>
        <input type="text" id="<?php echo $email ?>" name="<?php echo $email ?>" size="30" maxlength="50"
               placeholder="Tapez ici l'adresse email" value="<?php
        if(isset($_SESSION['inscription'][$email]))
            echo $_SESSION['inscription'][$email];?>" required >
    <span class='erreur'><?php
        if(isset($_SESSION['erreur'][$email])) {
            echo $_SESSION['erreur'][$email];
        }
        ?></span><br>

        <label class="inscriptionLabel">Mobile :</label><br>
        <input type="text" id="<?php echo $mobile ?>" name="<?php echo $mobile ?>" size="30" maxlength="50"
               placeholder="Tapez ici le mobile" value="<?php
        if(isset($_SESSION['inscription'][$mobile]))
            echo $_SESSION['inscription'][$mobile];?>" required >
    <span class='erreur'><?php
        if(isset($_SESSION['erreur'][$mobile])) {
            echo $_SESSION['erreur'][$mobile];
        }
        ?></span><br>

        <label class="inscriptionLabel">Telephone:</label><br>
        <input type="text" id="<?php echo $telephone ?>" name="<?php echo $telephone ?>" size="30" maxlength="50"
               placeholder="Tapez ici le telephone" value="<?php
        if(isset($_SESSION['inscription'][$telephone]))
            echo $_SESSION['inscription'][$telephone];?>"  >
    <span class='erreur'><?php
        if(isset($_SESSION['erreur'][$telephone])) {
            echo $_SESSION['erreur'][$telephone];
        }
        ?></span><br>

<?php
}
?>