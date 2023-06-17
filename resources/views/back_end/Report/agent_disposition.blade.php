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
                                        <th>Answering Machine</th>
                                        <th>Busy</th>
                                        <th>Call Back</th>
                                        <th>Dead Air</th>
                                        <th>Disconnected Number</th>
                                        <th>Declined Sale</th>
                                        <th>DO NOT CALL</th>
                                        <th>No Answer</th>
                                        <th>Not Interested</th>
                                        <th>No Pitch No Price</th>
                                        <th>Sale Made</th>
                                        <th>Call Transferred</th>
                                        <th>Ok OTP</th>
                                        <th>Not eligible</th>
                                        <th>Voice issue</th>
                                        <th>Wrong No</th>
                                        <th>elf employed</th>
                                        <th>Language barrier</th>
                                        <th>Low salary</th>
                                        <th>No Pich No Price</th>
                                    
									</tr>
								</thead>
								<tbody>
                                
                                
                              
                                  <tr>
                                  <td>{{ 1 }}</td>
                                      <td><a href="{{ $total_dispo_list['user'] }}">{{ $total_dispo_list['user'] }}</a></td>
                                      <td>{{ $total_dispo_list['answeringMachine'] }}</td>
                                      <td>{{ $total_dispo_list['busy'] }}</td>
                                      <td>{{ $total_dispo_list['call_back'] }}</td>
                                      <td>{{ $total_dispo_list['dead_air'] }}</td>
                                      <td>{{ $total_dispo_list['disconnected_number'] }}</td>
                                      <td>{{ $total_dispo_list['diclined_sale'] }}</td>
                                      <td>{{ $total_dispo_list['do_not_call'] }}</td>
                                      <td>{{ $total_dispo_list['no_answer'] }}</td>
                                      <td>{{ $total_dispo_list['not_intersted'] }}</td>
                                      <td>{{ $total_dispo_list['no_pitch_no_price'] }}</td>
                                      <td>{{ $total_dispo_list['sale_mode'] }}</td>
                                      <td>{{ $total_dispo_list['call_transfered'] }}</td>
                                      <td>{{ $total_dispo_list['ok_otp'] }}</td>
                                      <td>{{ $total_dispo_list['not_eligible'] }}</td>
                                      <td>{{ $total_dispo_list['voice_issue'] }}</td>
                                      <td>{{ $total_dispo_list['wrong_no'] }}</td>
                                      <td>{{ $total_dispo_list['self_employed'] }}</td>
                                      <td>{{ $total_dispo_list['language_barrier'] }}</td>
                                      <td>{{ $total_dispo_list['low_salary'] }}</td>
                                      <td>{{ $total_dispo_list['no_pich_no_price'] }}</td>
                                   
                                  </tr>
                                
                            
									
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