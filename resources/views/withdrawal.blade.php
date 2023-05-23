@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>SNBRZ - Withdrawal</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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

							</div>
						</div>
					</div>

					<!-- Earnings (Monthly) Card Example -->
					<div class="col-xl-3 col-md-6 mb-4">
						<div class="card border-left-success shadow h-100 py-2">
							<div class="card-body">

							</div>
						</div>
					</div>

					<!-- Earnings (Monthly) Card Example -->
					<div class="col-xl-3 col-md-6 mb-4">
						<div class="card border-left-info shadow h-100 py-2">
							<div class="card-body">
								
							</div>
						</div>
					</div>

					<!-- Pending Requests Card Example -->
					<div class="col-xl-3 col-md-6 mb-4">
						<div class="card border-left-warning shadow h-100 py-2">
							<div class="card-body">
								
						</div>
					</div>
				</div>
				<!-- Content Row -->


						 <div class="card-table shadow mb-4">
              <div class="table-title">
			<div class="row">
				<div class="col-sm-6">
					<h2>Manage <b>Withdrawal</b></h2>
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
					<th>User Email/ID</th>
					<th>Wallted Address</th>
					<th>DataTime</th>
					<th>Amount</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
                {{-- {{ $recharges }} --}}
			@foreach ($withdrawal as $withdrawal)
				<tr>
					<td>
						<span class="custom-checkbox">
							<input type="checkbox" id="checkbox2" name="options[]" value="1">
							<label for="checkbox2"></label>
						</span>
					</td>
                    <td>{{ $withdrawal->user->email }}</td>
                    <td>{{ $withdrawal->user->wallet_address }}</td>
				    <td>{{ $withdrawal->created_at }}</td>
					<td>{{ $withdrawal->withdrawal_amout }}</td>
				    <td>{{ $withdrawal->status }}</td>

					<td>
					<form id="update-status-form" action="{{ url('admin/withdrawal/approve', $withdrawal->id) }}" method="POST">
							@csrf
							<select id="status" class="form-control" name="status">
								<option value="">-- Select Status --</option>
								<option dislabled value="" {{ $withdrawal->status == 'pending' ? 'selected' : '' }}>Pending</option>
								<option value="approved" {{ $withdrawal->status == 'approved' ? 'selected' : '' }}>Approved</option>
								<!-- <option value="declined" {{ $withdrawal->status == 'declined' ? 'selected' : '' }}>Declined</option> -->
							</select>
								<button type="submit" class="btn btn-primary" onclick="event.preventDefault();
								if (confirm('Are you sure you want to update the status?')) {
									var form = document.getElementById('update-status-form');
									if (document.getElementById('status').value === 'approved') {
										form.action = '{{ route('admin.withdrawal.approve', ['id' => $withdrawal->id]) }}';
									} 
									// else if (document.getElementById('status').value === 'declined') {
									// 	form.action = '{{ route('admin.withdrawal.decline', ['id' => $withdrawal->id]) }}';
									// }
									form.submit();
								}">Update Status</button>
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
<div id="addNewsModal" class="modal fade">
<div class="modal-dialog">
	<div class="modal-content">
		<form method="POST" action="{{ url('create_add_record') }}"  id="withdrawal-form">
		@csrf
			<div class="modal-header">
				<h4 class="modal-title">Add withdrawal</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
               <div class="row">
                <div class="col-12">
				<div class="form-group">
					<label>ID </label> </br>
					<input type="text" id="user-id" name="userid" required>
				</div>
                <div class="form-group mt-4">
					<label>Total Amount</label>
					<input type="number" id="withdrawal/withdrawal-amount" name="withdrawal/withdrawalamount" required>
				</div>
                <div class="dropdown">
					<select class="form-control form-label-dropdown" id="withdrawal/withdrawal-status-field" v-model="withdrawal/withdrawal-status-type">
                           <option value="">Accepted</option>
                           <option value="legal">Rejected</option>
                        </select>
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
				<h4 class="modal-title">Add withdrawal</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
               <div class="row">
                <div class="col-12">
				<div class="form-group">
					<label>ID </label> </br>
					<input type="text" id="user-id" name="userid" required>
				</div>
                <div class="form-group mt-4">
					<label>Total Amount</label>
					<input type="number" id="withdrawal/withdrawal-amount" name="withdrawal/withdrawalamount" required>
				</div>
                <div class="dropdown">
					<select class="form-control form-label-dropdown" id="withdrawal/withdrawal-status-field" v-model="withdrawal/withdrawal-status-type">
                           <option value="">Accepted</option>
                           <option value="legal">Rejected</option>
                        </select>
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
<!-- Delete Modal HTML -->
<div id="deleteNewsModal" class="modal fade">
<div class="modal-dialog">
	<div class="modal-content">
		<form>
			<div class="modal-header">
				<h4 class="modal-title">Delete News</h4>
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
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
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
