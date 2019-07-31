<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script language="javascript" type="text/javascript" src="script.js"></script>
    <title>SQLBrowser</title>
</head>

<body style="margin:20px; padding:20px">
<!-- Search form -->
<div class="md-form mt-0">
  <input class="form-control searchfield" type="text" placeholder="Search" aria-label="Search" id="search">
</div>
<div id="sqlTable">
    <?php
        include 'sqlController.php';
        main();
    ?>
</div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Add user
    </button>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="firstname" class="col-form-label">First name:</label>
                        <input type="text" class="form-control firstname" id="firstname">
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-form-label">Last name:</label>
                        <input type="text" class="form-control lastname" id="lastname">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">E-Mail:</label>
                        <input type="email" class="form-control email" id="email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary addButton" type="submit" value="insert">Add new user</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://use.fontawesome.com/2aa887d029.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="script.js">
</body>

</html>
