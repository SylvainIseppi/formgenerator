<?php ?>
<style>
    h5::before {
        display: block;
        height: 20px;
        content: "";
    }
</style>
<form action="index.php?page=nombrerequete2" method="POST">
    <div id="container" class="row">
        <div class="col s2">
            <div class="input-field">
                <input type="checkbox" name="selectAll" id="selectAll"/>
                <label for="selectAll">Select All</label>
            </div>
            <section id="formselectall">
                <h5>Select All</h5>

                <div class="divider"></div>
                <div class="input-field">
                    <input type="text" name="nomtableSA" id="nomtableSA" class="validate"/>
                    <label for="nomtableSA">Nom de la table</label>
                </div>
                <div class="input-field">
                    <input type="text" name="nbparametreSA" id="nbparametreSA" class="validate"/>
                    <label for="nbparametreSA">Nombre de paramètres</label>
                </div>
            </section>
        </div>
        <div class="col s2">
            <div class="input-field">
                <input type="checkbox" name="selectOne" id="selectOne"/>
                <label for="selectOne">Select One</label>
            </div>
            <section id="formselectone">
                <h5>Select One</h5>

                <div class="divider"></div>
                <div class="input-field">
                    <input type="text" name="nomtableSO" id="nomtableSO" class="validate"/>
                    <label for="nomtableSO">Nom de la table</label>
                </div>
                <div class="input-field">
                    <input type="text" name="nbelementSO" id="nbelementSO" class="validate"/>
                    <label for="nbelementSO">Nombre d'élements</label>
                </div>
                <div class="input-field">
                    <input type="text" name="nbparametreSO" id="nbparametreSO" class="validate"/>
                    <label for="nbparametreSO">Nombre de paramètres</label>
                </div>
            </section>
        </div>
        <div class="col s2">
            <div class="input-field">
                <input type="checkbox" name="insert" id="insert"/>
                <label for="insert">Insert</label>
            </div>
            <section id="forminsert">
                <h5>Insert</h5>

                <div class="divider"></div>
                <div class="input-field">
                    <input type="text" name="nomtableInsert" id="nomtableInsert" class="validate"/>
                    <label for="nomtableInsert">Nom de la table</label>
                </div>
                <div class="input-field">
                    <input type="text" name="nbelementInsert" id="nbelementInsert" class="validate"/>
                    <label for="nbelementInsert">Nombre d'éléments à insérer</label>
                </div>
            </section>
        </div>
        <div class="col s2">
            <div class="input-field">
                <input type="checkbox" name="update" id="update"/>
                <label for="update">Update</label>
            </div>
            <section id="formupdate">
                <h5>Update</h5>

                <div class="divider"></div>
                <div class="input-field">
                    <input type="text" name="nomtableUpdate" id="nomtableUpdate" class="validate"/>
                    <label for="nomtableUpdate">Table à modifier</label>
                </div>
                <div class="input-field">
                    <input type="text" name="nbelementUpdate" id="nbelementUpdate" class="validate"/>
                    <label for="nbelementUpdate">Nombre d'éléments à modifier</label>
                </div>
                <div class="input-field">
                    <input type="text" name="nbparametreUpdate" id="nbparametreUpdate" class="validate"/>
                    <label for="nbparametreUpdate">Nombre de paramètres</label>
                </div>
            </section>
        </div>
        <div class="col s2">
            <div class="input-field">
                <input type="checkbox" name="update" id="delete"/>
                <label for="delete">Delete</label>
            </div>
            <section id="formdelete">
                <h5>Delete</h5>

                <div class="divider"></div>
                <div class="input-field">
                    <input type="text" name="nomtableDel" id="nomtableDel" class="validate"/>
                    <label for="nomtableDel">Table à supprimer</label>
                </div>
                <div class="input-field">
                    <input type="text" name="nbparametreDel" id="nbparametreDel" class="validate"/>
                    <label for="nbparametreDel">Nombre de paramètres</label>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <button class="btn waves-effect waves-light center-align" type="submit" name="valider" id="valider">valider
            <i class="mdi-content-send right"></i>
        </button>
    </div>
</form>
<?php require('footer.php'); ?>
<script>
    (function () {
        $('input[type=checkbox]').prop('checked', false);

        $('#formselectall').hide();
        $('#formselectone').hide();
        $('#forminsert').hide();
        $('#formupdate').hide();
        $('#formdelete').hide();

        $('input[name=selectAll]').click(function () {
            $('#formselectall').toggle();
        });
        $('input[name=selectOne]').click(function () {
            $('#formselectone').toggle();
        });
        $('input[name=insert]').click(function () {
            $('#forminsert').toggle();
        });
        $('input[name=update]').click(function () {
            $('#formupdate').toggle();
        });
        $('input[name=delete]').click(function () {
            $('#formdelete').toggle();
        });
    })();
</script>