@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>SNBRZ - Movies</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="sb-admin-2.min.css" rel="stylesheet">
<link href="style_two.css" rel="stylesheet">
</head>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
.modal .modal-dialog {
max-width: 900px !important;
}

</style>
<script>
$(document).ready(function(){
// Activate tooltip
$('[data-toggle="tooltip"]').tooltip();

// Select/Deselect checkboxes
var checkbox = $('table tbody input[type="checkbox"]');
$("#selectAll").click(function(){
	if(this.checked){
		checkbox.each(function(){
			this.checked = true;
		});
	} else{
		checkbox.each(function(){
			this.checked = false;
		});
	}
});
checkbox.click(function(){
	if(!this.checked){
		$("#selectAll").prop("checked", false);
	}
});
});
</script>
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
	href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
	rel="stylesheet">

<!-- Custom styles for this template-->
<link href="sb-admin-2.min.css" rel="stylesheet">
<link href="style_two.css" rel="stylesheet">
</head>
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

	<!-- Sidebar -->
	<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

		<!-- Sidebar - Brand -->
	

		<!-- Divider -->
		<hr class="sidebar-divider my-0">

	
		<!-- Divider -->
		<hr class="sidebar-divider">

		<!-- Heading -->
		<div class="sidebar-heading">
			Interface
		</div>


		<!-- Nav Item - Pages Collapse Menu -->
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
				aria-expanded="true" aria-controls="collapsePages">
				<i class="fas fa-fw fa-folder"></i>
				<span>Pages</span>
			</a>
			<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<h6 class="collapse-header">Other Pages:</h6>
                    <a class="collapse-item" href="{{ url('movies') }}">Movies</a>
					<a class="collapse-item" href="{{ url('news') }}">News</a>
					<a class="collapse-item" href="{{ url('recharge') }}">Recharge</a>
                    <a class="collapse-item" href="{{ url('withdrawal') }}">Withdrawal</a>
					<a class="collapse-item" href="{{ url('services') }}">Services Number</a>
					<a class="collapse-item" href="{{ url('ads') }}">Add</a>
					<a class="collapse-item" href="{{ url('notification') }}">Notifications</a>
				</div>
			</div>
		</li>


		<!-- Divider -->
		<hr class="sidebar-divider d-none d-md-block">

	</ul>
	<!-- End of Sidebar -->

	<!-- Content Wrapper -->
	<div id="content-wrapper" class="d-flex flex-column">

		<!-- Main Content -->
		<div id="content">

			<!-- Topbar -->
			<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

				<!-- Sidebar Toggle (Topbar) -->
				<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
					<i class="fa fa-bars"></i>
				</button>

				<!-- Topbar Search -->
				<form
					class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
					<div class="input-group">
						<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
							aria-label="Search" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<button class="btn btn-primary" type="button">
								<i class="fas fa-search fa-sm"></i>
							</button>
						</div>
					</div>
				</form>

				<!-- Topbar Navbar -->


			</nav>
			<!-- End of Topbar -->

			  <!-- Begin Page Content -->
			<div class="container-fluid">

				<!-- Page Heading -->

					<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

				</div>
 
				<!-- Content Row -->
				<div class="row ml-2 mr-2 ">

					<!-- Earnings (Monthly) Card Example -->
					<div class="col-xl-3 col-md-6 mb-4">
						<div class="card border-left-primary shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
											Earnings (Monthly)</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
									</div>
									<div class="col-auto">
										<i class="fas fa-calendar fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Earnings (Monthly) Card Example -->
					<div class="col-xl-3 col-md-6 mb-4">
						<div class="card border-left-success shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
											Earnings (Annual)</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
									</div>
									<div class="col-auto">
										<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Earnings (Monthly) Card Example -->
					<div class="col-xl-3 col-md-6 mb-4">
						<div class="card border-left-info shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
										</div>
										<div class="row no-gutters align-items-center">
											<div class="col-auto">
												<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
											</div>
											<div class="col">
												<div class="progress progress-sm mr-2">
													<div class="progress-bar bg-info" role="progressbar"
														style="width: 50%" aria-valuenow="50" aria-valuemin="0"
														aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-auto">
										<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Pending Requests Card Example -->
					<div class="col-xl-3 col-md-6 mb-4">
						<div class="card border-left-warning shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
											Pending Requests</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
									</div>
									<div class="col-auto">
										<i class="fas fa-comments fa-2x text-gray-300"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Content Row -->


				<div class="card-table shadow mb-4">
              <div class="table-title">
			<div class="row">
				<div class="col-sm-6">
					<h2>Manage <b>Movies</b></h2>
				</div>
				<div class="col-sm-6">
					<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Movie</span></a>
					{{-- <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a> --}}
				</div>
			</div>
		</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                   <thead>
				<tr>
					<th>
						<span class="custom-checkbox">
							<input type="checkbox" id="selectAll">
							<label for="selectAll"></label>
						</span>
					</th>
					<th>Poster Image URLs</th>
					<th>Release Time</th>
					<th>Price</th>
					<th>Title</th>
					<th>Movie Introduction</th>
					<th>Sheets per Ticket</th>
					<th>Income</th>
					<th>Duration</th>
					<th>Actors Images URLs</th>
					<th>Movie Descriptions</th>
					<th>Instructions</th>
					<th>Catalogue</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
                @foreach ($movies as $movie)
				<tr>
					<td>
						<span class="custom-checkbox">
							<input type="checkbox" id="checkbox1" name="options[]" value="1">
							<label for="checkbox1"></label>
						</span>
					</td>
                        <td>{{ $movie->poster }}</td>
                        <td>{{ $movie->release_time }}</td>
                        <td>{{ $movie->price }}</td>
                        <td>{{ $movie->title }}</td>
                        <td>{{ $movie->introduction }}</td>
                        <td>{{ $movie->sheets_per_ticket }}</td>
                        <td>{{ $movie->income }}</td>
                        <td>{{ $movie->duration }}</td>
                        <td>{{ implode(', ', $movie->actor_image) }}</td>
                        <td>{{ $movie->description }}</td>
                        <td>{{ $movie->instructions }}</td>
                        <td>{{ $movie->catalogue }}</td>
						<td>
							<form action="{{ route('delete_movie_record', $movie->id) }}" method="POST" style="display: inline-block">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
							</form>
						</td>
                    </tr>
                    @endforeach

			</tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>


<!-- Add Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
<div class="modal-dialog">
	<div class="modal-content">
		<form method="POST" action="{{ url('create_movie_record') }}"  id="movie-form">
            @csrf
			<div class="modal-header">
				<h4 class="modal-title">Add Movie</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
               <div class="row">
                <div class="col-4">
				<div class="form-group">
					<label>Poster Image URL</label>
					<input type="text" id="poster-image" name="poster" required>
				</div>
				<div class="form-group field-padding">
					<label>Release Time</label> </br>
                    <input type="datetime-local" id="birthday" name="release_time" required>
				</div>
                 <div class="form-group field-padding">
					<label>Price</label> </br>
					<input type="number" id="price" name="price" required>
				 </div>
               </div>
               <div class="col-4">
			      <div class="form-group">
					<label>Title</label>
					<input type="text" name="title" class="form-control" required>
				  </div>
				  <div class="form-group">
					<label>Movie Introduction</label>
					<input name="introduction" class="form-control" required>
				  </div>
				  <div class="form-group mt-4">
					<label>Sheets Per Ticket</label>
					<input type="number" id="sheetticket" name="sheets_per_ticket" required>
				 </div>
				 <div class="form-group field-padding">
					<label>Income</label> </br>
					<input type="text" id="income" name="income" required>
				 </div>
               </div>
			   <div class="col-4">
			     <div class="form-group">
					<label>Duration</label>
					<input type="number" name="duration" class="form-control" required>
				 </div>
				 <div class="custom-file field-padding">
				  <label>Choose Images</label>
                   <input type="file" class="custom-file-input" id="customFile" name="actor_image[]" multiple>
                   <label  class="custom-file-label" placeholder="Choose Images" for="customFile" style="color:000;">Choose images</label>
                   </div>
				  <div class="form-group field-padding">
					<label>Movie Descriptions</label>
					<input class="form-control" name="description" required>
				</div>
				 <div class="form-group">
					<label>Instructions</label>
					<input name="instructions" class="form-control" required>
				</div>
                  <div class="form-group">
					<label>Catalogue</label>
					<input type="number" id="catalouge" name="catalogue" required>
				 </div>
               </div>
			</div>

			<div class="modal-footer">
				<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
				<input type="submit" class="btn btn-success" value="Add">
			</div>
		</form>
	</div>
</div>
</div>
<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
<div class="modal-dialog">
	<div class="modal-content">
		<form>
			<div class="modal-header">
				<h4 class="modal-title">Edit Movie</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
               <div class="row">
                <div class="col-4">
				<div class="form-group">
					<label>Poster Image</label>
					<input type="file" id="poster-image name="posterimage" required>
				</div>
				<div class="form-group field-padding">
					<label>Release Time</label> </br>
					<input type="date" id="birthday" name="birthday" required>
				</div>
                 <div class="form-group field-padding">
					<label>Price</label> </br>
					<input type="text" id="movieprice" name="pricemovie" required>
				 </div>
               </div>
               <div class="col-4">
			      <div class="form-group">
					<label>Title</label>
					<input type="text" class="form-control" required>
				  </div>
				  <div class="form-group">
					<label>Movie Introduction</label>
					<input name="introduction" class="form-control" required></input>
				  </div>
				  <div class="form-group mt-4">
					<label>Sheets Per Ticket</label>
					<input type="number" id="sheetticket" name="ticketsheet" required>
				 </div>
				 <div class="form-group field-padding">
					<label>Income</label> </br>
					<input type="text" id="income" name="totalincome" required>
				 </div>
               </div>
			   <div class="col-4">
			     <div class="form-group">
					<label>Duration</label>
					<input type="text" class="form-control" required>
				 </div>
				 <div class="custom-file field-padding">
                   <input type="file" class="custom-file-input" id="customFile" name="images[]" multiple>
                   <label  class="custom-file-label" placeholder="Choose Images" for="customFile" style="color:000;">Choose images</label>
                   </div>
				  <div class="form-group field-padding">
					<label>Movie Descriptions</label>
					<input class="form-control" name="moviedescription" required>
				</div>
				 <div class="form-group">
					<label>Instructions</label>
					<input class="form-control" required>
				</div>
                  <div class="form-group">
					<label>Catalogue</label>
					<input type="number" id="catalouge" name="moviecatalogue" required>
				 </div>
               </div>
			</div>

			<div class="modal-footer">
				<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
				<input type="submit" class="btn btn-success" value="Add">
			</div>
		</form>
	</div>
</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
<div class="modal-dialog">
	<div class="modal-content">
		<form>
			<div class="modal-header">
				<h4 class="modal-title">Delete Movie</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete these Records?</p>
				<p class="text-warning"><small>This action cannot be undone.</small></p>
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
				<input type="submit" class="btn btn-danger" value="Delete">
			</div>
		</form>
	</div>
</div>
</div>
</div>

</div>
 <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SNBRZ Application 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
</div>

<!-- Axios Call Function-->
<script>
const form = document.getElementById('movie-form');
form.addEventListener('submit', (event) => {
    event.preventDefault();

    const releaseTimeInput = document.getElementById('birthday');
    const releaseTimeValue = releaseTimeInput.value;
    const releaseTime = new Date(releaseTimeValue).toISOString().replace('T', ' ').replace(/\.\d{3}Z$/, '');

    releaseTimeInput.value = releaseTime;

    form.submit();
});

</script>


 <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

	<!-- Axios Call Library-->
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


</body>
</html>
@endsection
