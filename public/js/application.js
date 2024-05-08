$(document).ready(function() {
    $('#preloader').delay(150).fadeOut();

    // $(window).on('resize', function(){
    //     if(chartPie != null && chartPie != undefined){
    //         chartPie.resize();
    //     }

    //     if(chartBar != null && chartBar != undefined){
    //         chartBar.resize();
    //     }
    // });

});

function initializeDualListBox(selector, nonSelectedListLabel, selectedListLabel){
    return $(selector).bootstrapDualListbox({
        nonSelectedListLabel: nonSelectedListLabel,
        selectedListLabel: selectedListLabel,
        preserveSelectionOnMove: 'movido',
        moveAllLabel: 'Mover Tudo',
        removeAllLabel: 'Remover Tudo',
        infoText: 'Exibir tudo {0}',
        infoTextEmpty: "Lista vazia",
        filterTextClear: '<span class="text-primary">Mostrar Tudo</span>',
        filterPlaceHolder: 'Filtrar',
        infoTextFiltered: '<span class="label label-warning">Filtrando</span> {0} de {1}',
    });
}



