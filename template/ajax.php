<?php
require('../Field.class.php');
session_start();

// Récupère la liste des champs. Si elle n'existe pas, elle est créée.
if (!isset($_SESSION['fields'])) $fields = new FormSet();
else $fields = $_SESSION['fields'];

// Récupère toutes les variables envoyées par POST (Ajax)
$action = isset($_POST['action']) ? $_POST['action'] : 'none';
$fieldtype = isset($_POST['type']) ? $_POST['type'] : 'texte';
$from = isset($_POST['from']) ? $_POST['from'] : -1;
$to = isset($_POST['to']) ? $_POST['to'] : -1;

// Exécute une action en fonction de la commande envoyée par Ajax.
switch ($action) {
    /* NOUVEAU CHAMP */
    case 'add':
        $id = $fields->length();
        if ($id >= 0) {
            switch ($fieldtype) {
                case 'texte':
                    $f = new TextField();
                    break;
                case 'nombre':
                    $f = new NumberField();
                    break;
                case 'textarea':
                    $f = new Textarea();
                    break;
                case 'telephone':
                    $f = new Phone();
                    break;
                case 'email':
                    $f = new Email();
                    break;
                case 'url':
                    $f = new Url();
                    break;
                case 'checkbox':
                    $f = new Checkbox();
                    break;
                default:
                    return;
            }
            $fields->add($f);
            echo $f->preview($id);
        }
        break;
    /* DEPLACEMENT D'UN CHAMP */
    case 'move':
        $fields->move($from, $to);
        break;
    /* EFFACEMENT D'UN CHAMP */
    case 'delete':
        preg_match('#[0-9]+#', $from, $id);
        $fields->remove(intval($id[0]));
        break;
    /* MODIFICATION DES CARACTERISTIQUES D'UN CHAMP */
    case 'update':
        $label = isset($_POST['label']) ? $_POST['label'] : "Yarien";
        $name = isset($_POST['name']) ? $_POST['name'] : "Kedal";
        $required = isset($_POST['required']);
        $maxlength = isset($_POST['maxlength']) ? $_POST['maxlength'] : 0;
        $minvalue = isset($_POST['minvalue']) ? $_POST['minvalue'] : 0;
        $maxvalue = isset($_POST['maxvalue']) ? $_POST['maxvalue'] : 100;
        $checked = isset($_POST['checked']) ? $_POST['checked'] :false;

        preg_match('#[0-9]+#', $from, $id);
        $f = $fields->get($id[0]);
        $f->setLabel($label);
        $f->setName($name);
        $f->setRequired($required);
        switch($f->getType()) {
            case 'Texte':
            case 'Textarea':
                $f->setMaxLength($maxlength);
                break;
            case 'Nombre':
                $f->setMinValue($minvalue);
                $f->setMaxValue($maxvalue);
                break;
            case 'Checkbox':
                $f->setChecked($checked);
                break;
        }
        echo $f->preview($id[0]);
        break;
    /* DEBUG : efface la variable session */
    case 'deleteAll':
        $fields->removeAll();
        break;
    /* AFFICHAGE DES OPTIONS DU CHAMP */
    case 'options':
        preg_match('#[0-9]+#', $from, $id);
        FieldOptions::printOptions($fields->get(intval($id[0])));
        break;
}

$_SESSION['fields'] = $fields;