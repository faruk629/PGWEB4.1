<div id="formElev">
    <fieldset id="fieldseEleve">
        <legend>Inscription élève</legend>
        <label class="inscriptionLabel">Année étude</label>
        <select name="anneeEtude" id="anneeEtude">
        <?php
        require_once('PDOConnect.php');

        try{
            $pdo = getPDOConnect();
            $query = $pdo->query("SELECT acronyme, libelle FROM anneeEtude ");
            $data = $query->fetchAll();
            foreach($data as $line)
            {
                echo '<option value=' . $line['acronyme'] . '> ' . $line['libelle'] . '</option>';
            }
        }catch(\PDOException $e) {
            echo $e->getMessage();
        }catch(Exception $e){
            echo $e->getMessage();
        }
        ?>
        </select>
        <br>
        <label class="inscriptionLabel">Nom:</label><br>
        <input type="text" id="nom" name="nom" size="30" maxlength="50"
               placeholder="Tapez ici le nom" value="<?php
        if(isset($_SESSION['inscription']['nom']))
            echo $_SESSION['inscription']['nom'];?>"  >
        <span class='erreur'><?php
            if(isset($_SESSION['erreur']['nom'])) {
                echo $_SESSION['erreur']['nom'];
            }
            ?></span><br>
        <label class="inscriptionLabel">Prénom:</label><br>
        <input type="text" id="prenom" name="prenom" size="30" maxlength="50"
               placeholder="Tapez le prenom" value="<?php
        if(isset($_SESSION['inscription']['prenom']))
            echo $_SESSION['inscription']['prenom'];?>"  >
        <span class='erreur'><?php
            if(isset($_SESSION['erreur']['prenom'])) {
                echo $_SESSION['erreur']['prenom'];
            }
            ?></span><br>
        <div classe="inscriptionLabel">
            Choisissez :
            <label for="sexeF">F</label>
            <input type="radio" id="sexeF" name="sexe" value="F">
            <label for="sexeH">M</label>
            <input type="radio" id="sexeH" name="sexe" value="M">
            <span class='erreur'><?php
                if(isset($_SESSION['erreur']['sexe'])) {
                    echo $_SESSION['erreur']['sexe'];
                }
                ?></span><br>
        </div>
        <label class="inscriptionLabel">Numero registre national:</label><br>
        <input type="text" id="nRegistre" name="nRegistre" size="30" maxlength="11"
               placeholder="Tapez ici le registre national" value="<?php
        if(isset($_SESSION['inscription']['nRegistre']))
            echo $_SESSION['inscription']['nRegistre'];?>"  >
        <span class='erreur'><?php
            if(isset($_SESSION['erreur']['nRegistre'])) {
                echo $_SESSION['erreur']['nRegistre'];
            }
            ?></span><br>

        <label class="inscriptionLabel">Date de naissance:</label><br>
        <input type="date" id="dateNaissance" name="dateNaissance" value="<?php
        if(isset($_SESSION['inscription']['dateNaissance']))
            echo $_SESSION['inscription']['dateNaissance'];?>"  >
        <span class='erreur'><?php
            if(isset($_SESSION['erreur']['dateNaissance'])) {
                echo $_SESSION['erreur']['dateNaissance'];
            }
            ?></span><br>
        <label class="inscriptionLabel">Rue:</label><br>
        <input type="text" id="rue" name="rue" size="30" maxlength="50"
               placeholder="Tapez ici la rue" value="<?php
        if(isset($_SESSION['inscription']['rue']))
            echo $_SESSION['inscription']['rue'];?>"  >
        <span class='erreur'><?php
            if(isset($_SESSION['erreur']['rue'])) {
                echo $_SESSION['erreur']['rue'];
            }
            ?></span><br>

        <label class="inscriptionLabel">Numéro de la rue:</label><br>
        <input type="text" id="nRue" name="nRue" size="30" maxlength="50"
               placeholder="Tapez ici le numéro de la rue" value="<?php
        if(isset($_SESSION['inscription']['nRue']))
            echo $_SESSION['inscription']['nRue'];?>"  >
        <span class='erreur'><?php
            if(isset($_SESSION['erreur']['nRue'])) {
                echo $_SESSION['erreur']['nRue'];
            }
            ?></span><br>
        <label class="inscriptionLabel">Code postal:</label><br>
        <input type="text" id="codePostal" name="codePostal" size="30" maxlength="50"
               placeholder="Tapez ici le code postal" value="<?php
        if(isset($_SESSION['inscription']['codePostal']))
            echo $_SESSION['inscription']['codePostal'];?>"  >
        <span class='erreur'><?php
            if(isset($_SESSION['erreur']['codePostal'])) {
                echo $_SESSION['erreur']['codePostal'];
            }
            ?></span><br>

        <label class="inscriptionLabel">Ville:</label><br>
        <input type="text" id="ville" name="ville" size="30" maxlength="50"
               placeholder="Tapez ici la ville" value="<?php
        if(isset($_SESSION['inscription']['ville']))
            echo $_SESSION['inscription']['ville'];?>"  >
        <span class='erreur'><?php
            if(isset($_SESSION['erreur']['ville'])) {
                echo $_SESSION['erreur']['ville'];
            }
            ?></span><br>
        <label> Nombre de tuteur : </label>
        <input type="radio" name="tab" value="one" onclick="show2(this.value);"  checked/> 1
        <input type="radio" name="tab" value="two" onclick="show2(this.value);" /> 2
    </fieldset>
</div>

