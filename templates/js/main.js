var Main = {};
//var Domain = {};
//var Generator = {};
var ReviewQueue = {};

/**
 * Отмечает группу чекбоксов или снимает метки.
 * @param {type} checkboxItem - управляющий элемент на основании которго определяем отмечать или снять отметку
 * @param {string} elementsGroupName - имена чекбоксов которые нужно отметить
 * @returns {undefined}
 */
Main.checkAll = function(checkboxItem, elementsGroupName)
{
    $("input:checkbox[name='"+elementsGroupName+"']").prop('checked', checkboxItem.checked ); 
};

$(document).ready(function() {
    $('.mypopover').popover({
        placement: 'top'   
    });
    //$('.mytooltip').tooltip();
});