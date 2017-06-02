/**
 * Created by matias on 02/06/2017.
 */
$('#unidadesEjecutoras').select2({
    placeholder: 'Seleccione las unidades ejecutoras',
    ajax: {
        url: "/",
        dataType: 'json',
        quietMillis: 100,
        data: function (params) {
            return {
                q: params.term,
                page: params.page
            };
        },
        processResults: function (data, params) {

            params.page = params.page || 1;

            return {
                results: data.items,
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
            };
        },
        cache: true
    },
    templateResult: function (item) { return item.nombre; },
    templateSelection: function (item) { return item.id; },
    matcher: function(term, text) { return text.nombre.toUpperCase().indexOf(term.toUpperCase()) != -1; },

});