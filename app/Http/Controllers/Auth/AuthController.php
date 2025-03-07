<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Crypt;
 
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(): View
    {
        
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration(): View
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request): RedirectResponse
    {
        // $param = 'SuVnXkzSDu';
        
        $param = array(
            'sid'=>'SuVnXkzSDu',
        );

        $options = array( 'http' => array(
            'header' => 'Content-Type: application/x-www-form-urlencoded'."\r\n",
            'method' => 'POST' ,
            'content' => http_build_query($param) ,
            'ignore_errors' => true,
                ),"ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
                // "cafile" => "C:/xampp/php/extras/ssl/cacert.pem", // Ensure the path is correct
                ],
        );

        // $baseUrl = str_replace(':8000', '', config('app.url'));
        $unidAPI = "https://auth.unid.net/1.0.0/user/get_regist_token/";
        $context = stream_context_create($options);
        $content = file_get_contents($unidAPI,false,$context);
        $arr = json_decode($content, true);
        if($arr["status"]==0){
            $unid_src = 'https://auth.unid.net/1.0.0/user/authorization?is_two_way=0&r_token='.$arr['r_token'].'&callback_url='.urlencode(route('callBackLogin'));
        }else{
            $unid_src = '';
        }

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            // return view('auth.login');
            // return view('dashboard',compact('param'));

            // return redirect()->intended('dashboard')->with(compact('param'));

            return redirect()->intended('dashboard')->with('unid_src', $unid_src);

            // return redirect()->intended('dashboard?param=$param')
            //             ->withSuccess('You have Successfully loggedin');
        }
  
        return redirect("login")->withError('Oppes! You have entered invalid credentials');
    }

    public function callBackLogin(Request $request)
    {
        $status = $request->get('status', 'true');
        if ($status != 'true') {
             $this->setError('');
            return;
        }

        $access_token = $request->get('access_token');
        $param = array('access_token'=>$access_token);
        $options = array( 'http' => array(
            'header' => 'Content-Type: application/x-www-form-urlencoded'."\r\n",
            'method' => 'POST' ,
            'content' => http_build_query($param) ,
            'ignore_errors' => true,
        ));

        $unid_login = 'https://auth.unid.net/1.0.0/user/login/';
        $contents = file_get_contents ($unid_login, false,stream_context_create($options) );
        $raw_info = json_decode($contents)->{'user_info'};
         $user_info = json_decode(Crypt::decrypt($raw_info));

        try {
            $user_info = json_decode(Crypt::decrypt($raw_info));
             dd($user_info);
        } catch (\Exception $e) {
            $this->setError ('');
            return;
        }
        $id = $user_info->{'id'};

        $user = User::where('id', $id)->first();    

        if ($user) {
            // Authenticate the user
            Auth::login($user);

           
                return redirect()->route('dashboard');
            
        } else {
            return redirect()->route('login');
            // Handle case where user with given ID is not found
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request): RedirectResponse
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $user = $this->create($data);
            
        Auth::login($user); 

        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();
  
        return redirect("login")->withSuccess('Great! You have Successfully logged out');
        // return redirect("login");
    }    
    
    public function accounts()
    {
        return view("accounts");
    }

}
