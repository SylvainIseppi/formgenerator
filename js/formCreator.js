// Valeurs par défaut pour les requête ajax
$.ajaxSetup({
    url: 'template/ajax.php',
    datatype: 'text',
    method: 'POST',
    error: function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR + '<br>' + textStatus + '<br>' + errorThrown);
    }
});

// ID du dernier élément cliqué
var lastClicked = -1;

/**
 * Empêche le navigateur d'exécuter l'action par défaut quand un drop est effectué.
 * @param ev
 */
function allowDrop(ev) {
    ev.preventDefault();
}

/**
 * Récupère l'ID de l'objet attrapé.
 * @param ev
 */
function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

/**
 * Crée un nouveau champ lorsqu'un item du panneau de gauche est déposé.
 * @param ev
 */
function dropCreate(ev) {
    ev.preventDefault();
    var type = ev.dataTransfer.getData("text");

    // Envoi par AJAX du type de champ et l'identifiant de la zone de drop
    $.ajax({
        data: {
            type: type,
            action: 'add'
        },
        success: function (data) {
            $(ev.target).append(data);
        }
    });
}

/**
 * Supprime un champ lorsqu'il est déposé sur la corbeille.
 * @param ev
 */
function dropDelete(ev) {
    ev.preventDefault();
    var id = ev.dataTransfer.getData("text");

    $.ajax({
        data: {
            action: 'delete',
            from: id
        },
        success: function (data) {
            $('#' + id).remove();
        }
    });
}

/**
 * Montre les options correspondantes au champ sélectionné.
 * @param element
 */
function showOptions(element) {
    var id = $(element).attr("id");

    // Envoi par AJAX du type de champ et l'identifiant de la zone de drop
    $.ajax({
        data: {
            action: 'options',
            from: id
        },
        success: function (data) {
            $('#options-modal').html(data);
            $('#modal1').openModal();
            lastClicked = id;
        }
    });
}

/**
 * Enregistre les options dans l'objet field correspondant, et met à jour la vue.
 * @param ev
 */
function applyOptions(ev) {
    // Envoie le formulaire par ajax et indique qu'il s'agit d'une mise à jour
    ev.preventDefault();
    $.ajax({
        data: $('#options-form').serialize() + '&action=update&from=' + lastClicked,
        success: function(data) {
            $('#' + lastClicked).replaceWith(data);
        }
    })
}

/**
 * This function exists only for debugging purposes.
 * Clean the SESSION PHP variable.
 */
function cleanSession() {
    $.post('template/ajax.php', {action: 'deleteAll'});
    $('#dropzone').html("");
}
