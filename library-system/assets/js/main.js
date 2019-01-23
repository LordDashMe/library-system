(function ($) {
    
    'use strict';

    $(document).ready(function() {
        actionsHandler();
        dataTableAjax(); 
    });

    function actionsHandler() {
        $('.action-add-book').on('click', function(){
            $.magnificPopup.open({
                items: {
                  src: $('#action-popup'),
                  type: 'inline'
                },
                callbacks: {
                    close: function(){
                        $('.add-action-submit').unbind('click');
                    }
                }
            });
            $('#action-popup .panel-title').html('Add Book');
            $('#action-popup input[name="book_title"]').val('');
            $('#action-popup textarea[name="book_description"]').val('');
            $('#action-popup input[name="book_author"]').val('');
            $('#action-popup .field-publish').hide();
            $('#action-popup #action-submit').removeClass('edit-action-submit');
            $('#action-popup #action-submit').addClass('add-action-submit');
            addBookAjax();
        });
    }

    function dataTableAjax() {
        $('#example').DataTable( {
            "ajax": "api/books.php",
            "processing": true,
            "serverSide": true,
            "iDisplayLength": 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "columns": [
                { "data": "book_id", "name": "id" },
                { "data": "book_title", "name": "title" },
                { "data": "book_description", "name": "description" },
                { "data": "book_author", "name": "author" },
                { "data": "book_publish", "name": "is_published", 
                    render : function (data, type, full, meta) {
                        var html = '<span class="label label-default">Not Published</span>';
                        if (full.book_publish === 'p') {
                            html = '<span class="label label-success">Published</span>';
                        }
                        return html;
                    }
                },
                { "data": "action", "orderable": false,
                    render : function(data, type, full, meta) {
                        var html = '<a class="btn btn-default btn-sm action-edit-inline-book" data-id="'+ full.book_id +'" data-book-title="'+ full.book_title +'" data-book-description="'+ full.book_description +'" data-book-author="'+ full.book_author +'" data-book-publish="'+ full.book_publish +'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp;';
                        html += '<a class="btn btn-default btn-sm action-delete-inline-book" data-id="'+ full.book_id +'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>'
                        return html;
                    } 
                }
            ],
            "drawCallback": function(settings) {
                editBookAjax();
                deleteBookAjax();
            }
        });
    }

    function addBookAjax() {
        $('.add-action-submit').on('click', function(){
            
            var bookData = {
                title: $('#action-popup input[name="book_title"]').val(),
                description: $('#action-popup textarea[name="book_description"]').val(),
                author: $('#action-popup input[name="book_author"]').val()
            };

            $.ajax({
                type: 'POST',
                url: 'api/add_book.php',
                data: bookData,
                success: function () {
                    $('#action-popup').magnificPopup('close');
                    swal("Success!", "Record successfully added.", "success");
                    $('#example').DataTable().ajax.reload();
                },
                error: function (result) {
                    swal("Ohh oh!", result.responseJSON, "error");
                }
            });
        });
    }

    function deleteBookAjax() {
        $('.action-delete-inline-book').on('click', function () {
            var bookData = {
                id: $(this).data('id')
            };

            swal({
                title: "Are you sure you want to delete this record?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then(function (willDelete) {
                if (willDelete) {
                    $.ajax({
                        type: 'POST',
                        url: 'api/delete_book.php',
                        data: bookData,
                        success: function (result) {
                            swal("Success!", result, "success")
                            $('#example').DataTable().ajax.reload();
                        },
                        error: function (result) {
                            swal("Ohh oh!", result.responseJSON, "error");
                        }
                    });
                }
            });
        }); 
    }

    function editBookAjax() {
        $('.action-edit-inline-book').on('click', function () {
            $.magnificPopup.open({
                items: {
                  src: $('#action-popup'),
                  type: 'inline'
                },
                callbacks: {
                    close: function(){
                        $('.edit-action-submit').unbind('click');
                    }
                }
            });
            $('#action-popup .panel-title').html('Edit Book');
            $('#action-popup input[name="book_title"]').val($(this).data('book-title'));
            $('#action-popup textarea[name="book_description"]').val($(this).data('book-description'));
            $('#action-popup input[name="book_author"]').val($(this).data('book-author'));
            $('#action-popup .field-publish').show();
            var isChecked = $(this).data('book-publish') == 'p' ? true : false; 
            $('#action-popup .field-publish input[name="book_publish"]').prop('checked', isChecked);
            $('#action-popup #action-submit').removeClass('add-action-submit');
            $('#action-popup #action-submit').addClass('edit-action-submit');

            var bookId = $(this).data('id');
        
            $('.edit-action-submit').on('click', function(){
                var bookData = {
                    id: bookId,
                    title: $('#action-popup input[name="book_title"]').val(),
                    description: $('#action-popup textarea[name="book_description"]').val(),
                    author: $('#action-popup input[name="book_author"]').val(),
                    is_published: ($('#action-popup input[name="book_publish"]').prop("checked") == true ? 'p' : 'np')
                };
                $.ajax({
                    type: 'POST',
                    url: 'api/edit_book.php',
                    data: bookData,
                    success: function () {
                        $('#action-popup').magnificPopup('close');
                        swal("Success!", "Record successfully edited.", "success");
                        $('#example').DataTable().ajax.reload();
                    },
                    error: function (result) {
                        swal("Ohh oh!", result.responseJSON, "error");
                    }
                });
            });
        });
    }

})(jQuery);
