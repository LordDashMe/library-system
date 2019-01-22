(function ($) {

    $('.action-add-book').on('click', function(){
        $.magnificPopup.open({
            items: {
              src: $('#action-popup'),
              type: 'inline'
            }
        });
        $('#action-popup .panel-title').html('Add Book');
        $('#action-popup input[name="book_title"]').val('');
        $('#action-popup textarea[name="book_description"]').html('');
        $('#action-popup input[name="book_author"]').val('');
        $('#action-popup .field-publish').hide();
    });

    $(document).ready(function() {
        $('#example').DataTable( {
            "ajax": "objects.json",
            "processing": true,
            "serverSide": true,
            "iDisplayLength": 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "columns": [
                { "data": "book_title" },
                { "data": "book_description" },
                { "data": "book_author" },
                { "data": "book_publish", "visible": false },
                { "data": "action", 
                    render : function( data, type, full, meta ) {
                        var html = '<a class="btn btn-default btn-sm action-edit-inline-book" data-id="'+ full.id +'" data-book-title="'+ full.book_title +'" data-book-description="'+ full.book_description +'" data-book-author="'+ full.book_author +'" data-book-publish="'+ full.book_publish +'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp;';
                        html += '<a class="btn btn-default btn-sm action-delete-inline-book" data-id="'+ full.id +'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>'
                        return html;
                    } 
                }
            ],
            "initComplete": function(settings, json) {
                $('.action-edit-inline-book').on('click', function () {
                    $.magnificPopup.open({
                        items: {
                          src: $('#action-popup'),
                          type: 'inline'
                        }
                    });
                    $('#action-popup .panel-title').html('Edit Book');
                    $('#action-popup input[name="book_title"]').val($(this).data('book-title'));
                    $('#action-popup textarea[name="book_description"]').html($(this).data('book-description'));
                    $('#action-popup input[name="book_author"]').val($(this).data('book-author'));
                    $('#action-popup .field-publish').show();
                    var isChecked = $(this).data('book-publish') == 1 ? true : false; 
                    $('#action-popup .field-publish input[name="book_publish"]').attr('checked', isChecked);
                });

                $('.action-delete-inline-book').on('click', function () {
                    if (confirm('Are you sure you want to delete this record?')) {
                        alert();
                    }
                });
            }
        });
    });

})(jQuery);
