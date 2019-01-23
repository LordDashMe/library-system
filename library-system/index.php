<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width">
        <title>Library System</title>
        <link rel="icon" type="image/x-icon" href="favicon.ico" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
        <link href="assets/vendor/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-3.3.7/css/bootstrap-theme.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css">
        <link rel="stylesheet" href="assets/vendor/datatables/datatables.min.css">
        <link rel="stylesheet" href="assets/vendor/datatables/DataTables-1.10.18/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="assets/vendor/datatables/FixedHeader-3.1.4/css/fixedHeader.dataTables.min.css">
        <link rel="stylesheet" href="assets/vendor/datatables/Responsive-2.2.2/css/responsive.dataTables.min.css">
        <script src="assets/vendor/jquery-3.3.1/jquery.min.js"></script>
        <link href="assets/css/main.css" rel="stylesheet">
        <script src="assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
        <script src="assets/vendor/datatables/datatables.min.js"></script>
        <script src="assets/vendor/datatables/FixedHeader-3.1.4/js/dataTables.fixedHeader.min.js"></script>
        <script src="assets/vendor/datatables/Responsive-2.2.2/js/dataTables.responsive.min.js"></script>
        <script src="assets/vendor/sweetalertjs/sweetalertjs.min.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="container">
                
                <div class="index-page-wrapper">
                    <h1></h1>
                    <a class="btn btn-default btn-sm action-add-book"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Book</a>
                    <br>
                    <br>
                    <div class="panel panel-default">
                        <div class="panel-heading"><b>Book List</b></div>
                        <div class="panel-body">
                            <table id="example" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Author</th>
                                        <th>Publish</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ACTION POPUP -->
                <div id="action-popup" class="panel panel-default mfp-hide action-popup">
                    <div class="panel-heading">
                        <h3 class="panel-title"></h3>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="">
                            <div class="form-group">
                                <p>Book Title: <span class="required-field">*</span></p>
                                <input 
                                    type="text" 
                                    id="book_title" 
                                    name="book_title"
                                    class="form-control" 
                                    placeholder="Book 101 Title"
                                    required
                                >
                            </div>
                            <div class="form-group">
                                <p>Book Description: <span class="required-field">*</span></p>
                                <textarea 
                                    type="text" 
                                    id="book_description" 
                                    name="book_description"
                                    class="form-control" 
                                    placeholder="This is a sample description of a Book."
                                    required
                                ></textarea>
                            </div>
                            <div class="form-group">
                                <p>Book Author: <span class="required-field">*</span></p>
                                <input 
                                    type="text" 
                                    id="book_author" 
                                    name="book_author"
                                    class="form-control" 
                                    placeholder="John Doe"
                                    required
                                >
                            </div>
                            <div class="form-group field-publish">
                                <input type="checkbox" class="form-check-input" id="book_publish" name="book_publish"> &nbsp;Publish
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <a href="#" name="action-submit" id="action-submit" tabindex="4" class="form-control btn btn-primary">Submit</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <script src="assets/vendor/bootstrap-3.3.7/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
