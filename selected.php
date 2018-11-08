<option value="Développement" <?php if 
            (!(strcmp("Développement", $ligne_competence['categorie']))) {
                echo "selected=\"selected\"";
            } ?>>Développement</option>
            <option value="Infographie" <?php if 
            (!(strcmp("Infographie", $ligne_competence['categorie']))) {
                echo "selected=\"selected\"";
            } ?>>Infographie</option>
            <option value="Gestion de projet" <?php if 
            (!(strcmp("Gestion de projet", $ligne_competence['categorie']))) {
                echo "selected=\"selected\"";
            } ?>>Gestion de projet</option>