<?php

namespace App\Http\Controllers\Api\V001;

use App\Http\Controllers\Api\V001\ApiController;
use App\Http\Traits\JsonResponseTrait;
use Modules\Main\Models\Customer;
use App\Http\Controllers\Api\V001\Mail\ActiveMail;
use App\Http\Controllers\Api\V001\Mail\VerifyCode;
use App\Http\Controllers\Api\V001\Mail\ForgetPassword;

use Modules\General\Models\PasswordReset;

use Modules\Main\Models\City;
use App\Http\Traits\SendSMS;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CustomersController extends ApiController
{
    use JsonResponseTrait;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * sendVerifyCode
     * @param  Request $request credential
     * @return json
     */
    public function sendVerifyCode(Request $request)
    {

        $rules = array(
            'phone'     => 'required_if:auth_type,phone|numeric',
            'email'     => 'required_if:auth_type,email|email',
            'country_code' => 'required_if:auth_type,phone',
            'auth_type'      => 'required|in:phone,email',
        );

        // Check if Data Valid or Not
        $checkDataValid = $this->validateData($request->all(), $rules);
        if ($checkDataValid) {
            return $this->jsonResponse(422, __('general::lang.wrongData'), $checkDataValid, null);
        }

        $code = rand(111111,999999);
        $is_verify = PasswordReset::where('email',request($request->auth_type))->first();
        if($is_verify){
            PasswordReset::where('email',request($request->auth_type))->delete();
        }
        PasswordReset::create(['email'=>request($request->auth_type),'token'=>$code ,'created_at'=>now()]);

        if($request->auth_type == 'phone'){
            $message = __('general::lang.VerificationCodeIs'). ' ' . $code;
            // $result = send_sms(request('phone'),$message);
            // if($result == 'success'){
            //     return $this->jsonResponse(200, __('general::lang.VerificationCodeSended'), null,$code);
            // }else{
            //     return $this->jsonResponse(422, __('general::lang.failedSendVerificationCode'), [], null);
            // }
              Mail::to($request->email)->send(new VerifyCode($code));



        }else{
            if($request->email)
            {
                Mail::to($request->email)->send(new VerifyCode($code));
            }
        }

        return $this->jsonResponse(200, __('general::lang.VerificationCodeSended'), null,$code);

    }

    /**
     * Check phone Number is Exist
     * @param  Request $request credential
     * @return json
     */
    public function checkPhoneNumber(Request $request)
    {
        $request['phone']  = str_replace(' ', '', $request->phone );
        // return $request->phone;
        $rules = array(
            'phone' => 'required|numeric',
            'country_code' => 'required',
        );
        // Check if Data Valid or Not
        $checkDataValid = $this->validateData($request->all(), $rules);
        if ($checkDataValid) {
            return $this->jsonResponse(422, __('general::lang.wrongData'), $checkDataValid, null);
        }

        /**
         * We Use ( LIKE ) in query to solve ( + sign ) issue in fron of Phone Number when send GET Request
         * instead of that we can convert GET to POST
         */
        // $customer = Customer::where('customers_phone', 'LIKE', '%'. $request->phone. '%')->first();

        // for Separate the code from the mobile number
        $customer = Customer::where('customers_phone', $request->phone )->where('customers_country_code','LIKE', '%'.$request->country_code. '%')->first();
        if ($customer) {
            return $this->jsonResponse(200, __('general::lang.phoneExist'), [__('general::lang.phoneExist')], ['does_exist'=>true]);
        }

        // Phone Doesn't Exist
        return $this->jsonResponse(200, __('general::lang.phoneNotExist'), [], ['does_exist'=>false]);

    }

    /**
     * Check phone Number is Exist
     * @param  Request $request credential
     * @return json
     */
    public function checkEmailExist(Request $request)
    {
        $rules = array(
            'email' => 'required|email',
        );
        // Check if Data Valid or Not
        $checkDataValid = $this->validateData($request->all(), $rules);
        if ($checkDataValid) {
            return $this->jsonResponse(422, __('general::lang.wrongData'), $checkDataValid, null);
        }

        $customer = Customer::where('customers_email', $request->email )->first();
        if ($customer) {
            return $this->jsonResponse(200, __('general::lang.emailExist'), [__('general::lang.emailExist')], ['does_exist'=>true]);
        }
        // Email Doesn't Exist
        return $this->jsonResponse(200, __('general::lang.emailNotExist'), [], ['does_exist'=>false]);

    }

    /**
     * register
     * @param  Request $request credential
     * @return json
     */
    public function checkVerifyCode(Request $request)
    {
        $request['customers_phone']  = str_replace(' ', '', $request->customers_phone );
        $rules = array(
            'phone'     => 'required_if:auth_type,phone|numeric',
            'email'     => 'required_if:auth_type,email|email',
            'auth_type'      => 'required|in:phone,email',
            'verify_code' => 'required',
        );

        // Check if Data Valid or Not
        $checkDataValid = $this->validateData($request->all(), $rules);
        if ($checkDataValid) {
            return $this->jsonResponse(422, __('general::lang.wrongData'), $checkDataValid, null);
        }
        $field = request($request->auth_type);
        $is_verify = PasswordReset::where('email',$field)->where('token',$request->verify_code)->first();
        if($is_verify){
            PasswordReset::where('email',$field)->where('token',$request->verify_code)->delete();
            return $this->jsonResponse(200, __('general::lang.verifyCodeValid'), null,null);
        }else{
            $checkDataValid = [];
            $checkDataValid[] = __('general::lang.verifyCodeInvalid') ;
            return $this->jsonResponse(422, __('general::lang.verifyCodeInvalid'), $checkDataValid, null);
        }

    }

    /**
     * register
     * @param  Request $request credential
     * @return json
     */
    public function register(Request $request)
    {

        $request['customers_phone']  = str_replace(' ', '', $request->customers_phone );
        $rules = array(
            'customers_name' => 'required',
            'customers_country_code' => 'required_if:auth_type,phone',
            'customers_email' => 'required_if:auth_type,email|email|unique:mysql.customers,customers_email,null,customers_id',
            'customers_phone' => 'required_if:auth_type,phone|numeric|unique:mysql.customers,customers_phone,null,customers_id',
            'password' => 'required|min:6',
            'customers_birthdate' => 'nullable|date',
            'customers_gender' => 'nullable|string|max:50',
            'device_token' => 'required',
            // 'cities_id' => 'required',
            'auth_type'      => 'required|in:phone,email',
        );
        // Check if Data Valid or Not
        $checkDataValid = $this->validateData($request->all(), $rules);
        if ($checkDataValid) {
            return $this->jsonResponse(422, __('general::lang.wrongData'), $checkDataValid, null);
        }

        $city = City::find($request->cities_id);
        if($city){
            $request['countries_id'] = $city->countries_id ;
        }
        if($request->auth_type == 'phone'){
            $request['phone_verified'] = '1';
        }else{
            $request['email_verified'] = '1';
        }
        // Create New Customer
        $customer = Customer::create($request->all());

        // Send Activation Mail
        if($customer->customers_email && $request->auth_type == 'email')
        {
            $activationCode = $request['email_verification_code'] = sha1(time());
            Mail::to($customer->customers_email)->send(new ActiveMail($customer, $activationCode));
        }

        $customer = Customer::find($customer->customers_id);

        // Login the customer
         Auth::login($customer);
        // Generate Token
        $token = $this->generateAccessToken($request, $customer);

        return $this->jsonResponse(200, __('general::lang.registerSuccess'), null, compact('customer', 'token'));
    }


    /**
     * login
     * @param  Request $request credential
     * @return json
     */
    public function login(Request $request)
    {
        $request['customers_phone']  = str_replace(' ', '', $request->phone );
        $rules = [
            'customers_phone'     => 'required_if:auth_type,phone|numeric',
            'customers_email'     => 'required_if:auth_type,email|email',
            'customers_country_code' => 'required_if:auth_type,phone',
            'auth_type'      => 'required|in:phone,email',
            'password' => 'required',
            'device_token' => 'required',
        ];

        // Check if Data Valid or Not
        $checkDataValid = $this->validateData($request->all(), $rules);
        if ($checkDataValid) {
            return $this->jsonResponse(422, __('general::lang.wrongData'), $checkDataValid, null);
        }

        // Credential
        $password = $request->password;

        if($request->auth_type == 'phone'){
            $customer = Customer::where('customers_phone', $request->customers_phone )->where('customers_country_code','LIKE', '%'.$request->customers_country_code. '%')->first();
        }else{
            $customer = Customer::where('customers_email', $request->customers_email)->first();
        }

        if (!$customer || !Hash::check($password, $customer->password)) {
            if($request->auth_type == 'phone'){
                $msg = __('general::lang.wrongPhonePassword');
            }else{
                $msg = __('general::lang.wrongEmailPassword');
            }

            return $this->jsonResponse(422, $msg, [$msg], null);
        }

        // Check if Customer Account Stopped or Active
        if ($customer->customers_status == '0') {
            return $this->jsonResponse(422, __('general::lang.accountStopped'), [__('general::lang.accountStopped')], null);
        }
        $customer->tokens()->delete(); // to logout all other devices
        // Login the customer
        Auth::login($customer);

        // Generate Token
        $token = $this->generateAccessToken($request, $customer);
        // $token =$customer->createToken('API Token')->accessToken;
        // return $customer ;
        // Update Device Token
        $customer->device_token = $request->device_token;
        $customer->save();

        // Check if Customer Email is Not Active
        // if ($customer->email_verified == '0') {
        //     return $this->jsonResponse(200, __('general::lang.emailNoVerified'), null, compact('customer', 'token'));
        // }

        return $this->jsonResponse(200, __('general::lang.loginSuccess'), null, compact('customer', 'token'));

    }


    /**
     * logout
     * @param  Request $request credential
     * @return json
     */
    public function logout(Request $request)
    {
        if($request->user('customer')){
            $customer = $request->user('customer');
            $customer->device_token = null;
            $customer->save();
        }

        $request->user('customer')->tokens()->delete();

        return $this->jsonResponse(200, __('general::lang.logoutSuccess'), null, null);
    }

    /**
     * forgotPasswordEmail
     *
     * @param  Request $request
     * @return json
     */
    public function forgotPasswordEmail(Request $request)
    {

        $rules = [
            'customers_email' => 'required|email',
        ];

        // Check if Data Valid or Not
        $checkDataValid = $this->validateData($request->all(), $rules);
        if ($checkDataValid) {
            return $this->jsonResponse(422, __('general::lang.wrongData'), $checkDataValid, null);
        }

        $customer = Customer::where('customers_email', $request->customers_email)->first();

        if ($customer) {

            // Generate New Password
            $password = Str::random(12);
            $customer->update(['password' => $password]);

            $to = $customer->customers_email;

            Mail::to($to)->send(new ForgetPassword($customer, $password));

            return $this->jsonResponse(200, __('general::lang.passwordMailSent'), null, compact('customer'));

        } else {
            // Wrong Email
            return $this->jsonResponse(422, __('general::lang.wrongEmail'), [__('general::lang.wrongEmail')], null);
        }

    }

    /**
     * changePassword
     *
     * @param  Request $request
     * @return json
     */
    public function changePassword(Request $request)
    {

        $customer = Customer::find($request->user('customer')->customers_id) ;
        $rules = [
            'old_password' => 'nullable',
            'new_password' => 'required|min:6',
        ];
        if($customer->password){
            $rules['old_password'] = 'required';
        }
        // Check if Data Valid or Not
        $checkDataValid = $this->validateData($request->all(), $rules);
        if ($checkDataValid) {
            return $this->jsonResponse(422, __('general::lang.wrongData'), $checkDataValid, null);
        }

        // if old password is wrong
        if ($customer->password && !Hash::check($request->old_password, $customer->password)) {
            return $this->jsonResponse(422, __('general::lang.wrongOldPassword'), [__('general::lang.wrongOldPassword')], null);
        }

        // Update Password
        $customer->update(['password' => $request->new_password]);

        // Logout the customer
        $request->user('customer')->token()->revoke();

        // Generate Token
        $token = $this->generateAccessToken($request, $customer);

        return $this->jsonResponse(200, __('general::lang.changePassword'), null, compact('customer','token'));
    }

    /**
     * Update Password
     *
     * @param  Request $request
     * @return json
     */
    public function forgotPassword(Request $request)
    {
        $request['phone']  = str_replace(' ', '', $request->phone );

        $rules = [
            'customers_phone'     => 'required_if:auth_type,phone|numeric|exists:mysql.customers,customers_phone',
            'customers_email'     => 'required_if:auth_type,email|email|exists:mysql.customers,customers_email',
            'customers_country_code' => 'required_if:auth_type,phone',
            'auth_type'      => 'required|in:phone,email',
            'password' => 'required|min:6',
        ];

        // Check if Data Valid or Not
        $checkDataValid = $this->validateData($request->all(), $rules);
        if ($checkDataValid) {
            return $this->jsonResponse(422, __('general::lang.wrongData'), $checkDataValid, null);
        }
        $field = request($request->auth_type);
        if($request->auth_type == 'phone'){
            $customer = Customer::where('customers_phone', $request->customers_phone)->where('customers_country_code','LIKE', '%'.$request->customers_country_code. '%')->first();
        }else{
            $customer = Customer::where('customers_email', $request->customers_email)->first();
        }

        if ($customer) {
            $customer->password = $request->password;
            $customer->save();
            return $this->jsonResponse(200, __('general::lang.changePassword'), null, compact('customer'));
        }

        return $this->jsonResponse(422, __('general::lang.wrongData'), [__('general::lang.wrongData')], null);

    }

     /**
     * Update Password
     *
     * @param  Request $request
     * @return json
     */
    public function forgotPasswordMobile(Request $request)
    {
        $request['customers_phone']  = str_replace(' ', '', $request->customers_phone );

        $rules = [
            'customers_phone' => 'required',
            'customers_country_code' => 'required',
            'password' => 'required|min:6',
        ];

        // Check if Data Valid or Not
        $checkDataValid = $this->validateData($request->all(), $rules);
        if ($checkDataValid) {
            return $this->jsonResponse(422, __('general::lang.wrongData'), $checkDataValid, null);
        }

        $customer = Customer::where('customers_phone', $request->customers_phone)->where('customers_country_code','LIKE', '%'.$request->customers_country_code. '%')->first();
        if ($customer) {

            $customer->password = $request->password;
            $customer->save();

            return $this->jsonResponse(200, __('general::lang.changePassword'), null, compact('customer'));
        }

        return $this->jsonResponse(422, __('general::lang.wrongPhone'), [__('general::lang.wrongPhone')], null);

    }

    /**
     * Customer Update
     * @param  Request $request credential
     * @return json
     */
    public function customerUpdate(Request $request)
    {
        $request['customers_phone']  = str_replace(' ', '', $request->customers_phone );

        // Get the customer
        $customer = Customer::find($request->user('customer')->customers_id) ;

        $rules = [
            'customers_name'         => 'required',
            'customers_country_code' => 'required_if:auth_type,phone',
            'customers_email'        => 'required_if:auth_type,email|email|unique:mysql.customers,customers_email,'. $customer->customers_id .',customers_id',
            'customers_phone'        => 'required_if:auth_type,phone|numeric|unique:mysql.customers,customers_phone,'. $customer->customers_id .',customers_id',
            'customers_birthday'     => 'nullable|date',
            'customers_gender'       => 'nullable|string|max:50',
            'auth_type'              => 'required|in:phone,email',
        ];

        // Check if Data Valid or Not
        $checkDataValid = $this->validateData($request->all(), $rules);
        if ($checkDataValid) {
            return $this->jsonResponse(422, __('general::lang.wrongData'), $checkDataValid, null);
        }
        // Update the customer Data
        if($customer->customers_email != $request->customers_email){
            $customer->email_verified = '0' ;
            $customer->save();
        }
        if( $customer->email_verified == '0' && $request->send_verification_code)
        {
            $activationCode = $request['email_verification_code'] = sha1(time());
        }

        $customer->update($request->all());

        if( $customer->email_verified == '0' && $request->send_verification_code)
        {
          Mail::to($customer->customers_email)->send(new ActiveMail($customer, $activationCode));
        }

        return $this->jsonResponse(200, __('general::lang.customerUpdate'), null, compact('customer'));
    }

    /**
     * Customer Update
     * @param  Request $request credential
     * @return json
     */
    public function customerData(Request $request)
    {

        // Get the customer
        $customer = $request->user('customer');
        $customer = Customer::find($customer->customers_id);

        return $this->jsonResponse(200, __('general::lang.customerUpdate'), null, compact('customer'));
    }

    /**
     * Get Customer Delivery Addresses
     * @param  Request $request credential
     * @return json
     */
    public function getCustomerNotification(Request $request)
    {
        // Get the customer
        $customer = Customer::find($request->user('customer')->customers_id) ;
        // $customers_id = $customer->customers_id ;

        if($request->unread && $request->unread == true){//return unread notifications
            $pagination = $request->user('customer')->unreadNotifications()->select('id','data','read_at','created_at')->paginate($this->perPage())->toArray();
        }else{ //return all notifications
            $pagination = $request->user('customer')->notifications()->select('id','data','read_at','created_at')->paginate($this->perPage())->toArray();
        }
        // Get Pagination Data in Array Separately
        $data = $pagination['data'];
        // Remove From Source
        unset($pagination['data']);

        // Assign Data to new Variable
        $notifications = $data;

        // $notifications = Notification::with('customers')->get();

        return $this->jsonResponse(200, __('general::lang.doneSuccessfully'), null, compact('notifications','pagination'));
    }

    /**
     * Get Customer Delivery Addresses
     * @param  Request $request credential
     * @return json
     */
    public function readCustomerNotification(Request $request,$notifications_id)
    {
        // Get the customer
        $customer = Customer::find($request->user('customer')->customers_id) ;

        // $notification = NotificationCustomer::where('notifications_id',$notifications_id)->where('customers_id',$customer->customers_id)->first() ;
        // if($notification){
        //     $notification->read_at = now();
        //     $notification->save();
        // }
        // $notification = $notifications_id ;
        return $this->jsonResponse(200, __('general::lang.doneSuccessfully'), null, compact('notification'));
    }

     /**
     * Get Customer Delivery Addresses
     * @param  Request $request credential
     * @return json
     */
    public function readAllCustomerNotification(Request $request)
    {
        // Get the customer
        $customer = Customer::find($request->user('customer')->customers_id) ;

        // $notifications = NotificationCustomer::where('customers_id',$customer->customers_id)->get() ;
        // foreach($notifications as $notification){
        //     $notification->read_at = now();
        //     $notification->save();
        // }
        foreach($request->user('customer')->unreadNotifications as $note){
            $note->markAsRead();
        }
        // $notification = $notifications_id ;
        return $this->jsonResponse(200, __('general::lang.customerUpdate'), null, []);
    }

    public function activeMail(Request $request)
    {
        $customers = Customer::where('email_verification_code', $request->code)->update(['email_verified'	=>	'1']);
        if (!$customers) {
            return $this->jsonResponse(422, __('general::lang.activation_email_error'), null, null);
        }
        return $this->jsonResponse(200, __('general::lang.activation_email_success'), null, null);

    }


    /**
     * [generateAccessToken Data]
     * @param  Request $request [description]
     * @param  Model   $customer   [description]
     * @return [type]           [description]
     */
    private function generateAccessToken(Request $request, Customer $customer): array
    {
        $tokenResult = $customer->createToken(env('APP_NAME','test'));
        // dd($tokenResult) ;
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(52);
        }

        $token->save();

        return [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $token->expires_at
            )->toDateTimeString()
        ];
    }

}
