<?php
  if (isset($_SESSION['userId'])) {

    $rows = array();
    $userId = $_SESSION['userId'];

    require 'includes/dbh.inc.php';
    //Prepared statements
    $sql = "SELECT * FROM notes WHERE userId=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {
      //Pass in the parameters from users to the prepared statement
      mysqli_stmt_bind_param($stmt, "i", $userId);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if(!$result){
        exit("Error retrieving notes for user.");
      }
      else {
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
      }
    }
  }
  else {
    exit("Invalid session");
  }
 ?>

<div class="container-fluid padding">
  <div class="row padding">

    <!-- To DO COLUMN-->
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="d-flex justify-content-between" style="width: 18rem; padding: 5px;">
           <h3>To-Do</h3>
           <form id="add-note" action="addnote.php" method="post">
             <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addNote">
               <i class="fa fa-plus padding" aria-hidden="true"></i></button>
           </form>
      </div>
      <hr align="left" style="width: 18rem;">

      <?php
          foreach($rows as $note) {
            if ($note['state'] == 1)
            {
              $noteTitle = $note['title'];
              $noteDetails = $note['details'];
              $userId = $_SESSION['userId'];
              $noteId = $note['id'];

              $noteCard = <<< here
              <div class="card" style="margin-bottom: 5px;width: 18rem; background-color:#FCE499;">
                <div class="card-body">
                  <h6 class="card-subtitle mb-2 text-muted">$noteTitle</h6>
                  <p class="card-text">$noteDetails</p>
                  <a data-toggle="modal" href="#editNote" class="card-link"
                    data-note-id="$noteId"
                    data-note-title="$noteTitle"
                    data-note-details="$noteDetails"
                    data-note-state="0">Edit</a>
                  <a data-toggle="modal" href="#deleteNote" class="card-link"
                    data-note-id="$noteId">Delete</a>
                </div>
              </div>
here;
              echo $noteCard;
            }
          }
       ?>
    </div>

    <!-- Doing COLUMN-->
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="d-flex justify-content-between" style="width: 18rem; padding: 5px;">
           <h3>Doing</h3>
      </div>
      <hr align="left" style="width: 18rem;">
      <?php
          foreach($rows as $note) {
            if ($note['state'] == 2)
            {
              $noteTitle = $note['title'];
              $noteDetails = $note['details'];
              $noteId = $note['id'];

              $noteCard = <<< here
              <div class="card" style="margin-bottom: 5px;width: 18rem; background-color:#9BEAE8;">
                <div class="card-body">
                  <h6 class="card-subtitle mb-2 text-muted">$noteTitle</h6>
                  <p class="card-text">$noteDetails</p>
                  <a data-toggle="modal" href="#editNote" class="card-link"
                    data-note-id="$noteId"
                    data-note-title="$noteTitle"
                    data-note-details="$noteDetails"
                    data-note-state="1">Edit</a>
                    <a data-toggle="modal" href="#deleteNote" class="card-link"
                      data-note-id="$noteId">Delete</a>
                </div>
              </div>
here;
              echo $noteCard;
            }
          }
       ?>
    </div>

    <!-- Dne COLUMN-->
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="d-flex justify-content-between" style="width: 18rem; padding: 5px;">
           <h3>Done</h3>
      </div>
            <hr align="left" style="width: 18rem;">
      <?php
          foreach($rows as $note) {
            if ($note['state'] == 3)
            {
              $noteTitle = $note['title'];
              $noteDetails = $note['details'];
              $noteId = $note['id'];

              $noteCard = <<< here
              <div class="card" style="margin-bottom: 5px;width: 18rem; background-color:#F7F3E5;">
                <div class="card-body">
                  <h6 class="card-subtitle mb-2 text-muted">$noteTitle</h6>
                  <p class="card-text">$noteDetails</p>
                  <a data-toggle="modal" href="#editNote" class="card-link"
                    data-note-id="$noteId"
                    data-note-title="$noteTitle"
                    data-note-details="$noteDetails"
                    data-note-state="2">Edit</a>
                    <a data-toggle="modal" href="#deleteNote" class="card-link"
                      data-note-id="$noteId">Delete</a>
                </div>
              </div>
here;
              echo $noteCard;
            }
          }
       ?>
    </div>

  </div>

</div>

<!-- Modal Add Note -->
<div class="modal fade" id="addNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="includes/addnote.inc.php" method="post">
        <div class="modal-body">
          <input id="userId" name="userId" type="hidden" value="<?php echo $_SESSION['userId'];?>">

          <div class="form-group">
            <label class="text-info">Note Title</label>
            <input id="note-title" type="text" class="form-control" name="title" placeholder="Enter title">
          </div>

          <div class="form-group">
            <label class="text-info">Note Details</label>
            <textarea id="note-details" class="form-control" rows="8" id="details" name="details" placeholder="Enter details"></textarea>
          </div>

          <div class="form-group">
            <label class="text-info">State</label>

            <!-- State -->
            <div class="form-group d-flex justify-content-between" style="padding-right:50%;">
              <div class="form-check form-check-inline">
                <input class="form-check-input text-info" type="radio" name="state" id="todo" value="todo" checked>
                <label class="form-check-label" for="todo">To Do</label></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input text-info" type="radio" name="state" id="doing" value="doing">
                <label class="form-check-label" for="doing">Doing</label></label>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="add-note">Add Note</button>
        </div>
    </div>
    </form>
  </div>
</div>
</div>



<!-- Modal Edit Note -->
<div class="modal fade" id="editNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="includes/editnote.inc.php" method="post">
        <div class="modal-body">
          <input id="userId" name="userId" type="hidden" value="<?php echo $_SESSION['userId'];?>">
          <input id="noteId" name="noteId" type="hidden">

          <div class="form-group">
            <label class="text-info">Note Title</label>
            <input id="note-title" type="text" class="form-control" name="title" placeholder="Enter title">
          </div>

          <div class="form-group">
            <label class="text-info">Note Details</label>
            <textarea id="note-details" class="form-control" rows="8" name="details" placeholder="Enter details"></textarea>
          </div>

          <div class="form-group">
            <label class="text-info">State</label>

            <!-- State -->
            <div class="form-group d-flex justify-content-between" style="padding-right:50%;">
              <div class="form-check form-check-inline">
                <input class="form-check-input text-info" type="radio" name="state" id="todo" value="todo">
                <label class="form-check-label" for="todo">To Do</label></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input text-info" type="radio" name="state" id="doing" value="doing">
                <label class="form-check-label" for="doing">Doing</label></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input text-info" type="radio" name="state" id="done" value="done">
                <label class="form-check-label" for="doing">Done</label></label>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="save-note">Save Note</button>
        </div>
    </div>
    </form>
  </div>
</div>
</div>

<!-- Modal Delete Note -->
<div class="modal fade" id="deleteNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="includes/editnote.inc.php" method="post">
        <div class="modal-body">
          <input id="userId" name="userId" type="hidden" value="<?php echo $_SESSION['userId'];?>">
          <input id="noteId" name="noteId" type="hidden">

          <div class="form-group">
            <label class="text-danger">Are you sure you want to delete this note?</label>
          </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger" name="delete-note">Delete</button>
        </div>
    </div>
    </form>
  </div>
</div>
</div>

<script>
//triggered when modal is about to be shown
$('#editNote').on('show.bs.modal', function(e) {


  var noteId = $(e.relatedTarget).data('note-id');
  $(e.currentTarget).find('input[name="noteId"]').val(noteId);

  var noteTitle = $(e.relatedTarget).data('note-title');
  $(e.currentTarget).find('input[name="title"]').val(noteTitle);

  var noteDetails = $(e.relatedTarget).data('note-details');
  $(e.currentTarget).find('textarea[name="details"]').val(noteDetails);

  var noteState = $(e.relatedTarget).data('note-state');
  $(e.currentTarget).find('input[name="state"]')[noteState].checked = true;

});

//triggered when modal is about to be shown
$('#deleteNote').on('show.bs.modal', function(e) {


  var noteId = $(e.relatedTarget).data('note-id');
  $(e.currentTarget).find('input[name="noteId"]').val(noteId);


});
</script>
