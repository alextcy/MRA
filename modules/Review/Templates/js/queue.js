$(document).ready(function() {
    
    
    $('#original_date').datepicker({
        format: 'yyyy-mm-dd',
        weekStart: 1,
        viewMode: 2
    });
    
    var movies  = [];
    var authors = [];
    var sources = [];
    
    /**
     * JSON вида [{id:10, name:'привет', name_native:'blah blah'}, ....]
     * list.push() формирует список который будем показывать "id|name / name_native"
     * формируем массив movies[id] = {id:10, name:'blah', name_native:'other blah'}
     * при отображении (highlighter) выпадающего списка убираем "id|"
     * при выборе эл-та (updater) достаем из строки id перед "|" и по нему можем обратится в массив movies
     */
    $('.typeahead-movie').typeahead({
        items: 10,
        minLength: 2,
        source: function (query, process) {
            return $.post('/review/queue/search', 
                {'type':'movie', 'keyword':query},
                function (response) {
                    
                    var list = [];
                    $.each(response.list, function (i, movieObj) {
                        // "10|Ранго / Rango"
                        list.push(movieObj.id + '|' + movieObj.name +' / '+ movieObj.name_native);
                        movies[movieObj.id] = movieObj;
                    });
                    
                    return process(list);
                 },
                 'json'
            );
        },
        //если поиск по двум колонкам а показываем только одну
        matcher: function (item) {
            return true;
        },
        sorter: function (items) {
            return items.sort();
        },
        highlighter: function(item) {
            var parts = item.split('|');
            parts.shift();
            //убрали id| из названия фильма
            return parts.join('|');
        },
        updater: function(item) {
            var parts = item.split('|');
            var movieId = parts.shift();
            
            //movies[movieId] - full object data (id, name, name_native) if need it
            $('input[name=movie_id]').val(movieId);
            
            return parts.join('|');
        }

    });
    
        
    $('.typeahead-author').typeahead({
        items: 10,
        minLength: 2,
        source: function (query, process) {
            return $.post('/review/queue/search', 
                {'type':'author', 'keyword':query},
                function (response) {
                    
                    var list = [];
                    $.each(response.list, function (i, authorObj) {
                        // "10|Ранго / Rango"
                        list.push(authorObj.id + '|' + authorObj.name);
                        authors[authorObj.id] = authorObj;
                    });
                    
                    return process(list);
                 },
                 'json'
            );
        },
        sorter: function (items) {
            return items.sort();
        },
        highlighter: function(item) {
            var parts = item.split('|');
            parts.shift();
            //убрали id| из названия 
            return parts.join('|');
        },
        updater: function(item) {
            var parts = item.split('|');
            var authorId = parts.shift();
            
            //authors[authorId] - full object data (id, name, name_native) if need it
            $('input[name=author_id]').val(authorId);
            
            return parts.join('|');
        }
    });
    
    $('.typeahead-source').typeahead({
        items: 10,
        minLength: 2,
        source: function (query, process) {
            return $.post('/review/queue/search', 
                {'type':'source', 'keyword':query},
                function (response) {
                    
                    var list = [];
                    $.each(response.list, function (i, sourceObj) {
                        // "10|Ранго / Rango"
                        list.push(sourceObj.id + '|' + sourceObj.name);
                        sources[sourceObj.id] = sourceObj;
                    });
                    
                    return process(list);
                 },
                 'json'
            );
        },
        //если поиск по двум колонкам а показываем только одну
        matcher: function (item) {
            return true;
        },
        sorter: function (items) {
            return items.sort();
        },
        highlighter: function(item) {
            var parts = item.split('|');
            parts.shift();
            //убрали id| из названия 
            return parts.join('|');
        },
        updater: function(item) {
            var parts = item.split('|');
            var sourceId = parts.shift();
            
            //authors[authorId] - full object data (id, name, name_native) if need it
            $('input[name=source_id]').val(sourceId);
            
            return parts.join('|');
        }
    });
    
});


ReviewQueue.methodName = function()
{
    
};