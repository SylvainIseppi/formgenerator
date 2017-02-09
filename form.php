<?php
require_once('Field.class.php');
session_start();
?>
<div class="container full-width">
    <form id="generate" class="row" method="POST" action="generateform">
        <section id="item-list" class="col s3">
            <ul class="collection">
                <li class="collection-item">
                    <h4>Champs</h4>
                </li>
                <li class="collection-item avatar" draggable="true" id="texte" ondragstart="drag(event);">
                    <i class="mdi-editor-format-size circle"></i>
                    <span class="title">Texte</span>

                    <p>Une ligne de texte</p>
                </li>
                <li class="collection-item avatar" draggable="true" id="nombre" ondragstart="drag(event);">
                    <i class="mdi-image-filter-6 circle"></i>
                    <span class="title">Nombre</span>

                    <p>Un nombre entier ou relatif</p>
                </li>
                <li class="collection-item avatar" draggable="true" id="textarea" ondragstart="drag(event);">
                    <i class="mdi-action-subject circle"></i>
                    <span class="title">Zone de texte</span>

                    <p>Plusieurs lignes de texte</p>
                </li>
                <li class="collection-item avatar" draggable="true" id="telephone" ondragstart="drag(event);">
                    <i class="mdi-communication-call circle"></i>
                    <span class="title">Téléphone</span>

                    <p>Numéro de téléphone</p>
                </li>
                <li class="collection-item avatar" draggable="true" id="email" ondragstart="drag(event);">
                    <i class="mdi-content-mail circle"></i>
                    <span class="title">Email</span>

                    <p>Adresse de contact mail</p>
                </li>
                <li class="collection-item avatar" draggable="true" id="url" ondragstart="drag(event);">
                    <i class="mdi-social-public circle"></i>
                    <span class="title">URL</span>

                    <p>Adresse d'un site web</p>
                </li>
                <li class="collection-item avatar" draggable="true" id="checkbox" ondragstart="drag(event);">
                    <i class="mdi-toggle-check-box circle"></i>
                    <span class="title">Checkbox</span>

                    <p>Case à cocher à 2 états</p>
                </li>
            </ul>
        </section>
        <section id="creation" class="col s6">
            <ul class="collection with-header">
                <li class="collection-header valign-wrapper">
                    <h4 class="valign">Votre formulaire</h4>
                    <a class="secondary-content" href="#"><i class="mdi-editor-mode-edit small"></i></a>
                </li>
            </ul>
            <ul id="dropzone" class="drop-zone" ondragover="allowDrop(event)" ondrop="dropCreate(event)">
                <?php
                if (isset($_SESSION['fields'])) {
                    $fields = $_SESSION['fields'];
                    echo $fields->preview();
                }
                ?>
            </ul>
        </section>
        <section id="settings" class="col s3">
            <ul class="collection with-header">
                <li class="collection-header center-align valign-wrapper red lighten-2"
                    ondragover="allowDrop(event)" ondrop="dropDelete(event)">
                    <i class="large mdi-action-delete white-text"></i><h5 class="white-text">Supprimer</h5>
                </li>
            </ul>
            <button class="btn-large waves-effect waves-light" type="submit" form="generate">Envoyer
                <i class="mdi-content-send right"></i>
            </button>
        </section>
    </form>
    <div class="modal" id="modal1">
        <form id="options-form">
            <div class="modal-content" id="options-modal">
                <h3>Options</h3>
            </div>
            <div class="modal-footer">
                <button form="options-form" onclick="applyOptions(event)"
                        class=" modal-action modal-close waves-effect waves-green btn-flat">
                    Valider
                </button>
            </div>
        </form>
    </div>
    <button class="btn waves-effect waves-light" onclick="cleanSession();">Clean</button>
</div>
<?php require('footer.php'); ?>
<script src="js/formCreator.js"></script>