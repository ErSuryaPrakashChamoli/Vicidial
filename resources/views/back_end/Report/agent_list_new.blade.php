<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Report</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="lni lni-user"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Agent Daily Report</li>
                                                                
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
                                        <th>Total Call</th>
                                        <th>Total Talk time</th>
                                        <th>Total Time Spend</th>
                                        <th>Total Pause Time</th>
                                        <th>BIO Break time</th>
                                        <th>Tea Break Time</th>
                                        <th>Meet Time</th>
                                        <th>Lunch Time</th>
                                        <th>OTP Break</th>
                                        <th>Dead Sec</th>
                                        <th>Login</th>
                                        <th>Logout</th>
                                    
									</tr>
								</thead>
								<tbody>
                              
                                 @foreach($vicidialLogs as $key=>$value)
                                  <tr>
                                       <td>{{ $key+1 }}</td>
                                      <td><a href="http://192.168.0.229/loancrm/agent-total-call/{{ $value->user }}">{{ $value->user }}</a></td>
                                      <td>{{ $value->total_calls }}</td>
                                      <td>{{ $value->total_talktime }}</td>
                                      <td>{{ ($value->total_time)?$value->total_time:'00:00:00' }}</td>
                                      <td>{{ $value->total_pause_time }}</td>
                                      <td>{{ ($value->bath_pause_time)?$value->bath_pause_time:'00:00:00' }}</td>
                                      <td>{{ ($value->BRK_pause_time)?$value->BRK_pause_time:'00:00:00' }}</td>
                                      <td>{{ ($value->BRK_pause_time)?$value->BRK_pause_time:'00:00:00' }}</td>
                                      <td>{{ ($value->BRK_pause_time)?$value->BRK_pause_time:'00:00:00' }}</td>
                                      <td>{{ ($value->agent_login)?$value->agent_login:'00:00:00' }}</td>
                                      <td>{{ ($value->dead_sec)?$value->dead_sec:'00:00:00' }}</td>
                                      <td>{{ ($value->agent_login)?$value->agent_login:'00:00:00' }}</td>
                                      <td>{{ ($value->agent_logout)?$value->agent_logout:'00:00:00' }}</td>
                                     
                                      
                                  </tr>
                                
                                 @endforeach
									
								</tbody>
								
							</table>
						</div>
					</div>
				</div>


                <img src="/var/www/html/vicidial/report.png" width="100%" height="100%">
				
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
    
        </script>



    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    
</body>
</html>