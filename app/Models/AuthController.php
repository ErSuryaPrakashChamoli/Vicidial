<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ActionMaster;
use App\Models\RoleMaster;
use App\Models\Customer;
use App\Models\CustomerData;
use App\Models\Bank;
use App\Models\Reason;
use App\Models\Countries;
use App\Models\States;
use App\Models\Cities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
date_default_timezone_set("Asia/Calcutta");
class AuthController extends Controller
{
     public function index()
    {
        return view('auth.login');
    }
     public function register()
    {   $Roles=RoleMaster::all();
        return view('auth.register',compact('Roles'));
    }
    public function createUser(Request $request){
        $request->validate([
            'first_name'=>'required|string|max:30',
            'last_name'=>'required|string|max:30',
            'email' => 'required|email|unique:users,email|email:rfc,dns',
            'password'=>['required',Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()],
            'password_confirmation'=> 'required_with:password|same:password|min:8',
            'user_role'=> 'required',
        ]);
     // print_r($_POST);exit();
       $data= User::create([
            'name'=>$request->first_name.' '.$request->last_name,
            'email'=>$request->email,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name, 
            'status'=>'0',
            'user_role'=>$request->user_role, 
            'password'=> Hash::make($request->password)
        ]);
         if($data->id>0)
         {
          return redirect('login');  
         }
        /*if(Auth::attempt($request->only('email','password'))){
            return redirect('dashboard');
        }*/
        
        return redirect('register')->withError('Error');
    }
    
    
    public function login(Request $request){
      // dd(User::where('email','surya002@gmail.com')->first());
        // dd(User::all()->toJson());

 
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' =>  $request->password, 'status' => '1'])){
            $Users = User::find(Auth::id());
            $Users->ip_address =$request->ip(); //$_SERVER['REMOTE_ADDR'];
            $Users->login = date("Y-m-d H:i:s", time());
            $Users->save();
            return redirect('dashboard');
        }


        return redirect('/')->withError('Please enter the valid credentials');

    }
    
    public function dashboard(){
      ini_set('memory_limit', '1040M');      
       switch (Auth::user()->user_role) {
        case 1:
            $Super_admin=User::where(['user_role'=>1])->count();
            $Admin=User::where(['user_role'=>2])->count();
            $Manager=User::where(['user_role'=>3])->count();
            $TL=User::where(['user_role'=>4])->count();
            $Sale_Executive=User::where(['user_role'=>5])->count();
            $Customer_Interest=Customer::where(['interest'=>1])->count();
            $Customer_NotInterest=Customer::where(['interest'=>'NI'])->count();
            $Customer_Followup=Customer::where(['interest'=>3])->count();
            $Customer_CallBack=Customer::where(['interest'=>'CALLBK'])->count();
            $Customer=Customer::all()->count();
           return view('back_end/dashboard_admin',compact('Super_admin','Admin','Manager','TL','Sale_Executive','Customer','Customer_Interest','Customer_NotInterest','Customer_Followup','Customer_CallBack'));
       
          // return view('back_end/dashboard_admin',compact('Super_admin','Admin','Manager','TL','Sale_Executive')); 
            
          // return view('back_end/dashboard');
            break;
        case 2:
            $Super_admin=User::where(['user_role'=>1])->count();
            $Admin=User::where(['user_role'=>2])->count();
            $Manager=User::where(['user_role'=>3])->count();
            $TL=User::where(['user_role'=>4])->count();
            $Sale_Executive=User::where(['user_role'=>5])->count();
           /* $Customer_Interest=Customer::where(['interest'=>1])->count();
            $Customer_NotInterest=Customer::where(['interest'=>2])->count();
            $Customer_Followup=Customer::where(['interest'=>3])->count();
            $Customer_CallBack=Customer::where(['interest'=>4])->count();
            $Customer=Customer::all()->count();*/
           //return view('back_end/dashboard_admin',compact('Super_admin','Admin','Manager','TL','Sale_Executive','Customer','Customer_Interest','Customer_NotInterest','Customer_Followup','Customer_CallBack'));
            return view('back_end/dashboard_admin',compact('Super_admin','Admin','Manager','TL','Sale_Executive'));
          break;
        case 3:
            
          /* $Super_admin=User::where(['user_role'=>1])->count();
            $Admin=User::where(['user_role'=>2])->count();
            $Manager=User::where(['user_role'=>3])->count();
            $TL=User::where(['user_role'=>4])->count();
            $Sale_Executive=User::where(['user_role'=>5])->count();
           * 
           */
          /*  $Customer_Interest=Customer::where(['interest'=>1])->count();
            $Customer_NotInterest=Customer::where(['interest'=>2])->count();
            $Customer_Followup=Customer::where(['interest'=>3])->count();
            $Customer_CallBack=Customer::where(['interest'=>4])->count();
            $Customer=Customer::all()->count();*/
         //  return view('back_end/dashboard_admin',compact('Super_admin','Admin','Manager','TL','Sale_Executive','Customer','Customer_Interest','Customer_NotInterest','Customer_Followup','Customer_CallBack'));
          //return view('back_end/dashboard_admin',compact('Super_admin','Admin','Manager','TL','Sale_Executive'));
            
            $getEmployees =User::where(['manager_id'=>Auth::user()->id])->pluck('id')->toArray();     
            $data= Customer::whereIn('emp_id',$getEmployees)->orderBy('id','desc')->with('getEmploye')->with('getBankName')->get();
           
            $Customer_Interest= Customer::whereIn('emp_id',$getEmployees)->where(['interest'=>1])->count();
            $Customer_NotInterest= Customer::whereIn('emp_id',$getEmployees)->where(['interest'=>'NI'])->count();
            $Customer_Followup=Customer::whereIn('emp_id',$getEmployees)->where(['interest'=>3])->count();
            $Customer_CallBack=Customer::whereIn('emp_id',$getEmployees)->whereIn('interest', array('CALLBK','3'))->count();
            $Call=Customer::whereIn('emp_id',$getEmployees)->whereIn('interest', array('CALLBK','3'))->get();
   
            $Customer=Customer::whereIn('emp_id',$getEmployees)->count();
            $Achievement= User::where(['id'=>Auth::user()->id])->with('getAchievement')->first();
            $Sum = Customer::where(['emp_id'=>Auth::user()->id,'interest'=>1])->sum('salary');
        
            //dd($Achievement->getAchievement->amount);
           return view('back_end/dashboard_sale_executive',compact('Customer','Customer_Interest','Customer_NotInterest','Customer_Followup','Customer_CallBack','Achievement','Sum','Call'));
            break;
       case 4:
            /* $Super_admin=User::where(['user_role'=>1])->count();
            $Admin=User::where(['user_role'=>2])->count();
            $Manager=User::where(['user_role'=>3])->count();
            $TL=User::where(['user_role'=>4])->count();
           $Sale_Executive=User::where(['user_role'=>5])->count();
            $Customer_Interest=Customer::where(['interest'=>1])->count();
            $Customer_NotInterest=Customer::where(['interest'=>2])->count();
            $Customer_Followup=Customer::where(['interest'=>3])->count();
            $Customer_CallBack=Customer::where(['interest'=>4])->count();
            $Customer=Customer::all()->count();
         
         
            //return view('back_end/dashboard_admin',compact('Super_admin','Admin','Manager','TL','Sale_Executive','Customer','Customer_Interest','Customer_NotInterest','Customer_Followup','Customer_CallBack'));
           return view('back_end/dashboard_admin',compact('Super_admin','Admin','Manager','TL','Sale_Executive'));*/
           
           $getEmployees =User::where(['tl_id'=>Auth::user()->id])->pluck('id')->toArray();    
           $data= Customer::whereIn('emp_id',$getEmployees)->orderBy('id','desc')->with('getEmploye')->with('getBankName')->get();
           
            $Customer_Interest= Customer::whereIn('emp_id',$getEmployees)->where(['interest'=>1])->count();
            $Customer_NotInterest= Customer::whereIn('emp_id',$getEmployees)->where(['interest'=>'NI'])->count();
            $Customer_Followup=Customer::whereIn('emp_id',$getEmployees)->where(['interest'=>3])->count();
            $Customer_CallBack=Customer::whereIn('emp_id',$getEmployees)->whereIn('interest', array('CALLBK','3'))->count();
            $Call=Customer::whereIn('emp_id',$getEmployees)->whereIn('interest', array('CALLBK','3'))->get();
   
            $Customer=Customer::whereIn('emp_id',$getEmployees)->count();
            $Achievement= User::where(['id'=>Auth::user()->id])->with('getAchievement')->first();
            $Sum = Customer::where(['emp_id'=>Auth::user()->id,'interest'=>1])->sum('salary');
        
            //dd($Achievement->getAchievement->amount);
           return view('back_end/dashboard_sale_executive',compact('Customer','Customer_Interest','Customer_NotInterest','Customer_Followup','Customer_CallBack','Achievement','Sum','Call'));
            break;
       case 5:
           
           
            $Customer_Interest=Customer::where(['interest'=>1,'emp_id'=>Auth::user()->id])->count();
            $Customer_NotInterest=Customer::where(['interest'=>'NI','emp_id'=>Auth::user()->id])->count();
            $Customer_Followup=Customer::where(['interest'=>3,'emp_id'=>Auth::user()->id])->count();
            $Customer_CallBack=Customer::where(['interest'=>'CALLBK','emp_id'=>Auth::user()->id])->count();
            $Call=Customer::where(['emp_id'=>Auth::user()->id])->whereIn('interest', array('CALLBK','3'))->get();
   
            $Customer=Customer::where(['emp_id'=>Auth::user()->id])->count();
            $Achievement= User::where(['id'=>Auth::user()->id])->with('getAchievement')->first();
            $Sum = Customer::where(['emp_id'=>Auth::user()->id,'interest'=>1])->sum('salary');
        
            //dd($Achievement->getAchievement->amount);
           return view('back_end/dashboard_sale_executive',compact('Customer','Customer_Interest','Customer_NotInterest','Customer_Followup','Customer_CallBack','Achievement','Sum','Call'));
           break;
        default:
           return view('back_end/dashboard');
}
      // dd(session('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d')); 
        //return view('home');
    // return view('back_end/dashboard');
        
        //$SiderBars = ActionMaster::where(['status'=>'1','parent_id'=>'0'])->orderby('display_order', 'asc')->with('childrens')->get();
         
        //dd($SiderBars);
        
       
    }
    public function logout(){
        $Users = User::find(Auth::id());
        $Users->ip_address = $_SERVER['REMOTE_ADDR'];
        $Users->logout = date("Y-m-d H:i:s", time());
        $Users->save();
        \Session::flush();
        Auth::logout();
        return redirect('');
    }
    
     public  function getDetailsByPhoneNo(Request $request)
    {
     //print_r(Hash::make($request->token));exit();  //for Admin@123-$2y$13$FZAB1DUP8V/HIrxckYO4y.7Vwog0NDNL2eG/W1v5lKXEVrwlTThHi
         
      /*if (! Hash::check($request->token,'$2y$10$/5IHsbcWQ.kzRSp//hac8e.0R3d5lBO.A/qonZmYCieM7zwmKJa3e')) {
           return response()->json(['response' => false, 'message'=>'The provided credentials are incorrect.'], 401);
    }*/  
        
      /* $validated = $request->validate([
            'phone_number' => 'required',
            'agent_id'=>'required'
        ]);*/
        
       
       $Customers_edit= CustomerData::where('phone', $request->phone_number)->first();
       $States=States::where(['country_id'=>'105'])->get();// for india
        $Countries=Countries::find('105');// for india
       $Banks=Bank::all();//
       $Reasons=Reason::all();
       //dd($Customers_edit);
       if(!empty($Customers_edit)){
      // return response()->json(['response' => true, 'message'=>'result found','last_record'=>$data], 200);
        return view('auth.dialer',compact('Countries','States','Customers_edit','Banks','Reasons'));     
       }
       else{
       // return view('auth.login');   
      // return response()->json(['response' => true, 'message'=>'no result found','last_record'=>$data], 200);
       // return view('auth.dialer',compact('Countries','States','Customers_edit','Banks','Reasons'));
           return view('errors.404');
           
       }
    }  
    
    public  function getCronStatus()
    {
      
  //  $str="SUCCESS: add_lead LEAD HAS BEEN ADDED - 1232567890|5555|31|-4|crmaccess|130 NOTICE: add_lead ADDED TO HOPPER - 1232567890|31|11|crmaccess";
  //  $tt=explode("|",$str);
  ///  echo'<pre>';
    //print_r(explode(" ", $tt[5])[0]);exit;
/*$val=1232567810;        
$url = 'http://192.168.0.230/vicidial/non_agent_api.php?source=13&user=crmaccess&pass=Crmaccessf0rm976trf&function=add_lead&phone_number='.$val.'&phone_code=1&list_id=5555&add_to_hopper=Y&duplicate_check=DUPCAMP&hopper_priority=99';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
$data = curl_exec($curl);
curl_close($curl);
print_r($data);exit;*/
       
       $live_url  = GetLiveUrl();
       $CronJob= CustomerData::where(['cron_status'=>'0'])->take(50)->get();
       foreach ($CronJob as $key => $value) {
       // echo  $value->phone.'<br/>';; 
       //http://192.168.0.236/vicidial/non_agent_api.php?source=myzeon&user=crmaccess&pass=Crmaccessf0rm976trf&function=add_lead&phone_number=7758255685&phone_code=1&list_id=5555&add_to_hopper=Y&duplicate_check=DUPCAMP&hopper_priority=99&crm_id=100    
        $url = $live_url.'vicidial/non_agent_api.php?source='.$value->id.'&user=crmaccess&pass=Crmaccessf0rm976trf&function=add_lead&phone_number='.$value->phone.'&phone_code=1&list_id=5555&add_to_hopper=Y&duplicate_check=DUPCAMP&hopper_priority=99';
    //  $url = 'http://192.168.0.236/vicidial/non_agent_api.php?source=myzeon&user=crmaccess&pass=Crmaccessf0rm976trf&function=add_lead&phone_number='.$value->phone.'&phone_code=1&list_id=5555&add_to_hopper=Y&duplicate_check=DUPCAMP&hopper_priority=99';
        $curl = curl_init(); 
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        curl_close($curl);
        $array = explode(':', $data);
        //print_r($array);
        print_r($data);
        if($array[0]!='ERROR')
        {   
        CustomerData::where('id',$value->id)->update(['cron_status'=>'1']);   
        }
        else
        {
         CustomerData::where('id',$value->id)->update(['cron_status'=>'2','error_log'=>$data]);   
        }
       }
     
    }  
    
     public function getSendSMS() {
        $curl = curl_init();
//
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=FL6JeRspkygYmU70tfWKiX42vIjxb8PQdo9MCOBTchqN1ZV5ADTV8AHNcI2K57YxlLj4dZBMmr3Cetua&message=".urlencode('This is a test message for crm')."&language=english&route=q&numbers=".urlencode('8586853537,7982713711'),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }

    }
    
    
    
}
