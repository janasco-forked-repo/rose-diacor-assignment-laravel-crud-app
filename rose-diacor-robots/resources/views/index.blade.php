<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rose Diacor - CRUD App Laravel 10 & Ajax</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
  <link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />
  <style type="text/css">
      
               body {
              margin: 0;
              padding: 0;
            }
            .bg-video-wrap {
              position: relative;
              overflow: hidden;
              width: 100%;
              height: 100vh;
              background: url(https://designsupply-web.com/samplecontent/vender/codepen/20181014.png) no-repeat center center/cover;
            }
            video {
              min-width: 100%;
              min-height: 100vh;
              z-index: 1;
            }
            .overlay {
              width: 100%;
              height: 100vh;
              position: absolute;
              top: 0;
              left: 0;
              background-image: linear-gradient(45deg, rgba(0,0,0,.3) 50%, rgba(0,0,0,.7) 50%);
              background-size: 3px 3px;
              z-index: 2;
            }
            h1 {
              text-align: center;
              color: #fff;
              position: absolute;
              top: 0;
              bottom: 0;
              left: 0;
              right: 0;
              margin: auto;
              z-index: 3;
              max-width: 400px;
              width: 100%;
              height: 50px;
            }


  </style>
</head>
{{-- add new robot modal start --}}
<div class="modal fade" id="addRobotModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Robot</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_robot_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light"> 
          <div class="my-2">
            <label for="robot_name">Robot Name</label>
            <input type="text" name="robot_name" class="form-control" placeholder="Robot Name" required>
          </div>
          <div class="my-2">
            <label for="robot_desc">Robot Desc</label>
            <input type="text" name="robot_desc" class="form-control" placeholder="Robot Description" required>
          </div>
          <div class="my-2">
            <label for="robot_creator">Robot Creator</label>
            <input type="text" name="robot_creator" class="form-control" placeholder="Robot Creator" required>
          </div>
          <div class="my-2">
            <label for="robot_country">Robot Country</label>
            <input type="text" name="robot_country" class="form-control" placeholder="Robot Country" required>
          </div>
          <div class="my-2">
            <label for="robot_year">Robot Year</label>
            <input type="text" name="robot_year" class="form-control" placeholder="Robot Year" required>
          </div>
          <div class="my-2">
            <label for="robot_type">Robot Type</label>
            <input type="text" name="robot_type" class="form-control" placeholder="Robot Type" required>
          </div>
          <div class="my-2">
            <label for="robot_image">Select Robot Image</label>
            <input type="file" name="robot_image" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_robot_btn" class="btn btn-primary">Add Robot</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new robot modal end --}}

{{-- edit robot modal start --}}
<div class="modal fade" id="editRobotModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Robot</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_robot_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="update_robot_id" id="update_robot_id">
        <input type="hidden" name="update_robot_image" id="update_robot_image">
        <div class="modal-body p-4 bg-light">
          <div class="my-2">
            <label for="robot_name">Robot Name</label>
            <input type="text" name="robot_name" id="robot_name" class="form-control" placeholder="Robot Name" required>
          </div>
          <div class="my-2">
            <label for="robot_desc">Robot Description</label>
            <input type="text" name="robot_desc" id="robot_desc" class="form-control" placeholder="Robot Description" required>
          </div>
          <div class="my-2">
            <label for="robot_creator">Robot Creator</label>
            <input type="text" name="robot_creator" id="robot_creator" class="form-control" placeholder="Robot Creator" required>
          </div>
          <div class="my-2">
            <label for="robot_country">Robot Country</label>
            <input type="text" name="robot_country" id="robot_country" class="form-control" placeholder="Robot Country" required>
          </div>
          <div class="my-2">
            <label for="robot_year">Robot Year</label>
            <input type="text" name="robot_year" id="robot_year" class="form-control" placeholder="Robot Year" required>
          </div>
          <div class="my-2">
            <label for="robot_type">Robot Type</label>
            <input type="text" name="robot_type" id="robot_type" class="form-control" placeholder="Robot Type" required>
          </div>
          <div class="mt-2" id="robot_image">

          </div>
          <div class="my-2">
            <label for="robot_image">Select Robot Image</label>
            <input type="file" name="robot_image" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_robot_btn" class="btn btn-success">Update Robot</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit robot modal end --}}
 

<body class="bg-light">
    <div class="bg-video-wrap">
        <video src="/assets/video/play001.mp4" loop muted autoplay> </video>
        <div class="overlay">

              <br> 
              <div class="container">

                  <div class="text-center">
                    <h3 class="text-light">Robotics Show List</h3>
                    <h3 class="text-light">@ROSE DIACOR </h3>
                    <h3 class="text-light">CRUD App Laravel-10 & Ajax</h3>
                  </div> 
                    <div class="row my-5">
                      <div class="col-lg-12">
                        <div class="card shadow">
                          <div class="card-header bg-danger d-flex justify-content-between align-items-center" style="background-color: #00bcd4!important;">
                            <h3 class="text-light">Manage Robots</h3>
                            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addRobotModal"><i class="bi-plus-circle me-2"></i>Add New Robot</button>
                          </div>
                          <div class="card-body" id="show_all_robots">
                            <h1 class="text-center text-secondary my-5">Loading...</h1>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="text-center"> 
                        <h3 class="text-light">Subject: Interactive Programming and Technologies (IPT1)</h3>
                        <h3 class="text-light">@ROSE DIACOR </h3>
                    </div>

                  <br>
                  <br>
              </div>

 
       </div>
    </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(function() {

      // add new robot ajax request
      $("#add_robot_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_robot_btn").text('Adding...');
        $.ajax({
          url: '{{ route('create') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Added!',
                'Robot Added Successfully!',
                'success'
              )
              fetchAllRobots();
            }
            $("#add_robot_btn").text('Add Robot');
            $("#add_robot_form")[0].reset();
            $("#addRobotModal").modal('hide');
          }
        });
      });

      // edit robot ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#robot_name").val(response.robot_name);
            $("#robot_desc").val(response.robot_desc);
            $("#robot_creator").val(response.robot_creator);
            $("#robot_country").val(response.robot_country);
            $("#robot_year").val(response.robot_year);
            $("#robot_type").val(response.robot_type);
            $("#robot_image").html(
              `<img src="storage/images/${response.robot_image}" width="100" class="img-fluid img-thumbnail">`);
            $("#update_robot_id").val(response.id);
            $("#update_robot_image").val(response.robot_image);
          }
        });
      });

      // update robot ajax request
      $("#edit_robot_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_robot_btn").text('Updating...');
        $.ajax({
          url: '{{ route('update') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Updated!',
                'Robot Updated Successfully!',
                'success'
              )
              fetchAllRobots();
            }
            $("#edit_robot_btn").text('Update Robot');
            $("#edit_robot_form")[0].reset();
            $("#editRobotModal").modal('hide');
          }
        });
      });

      // delete robot ajax request
      $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('delete') }}',
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                Swal.fire(
                  'Deleted!',
                  'Your Robot has been deleted.',
                  'success'
                )
                fetchAllRobots();
              }
            });
          }
        })
      });

      // fetch all robots ajax request
      fetchAllRobots();

      function fetchAllRobots() {
        $.ajax({
          url: '{{ route('read') }}',
          method: 'get',
          success: function(response) {
            $("#show_all_robots").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
    });
  </script>
</body>

</html>