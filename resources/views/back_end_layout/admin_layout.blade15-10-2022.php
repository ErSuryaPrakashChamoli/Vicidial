<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{asset('assets/images/favicon32x100.jpg')}}" type="image/png" />
	<!--plugins-->
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
	<link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link rel="stylesheet" href="{{asset('assets/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css')}}" />
	<link href="{{asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
        
        <link href="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/highcharts/css/highcharts.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{asset('assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{asset('assets/css/dark-theme.css')}}" />
	<link rel="stylesheet" href="{{asset('assets/css/semi-dark.css')}}" />
	<link rel="stylesheet" href="{{asset('assets/css/header-colors.css')}}" />
	
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
	<script src="{{asset('assets/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
	<title><?php echo !empty($pageTitle)? $pageTitle:'CRM'; ?></title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{asset('assets/images/CCFEX-logo.png')}}" class="logo-icon" alt="logo icon">
				</div>
				
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
                        <x-sider-bar />
		        </ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<!--<div class="search-bar flex-grow-1">
						<div class="position-relative search-bar-box">
							<input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
							<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
						</div>
					</div>-->
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item mobile-search-icon">
								<a class="nav-link" href="#">	<i class='bx bx-search'></i>
								</a>
							</li>
							
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">7</span>
									<i class='bx bx-bell'></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">Notifications</p>
											<p class="msg-header-clear ms-auto">Marks all as read</p>
										</div>
									</a>
									<div class="header-notifications-list">
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Customers<span class="msg-time float-end">14 Sec
												ago</span></h6>
													<p class="msg-info">5 new user registered</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-danger text-danger"><i class="bx bx-cart-alt"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Orders <span class="msg-time float-end">2 min
												ago</span></h6>
													<p class="msg-info">You have recived new orders</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-success text-success"><i class="bx bx-file"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">24 PDF File<span class="msg-time float-end">19 min
												ago</span></h6>
													<p class="msg-info">The pdf files generated</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-warning text-warning"><i class="bx bx-send"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Time Response <span class="msg-time float-end">28 min
												ago</span></h6>
													<p class="msg-info">5.1 min avarage time response</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-info text-info"><i class="bx bx-home-circle"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Product Approved <span
												class="msg-time float-end">2 hrs ago</span></h6>
													<p class="msg-info">Your new product has approved</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-danger text-danger"><i class="bx bx-message-detail"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Comments <span class="msg-time float-end">4 hrs
												ago</span></h6>
													<p class="msg-info">New customer comments recived</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-success text-success"><i class='bx bx-check-square'></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Your item is shipped <span class="msg-time float-end">5 hrs
												ago</span></h6>
													<p class="msg-info">Successfully shipped your item</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-primary text-primary"><i class='bx bx-user-pin'></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New 24 authors<span class="msg-time float-end">1 day
												ago</span></h6>
													<p class="msg-info">24 new authors joined last week</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-warning text-warning"><i class='bx bx-door-open'></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Defense Alerts <span class="msg-time float-end">2 weeks
												ago</span></h6>
													<p class="msg-info">45% less alerts last 4 weeks</p>
												</div>
											</div>
										</a>
									</div>
									<a href="javascript:;">
										<div class="text-center msg-footer">View All Notifications</div>
									</a>
								</div>
							</li> 
						    <li class="nav-item dropdown dropdown-large">
								<!-- <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
									<i class='bx bx-comment'></i>
								</a> -->
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">Messages</p>
											<p class="msg-header-clear ms-auto">Marks all as read</p>
										</div>
									</a>
									<div class="header-message-list">
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{asset('assets/images/avatars/avatar-1.png')}}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Daisy Anderson <span class="msg-time float-end">5 sec
												ago</span></h6>
													<p class="msg-info">The standard chunk of lorem</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{asset('assets/images/avatars/avatar-2.png')}}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Althea Cabardo <span class="msg-time float-end">14
												sec ago</span></h6>
													<p class="msg-info">Many desktop publishing packages</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{asset('assets/images/avatars/avatar-3.png')}}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Oscar Garner <span class="msg-time float-end">8 min
												ago</span></h6>
													<p class="msg-info">Various versions have evolved over</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{asset('assets/images/avatars/avatar-4.png')}}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Katherine Pechon <span class="msg-time float-end">15
												min ago</span></h6>
													<p class="msg-info">Making this the first true generator</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{asset('assets/images/avatars/avatar-5.png')}}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Amelia Doe <span class="msg-time float-end">22 min
												ago</span></h6>
													<p class="msg-info">Duis aute irure dolor in reprehenderit</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{asset('assets/images/avatars/avatar-6.png')}}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Cristina Jhons <span class="msg-time float-end">2 hrs
												ago</span></h6>
													<p class="msg-info">The passage is attributed to an unknown</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{asset('assets/images/avatars/avatar-7.png')}}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">James Caviness <span class="msg-time float-end">4 hrs
												ago</span></h6>
													<p class="msg-info">The point of using Lorem</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{asset('assets/images/avatars/avatar-8.png')}}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Peter Costanzo <span class="msg-time float-end">6 hrs
												ago</span></h6>
													<p class="msg-info">It was popularised in the 1960s</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{asset('assets/images/avatars/avatar-9.png')}}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">David Buckley <span class="msg-time float-end">2 hrs
												ago</span></h6>
													<p class="msg-info">Various versions have evolved over</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{asset('assets/images/avatars/avatar-10.png')}}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Thomas Wheeler <span class="msg-time float-end">2 days
												ago</span></h6>
													<p class="msg-info">If you are going to use a passage</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{asset('assets/images/avatars/avatar-11.png')}}" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Johnny Seitz <span class="msg-time float-end">5 days
												ago</span></h6>
													<p class="msg-info">All the Lorem Ipsum generators</p>
												</div>
											</div>
										</a>
									</div>
									<a href="javascript:;">
										<div class="text-center msg-footer">View All Messages</div>
									</a>
								</div>
							</li>
						</ul>
					</div>
					<x-left-menu-bar/>
				</nav>
			</div>
		</header>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
             <!--------------------------------------------------------------------------------------------------------------------------->
            @yield('content')
            <!--------------------------------------------------------------------------------------------------------------------------->	
                    
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
                
                
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <!-- Modal body -->
      <div class="modal-body">
        <form>
        	<div class="row">
            	<div class="col-md-12 text-center">
                	<img src="http://61.246.36.70/loancrm/assets/images/profile/profile_63445f831acdb.png" id="dataftech_image" width="50" height="60" >
               	</div>
            </div>
            <div class="row">
            	<div class="col-md-3">
                <label>Employee Code*</label>
                </div>
                <div class="col-md-9">
                <input type="text" class="form-control form-control-sm" value="8787dky" name="employee_code" id="dataftech_employee_code" placeholder="Enter Your Employee Code" disabled="">
                </div>
            </div>
            <div class="row  mt-2">
              <div class="col-md-3">
                <label>First Name*</label>
                </div>
                <div class="col-md-9">
                <input type="text" class="form-control form-control-sm" value="Dharmu" name="first_name" id="dataftech_first_name" placeholder="Enter Your First Name" disabled="">
                </div>
            </div>
            <div class="row  mt-2">
              <div class="col-md-3">
                <label>Last Name*</label>
                </div>
                <div class="col-md-9">
                <input type="text" class="form-control form-control-sm" value="TL" name="last_name" id="dataftech_last_name" placeholder="Enter Your Last Name" disabled="">
                </div>
            </div>
            <div class="row  mt-2">
              <div class="col-md-3">
                <label>Email (Official)*</label>
                </div>
                <div class="col-md-9">
                <input type="text" class="form-control form-control-sm" value="dharmu@gmail.com" name="email" id="dataftech_email" placeholder="Enter Your Email" disabled="">
                </div>
            </div>
            <div class="row  mt-2">
              <div class="col-md-3">
                <label>Phone*</label>
                </div>
                <div class="col-md-9">
                <input type="text" class="form-control form-control-sm" value="7376469215" name="phone" id="dataftech_phone" placeholder="Enter Your Phone" disabled="">
                </div>
            </div>
            
            

        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

                
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright © 2022. All right reserved. Developed By: <a href="https://webthinksolution.com/" target="_blank"> WTS </a></p>
		</footer>
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	
	<script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
        
        <!-- Vector map JavaScript -->
	<script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
	<script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
	<!-- highcharts js -->
      
	<script src="{{asset('assets/plugins/highcharts/js/highcharts.js')}}"></script>
       <script src="{{asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
        
          @if(Request::path()== 'dashboard')
           <!--<script src="{{asset('assets/js/index2.js')}}"></script>-->
           <script type="text/javascript">
           $(function() {
	"use strict";
	var e = {
		series: [{
			name: "Sessions",
			data: [14, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5]
		}],
		chart: {
			foreColor: "#9ba7b2",
			height: 310,
			type: "area",
			zoom: {
				enabled: !1
			},
			toolbar: {
				show: !0
			},
			dropShadow: {
				enabled: !0,
				top: 3,
				left: 14,
				blur: 4,
				opacity: .1
			}
		},
		stroke: {
			width: 5,
			curve: "smooth"
		},
		xaxis: {
			type: "datetime",
			categories: ["1/11/2000", "2/11/2000", "3/11/2000", "4/11/2000", "5/11/2000", "6/11/2000", "7/11/2000", "8/11/2000", "9/11/2000", "10/11/2000", "11/11/2000", "12/11/2000"]
		},
		title: {
			text: "Sessions",
			align: "left",
			style: {
				fontSize: "16px",
				color: "#666"
			}
		},
		fill: {
			type: "gradient",
			gradient: {
				shade: "light",
				gradientToColors: ["#0d6efd"],
				shadeIntensity: 1,
				type: "vertical",
				opacityFrom: .7,
				opacityTo: .2,
				stops: [0, 100, 100, 100]
			}
		},
		markers: {
			size: 5,
			colors: ["#0d6efd"],
			strokeColors: "#fff",
			strokeWidth: 2,
			hover: {
				size: 7
			}
		},
		dataLabels: {
			enabled: !1
		},
		colors: ["#0d6efd"],
		yaxis: {
			title: {
				text: "Sessions"
			}
		}
	};
	new ApexCharts(document.querySelector("#chart1"), e).render();
	e = {
		series: [{
			name: "Total Users",
			data: [240, 160, 671, 414, 555, 257, 901, 613, 727, 414, 555, 257]
		}],
		chart: {
			type: "bar",
			height: 65,
			toolbar: {
				show: !1
			},
			zoom: {
				enabled: !1
			},
			dropShadow: {
				enabled: !0,
				top: 3,
				left: 14,
				blur: 4,
				opacity: .12,
				color: "#17a00e"
			},
			sparkline: {
				enabled: !0
			}
		},
		markers: {
			size: 0,
			colors: ["#17a00e"],
			strokeColors: "#fff",
			strokeWidth: 2,
			hover: {
				size: 7
			}
		},
		plotOptions: {
			bar: {
				horizontal: !1,
				columnWidth: "45%",
				endingShape: "rounded"
			}
		},
		dataLabels: {
			enabled: !1
		},
		stroke: {
			show: !0,
			width: 0,
			curve: "smooth"
		},
		colors: ["#17a00e"],
		xaxis: {
			categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			theme: "dark",
			fixed: {
				enabled: !1
			},
			x: {
				show: !1
			},
			y: {
				title: {
					formatter: function(e) {
						return ""
					}
				}
			},
			marker: {
				show: !1
			}
		}
	};
	new ApexCharts(document.querySelector("#chart2"), e).render();
	e = {
		series: [{
			name: "Page Views",
			data: [240, 160, 671, 414, 555, 257, 901, 613, 727, 414, 555, 257]
		}],
		chart: {
			type: "bar",
			height: 65,
			toolbar: {
				show: !1
			},
			zoom: {
				enabled: !1
			},
			dropShadow: {
				enabled: !0,
				top: 3,
				left: 14,
				blur: 4,
				opacity: .12,
				color: "#f41127"
			},
			sparkline: {
				enabled: !0
			}
		},
		markers: {
			size: 0,
			colors: ["#f41127"],
			strokeColors: "#fff",
			strokeWidth: 2,
			hover: {
				size: 7
			}
		},
		plotOptions: {
			bar: {
				horizontal: !1,
				columnWidth: "45%",
				endingShape: "rounded"
			}
		},
		dataLabels: {
			enabled: !1
		},
		stroke: {
			show: !0,
			width: 0,
			curve: "smooth"
		},
		colors: ["#f41127"],
		xaxis: {
			categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			theme: "dark",
			fixed: {
				enabled: !1
			},
			x: {
				show: !1
			},
			y: {
				title: {
					formatter: function(e) {
						return ""
					}
				}
			},
			marker: {
				show: !1
			}
		}
	};
	new ApexCharts(document.querySelector("#chart3"), e).render();
	e = {
		series: [{
			name: "Avg. Session Duration",
			data: [240, 160, 671, 414, 555, 257, 901, 613, 727, 414, 555, 257]
		}],
		chart: {
			type: "bar",
			height: 65,
			toolbar: {
				show: !1
			},
			zoom: {
				enabled: !1
			},
			dropShadow: {
				enabled: !0,
				top: 3,
				left: 14,
				blur: 4,
				opacity: .12,
				color: "#0d6efd"
			},
			sparkline: {
				enabled: !0
			}
		},
		markers: {
			size: 0,
			colors: ["#0d6efd"],
			strokeColors: "#fff",
			strokeWidth: 2,
			hover: {
				size: 7
			}
		},
		plotOptions: {
			bar: {
				horizontal: !1,
				columnWidth: "45%",
				endingShape: "rounded"
			}
		},
		dataLabels: {
			enabled: !1
		},
		stroke: {
			show: !0,
			width: 0,
			curve: "smooth"
		},
		colors: ["#0d6efd"],
		xaxis: {
			categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			theme: "dark",
			fixed: {
				enabled: !1
			},
			x: {
				show: !1
			},
			y: {
				title: {
					formatter: function(e) {
						return ""
					}
				}
			},
			marker: {
				show: !1
			}
		}
	};
	new ApexCharts(document.querySelector("#chart4"), e).render();
	e = {
		series: [{
			name: "Bounce Rate",
			data: [240, 160, 671, 414, 555, 257, 901, 613, 727, 414, 555, 257]
		}],
		chart: {
			type: "bar",
			height: 65,
			toolbar: {
				show: !1
			},
			zoom: {
				enabled: !1
			},
			dropShadow: {
				enabled: !0,
				top: 3,
				left: 14,
				blur: 4,
				opacity: .12,
				color: "#ffb207"
			},
			sparkline: {
				enabled: !0
			}
		},
		markers: {
			size: 0,
			colors: ["#ffb207"],
			strokeColors: "#fff",
			strokeWidth: 2,
			hover: {
				size: 7
			}
		},
		plotOptions: {
			bar: {
				horizontal: !1,
				columnWidth: "45%",
				endingShape: "rounded"
			}
		},
		dataLabels: {
			enabled: !1
		},
		stroke: {
			show: !0,
			width: 0,
			curve: "smooth"
		},
		colors: ["#ffb207"],
		xaxis: {
			categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			theme: "dark",
			fixed: {
				enabled: !1
			},
			x: {
				show: !1
			},
			y: {
				title: {
					formatter: function(e) {
						return ""
					}
				}
			},
			marker: {
				show: !1
			}
		}
	};
	new ApexCharts(document.querySelector("#chart5"), e).render(), Highcharts.chart("chart6", {
		chart: {
			height: 350,
			type: "column",
			styledMode: !0
		},
		credits: {
			enabled: !1
		},
		title: {
			text: "Total Customer  January, 2020"
		},
		accessibility: {
			announceNewData: {
				enabled: !0
			}
		},
		xAxis: {
			type: "category"
		},
		yAxis: {
			title: {
				text: "Total percent customer share"
			}
		},
		legend: {
			enabled: !1
		},
		plotOptions: {
			series: {
				borderWidth: 0,
				dataLabels: {
					enabled: !0,
					format: "{point.y:.1f}%"
				}
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
		},
		series: [{
			name: "Customer",
			colorByPoint: !0,
			data: [{
				name: "Interested",
				y: ,
				drilldown: "Interested"
			}, {
				name: "Not Interested",
				y: ,
				drilldown: "Not Interested"
			}, {
				name: "Follow Up",
				y: ,
				drilldown: "Follow Up"
			}, {
				name: "Call Back",
				y: ,
				drilldown: "Call Back"
			}]
		}],
		drilldown: {
			series: [{
				name: "Chrome",
				id: "Chrome",
				data: [
					["v65.0", .1],
					["v64.0", 1.3],
					["v63.0", 53.02],
					["v62.0", 1.4],
					["v61.0", .88],
					["v60.0", .56],
					["v59.0", .45],
					["v58.0", .49],
					["v57.0", .32],
					["v56.0", .29],
					["v55.0", .79],
					["v54.0", .18],
					["v51.0", .13],
					["v49.0", 2.16],
					["v48.0", .13],
					["v47.0", .11],
					["v43.0", .17],
					["v29.0", .26]
				]
			}, {
				name: "Firefox",
				id: "Firefox",
				data: [
					["v58.0", 1.02],
					["v57.0", 7.36],
					["v56.0", .35],
					["v55.0", .11],
					["v54.0", .1],
					["v52.0", .95],
					["v51.0", .15],
					["v50.0", .1],
					["v48.0", .31],
					["v47.0", .12]
				]
			}, {
				name: "Internet Explorer",
				id: "Internet Explorer",
				data: [
					["v11.0", 6.2],
					["v10.0", .29],
					["v9.0", .27],
					["v8.0", .47]
				]
			}, {
				name: "Safari",
				id: "Safari",
				data: [
					["v11.0", 3.39],
					["v10.1", .96],
					["v10.0", .36],
					["v9.1", .54],
					["v9.0", .13],
					["v5.1", .2]
				]
			}, {
				name: "Edge",
				id: "Edge",
				data: [
					["v16", 2.6],
					["v15", .92],
					["v14", .4],
					["v13", .1]
				]
			}, {
				name: "Opera",
				id: "Opera",
				data: [
					["v50.0", .96],
					["v49.0", .82],
					["v12.1", .14]
				]
			}]
		}
	}), Highcharts.chart("chart7", {
		chart: {
			height: 350,
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: !1,
			type: "pie",
			styledMode: !0
		},
		credits: {
			enabled: !1
		},
		title: {
			text: "Total Customer "
		},
		subtitle: {
			text: "Ratio of customer base on interest"
		},
		tooltip: {
			pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>"
		},
		accessibility: {
			point: {
				valueSuffix: "%"
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: !0,
				cursor: "pointer",
				innerSize: 120,
				dataLabels: {
					enabled: !0,
					format: "<b>{point.name}</b>: {point.percentage:.1f} %"
				},
				showInLegend: !0
			}
		},
		series: [{
			name: "customer",
			colorByPoint: !0,
			data: [{
				name: "Interested",
				y: 
			}, {
				name: "Not Interested",
				y: 
			}, {
				name: "Follow Up",
				y: 
			},
                          {
				name: "Call Back",
				y: 
			   }
                            ]
		}],
		responsive: {
			rules: [{
				condition: {
					maxWidth: 500
				},
				chartOptions: {
					plotOptions: {
						pie: {
							innerSize: 140,
							dataLabels: {
								enabled: !1
							}
						}
					}
				}
			}]
		}
	}), Highcharts.chart("chart8", {
		chart: {
			type: "bar",
			styledMode: !0
		},
		credits: {
			enabled: !1
		},
		exporting: {
			buttons: {
				contextButton: {
					enabled: !1
				}
			}
		},
		title: {
			text: "Visitor by Gender"
		},
		xAxis: {
			categories: ["Jan", "Feb", "Mar", "Apr", "May"]
		},
		yAxis: {
			min: 0,
			title: {
				text: "Visitor by Genders",
				style: {
					display: "none"
				}
			}
		},
		legend: {
			reversed: !1
		},
		plotOptions: {
			series: {
				stacking: "normal"
			}
		},
		series: [{
			name: "Male",
			data: [5, 3, 4, 7, 2]
		}, {
			name: "Female",
			data: [2, 2, 3, 2, 1]
		}, {
			name: "Others",
			data: [3, 4, 4, 2, 5]
		}]
	});
	e = {
		series: [42, 47, 52, 58, 65],
		chart: {
			height: 340,
			type: "polarArea"
		},
		labels: ["Chrome", "Firefox", "Edge", "Opera", "Safari"],
		fill: {
			opacity: 1
		},
		stroke: {
			width: 1,
			colors: void 0
		},
		colors: ["#17a00e", "#0dcaf0", "#f41127", "#ffc107", "#0d6efd"],
		yaxis: {
			show: !1
		},
		dataLabels: {
			enabled: !1
		},
		legend: {
			show: !1,
			position: "bottom"
		},
		plotOptions: {
			polarArea: {
				rings: {
					strokeWidth: 0
				}
			}
		}
	};
	new ApexCharts(document.querySelector("#chart9"), e).render(), jQuery("#geographic-map").vectorMap({
		map: "world_mill_en",
		backgroundColor: "transparent",
		borderColor: "#818181",
		borderOpacity: .25,
		borderWidth: 1,
		zoomOnScroll: !1,
		color: "#009efb",
		regionStyle: {
			initial: {
				fill: "#6c757d"
			}
		},
		markerStyle: {
			initial: {
				r: 9,
				fill: "#fff",
				"fill-opacity": 1,
				stroke: "#000",
				"stroke-width": 5,
				"stroke-opacity": .4
			}
		},
		enableZoom: !0,
		hoverColor: "#009efb",
		markers: [{
			latLng: [21, 78],
			name: "I Love My India"
		}],
		series: {
			regions: [{
				values: {
					IN: "#0d6efd",
					US: "#15b70a",
					RU: "#f41127",
					AU: "#ffb207"
				}
			}]
		},
		hoverOpacity: null,
		normalizeFunction: "linear",
		scaleColors: ["#b6d6ff", "#005ace"],
		selectedColor: "#c9dfaf",
		selectedRegions: [],
		showTooltip: !0,
		onRegionClick: function(e, t, o) {
			var r = 'You clicked "' + o + '" which has the code: ' + t.toUpperCase();
			alert(r)
		}
	}),
	
	
	
	
	new PerfectScrollbar('.dashboard-top-countries');
	
	
	
	
	
});
           </script>
          @endif
        
	
	<script src="{{asset('assets/js/table-datatable.js')}}"></script>
        
	<!--app JS-->
	<script src="{{asset('assets/js/app.js')}}"></script>
        <script>
(function($){
    $(function(){
        $('#dob').datetimepicker({
            "allowInputToggle": true,
            "showClose": true,
            "showClear": true,
            "showTodayButton": true,
            "format": "MM/DD/YYYY",
            //locale: 'pt-br',
             maxDate: moment(),  
            
        });
        $('#follow_up_dates').datetimepicker({
            "allowInputToggle": true,
            "showClose": true,
            "showClear": true,
            "showTodayButton": true,
            "format": "MM/DD/YYYY HH:mm:ss",
            "minDate":new Date()
            //"maxDate": new Date(),   
        });
      });
})(jQuery);


$(document).ready(function(){
        $('.myBtn').click(function(){
          var id= $(this).attr('data-id');
          $.ajax({
            method: 'get',
            dataType: 'json',
            url: "{{ route('get-team-data') }}",
            data: {
                id: id
            },
            success: function(result) {

           //console.table(result.data.first_name);  
          // alert(result.data.employee_code);
           $("#dataftech_image").attr("src","{{asset('assets/images/profile/')}}/"+result.data.profile_image)
           $("#dataftech_employee_code").val(result.data.employee_code);
           $("#dataftech_first_name").val(result.data.first_name);
           $("#dataftech_last_name").val(result.data.last_name);
           $("#dataftech_email").val(result.data.email);
           $("#dataftech_phone").val(result.data.phone);
     


            }
        });
        });
       
});
</script>
        
</body>

</html>