@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>SNBRZ - Service Contact</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
color: #566787;
background: #f5f5f5;
font-family: 'Varela Round', sans-serif;
font-size: 13px;
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
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

	<!-- Sidebar -->
	<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

		<!-- Sidebar - Brand -->
		<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
			<div class="sidebar-brand-icon rotate-n-15">
				<i class="fas fa-laugh-wink"></i>
			</div>
			 <div class="sidebar-brand-text mx-3">BNSRZ</div>
		</a>

		<!-- Divider -->
		<hr class="sidebar-divider my-0">

		<!-- Nav Item - Dashboard -->
		<li class="nav-item active">
			<a class="nav-link" href="index.html">
				<i class="fas fa-fw fa-tachometer-alt"></i>
				<span>Dashboard</span></a>
		</li>

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
					<h2>Manage <b>Services Number</b></h2>
				</div>
				<div class="col-sm-6">
					<a href="#addNewsModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Services Number</span></a>
					{{-- <a href="#deleteNewsModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a> --}}
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
					<th>Title</th>
					<th>Contact Number</th>
				</tr>
			</thead>
			<tbody>
              @foreach ($services as $services)
				<tr>
					<td>
						<span class="custom-checkbox">
							<input type="checkbox" id="checkbox1" name="options[]" value="1">
							<label for="checkbox1"></label>
						</span>
					</td>
                        <td>{{ $services->title }}</td>
                        <td>{{ $services->contact }}</td>
				</tr>
				@endforeach
			</tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

<!-- Add Modal HTML -->
<div id="addNewsModal" class="modal fade">
<div class="modal-dialog">
	<div class="modal-content">
		<form method="POST" action="{{ url('/admin/service/create') }}"  id="services-form">
		@csrf
			<div class="modal-header">
				<h4 class="modal-title">Add Service Number </h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
               <div class="row">
                <div class="col-12">
				<div class="form-group">
					<label>Service Number Title</label> </br>
					<input type="text" id="service-title" name="title" required
				</div>
                <div class="form-group">
					<label>Service Contact Number </label> </br>
					<input type="number" id="service-contact-number" name="contact" required
				</div>

               </div>
			</div>

			<div class="modal-footer mt-4">
				<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
				<input type="submit" class="btn btn-success" value="Add">
			</div>
		</form>
	</div>
</div>
</div>
<!-- Edit Modal HTML -->
<div id="editNewsModal" class="modal fade">
<div class="modal-dialog">
	<div class="modal-content">
		<form>
			<div class="modal-header">
				<h4 class="modal-title">Edit Service Number</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
               <div class="row">
                 <div class="col-12">
				<div class="form-group">
					<label>Service Number Title</label> </br>
					<input type="text" id="service-title" name="servicetitle" required
				</div>
                <div class="form-group">
					<label>Service Contact Number </label> </br>
					<input type="text" id="service-contact-number" name="servicecontactnumber" required
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
<div id="deleteNewsModal" class="modal fade">
<div class="modal-dialog">
	<div class="modal-content">
		<form>
			<div class="modal-header">
				<h4 class="modal-title">Delete Service Number</h4>
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
  function addServiceNumber() {
  const serviceTitle = document.getElementById('service-title').value;
  const serviceContactNumber = document.getElementById('service-contact-number').value;

  axios.post('/api/add-service', {
    title: serviceTitle,
    contactNumber: serviceContactNumber
  })
  .then(function (response) {
    console.log(response);
    // Handle success
  })
  .catch(function (error) {
    console.log(error);
    // Handle error
  });
}


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
