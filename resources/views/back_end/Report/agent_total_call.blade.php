@extends('back_end_layout.admin_layout')
@section('content') 

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Full Report</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="lni lni-user"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Agent {{ $agent_name }} Detail</li>
                                                                
							</ol>
						</nav>
                                            
					</div>
					
				</div>
				<!--end breadcrumb-->
				
                                @if (Session::has('success'))
                               
                                <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2">
                                <div class="d-flex align-items-center">
                                <div class="font-35 text-success"><i class='bx bxs-check-circle'></i>
                                </div>
                                <div class="ms-3">
                                        <h6 class="mb-0 text-success">{{ Session::get('success') }}</h6>

                                </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			        </div>
                                @endif
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="data-table" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>S.No</th>
										<th>User</th>
                                        <th>Talk Time</th>
                                        <th>Campaign Name</th>
                                        <th>Call Date</th>
                                        <th>Mobile Number</th>
                                        <th>Dispostion</th>
                                        
									
									</tr>
								</thead>
								<tbody>
                              
                                 @foreach($vicidialLogs as $key=>$value)

                                  <tr>
                                       <td>{{ $key+1 }}</td>
                                      <td>{{ $value->user }}</td>
                                      <td>{{ $value->total_talk_time }}</td>
                                      <td>{{ $value->campaign_id }}</td>
                                      <td>{{ $value->call_date }}</td>
                                      <td>{{ $value->phone_number }}</td>
                                      <td>{{ $value->dispostion }}</td>

                                  </tr>
                                
                                 @endforeach
									
								</tbody>
								
							</table>
						</div>
					</div>
				</div>
				
			</div>
 
<script type="text/javascript">

$( document ).ready(function() {
    $('#data-table').DataTable({
        dom: 'Bfrtip',
                buttons: [
                'copyHtml5', 'excelHtml5', 'pdfHtml5', 'csvHtml5'
                ],
                "lengthMenu": [[50, 100 - 1], [50, 100, "All"]],
                 "pageLength": 50,

    });
});
        //      $(document).ready(function() {
		// 	var table = $('#data-table').DataTable( {
        //                     processing: true,
        //                     serverSide: true,
        //                     ajax: "{{ route('employee-list') }}",
        //                     columns: [
        //                         {data: 'DT_RowIndex', name: 'DT_RowIndex'}, 
        //                         {data: 'name', name: 'name'},
        //                         {data: 'email', name: 'email'},
        //                         {data: 'getRole', name: 'Role'},
        //                         {data: 'status', name: 'status'},
        //                         {data: 'created_at', name: 'created_at'},
        //                         {data: 'action', name: 'Action'},

        //                     ],
		// 		lengthChange: true,
		// 		buttons: [ 'copy', 'excel', 'pdf', 'print']
		// 	} );
		//   } );
                  
//   $(document).on("click", ".delete", function () {
//             var id= $(this).attr('data-id');
//     });
        </script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>

@endsection
