<?php
/**
 * Created by PhpStorm.
 * User: Thib
 * Date: 13/05/2015
 * Time: 19:06
 */

    /*function getPageTitle() {
        switch(basename($_SERVER['PHP_SELF'])) {
            case 'index.php':
                return 'Daksyl | Accueil';
            case 'createform':
                return 'Daksyl | Formulaire';
            default:
                return 'Daksyl | Untitled';
        }
    }*/
    function getPageTitle(){
        if(isset($_GET['page'])){
            switch($_GET['page']){
                case 'form':
                return 'Daksyl | Formulaire';
                case 'index':
                return 'Daksyl | index';
                case 'sqlgen':
                return 'Daksyl | sqlgen';
                case 'generate':
                return 'Daksyl | generate form';
                default:
                return 'Daksyl | Untitled';

            }
        }
        else{
            return 'Daksyl | index';
        }

    }

    ?>
    <!DOCTYPE html>
    <html>
    <head lang="fr">
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="css/materialize.css" media="screen, projection"/>
        <link rel="stylesheet" href="css/style.css" />
        <title><?php echo getPageTitle(); ?></title>
    </head>
    <body>
        <!-- Begin of page -->
        <div id="page">
            <header>
                <nav class="nav-wrapper blue-grey" role="navigation">
                    <a href="index" class="center brand-logo">DAKSYL</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="createform">Form Creator</a></li>
                        <li><a href="selectSQLRequest">SQL Request</a></li>
                        <li><a href="MysqlConnexion">MysqlConnexion</a></li>
                    </ul>
                </nav>
            </header>
            <!-- Begin of content -->
            <main>
