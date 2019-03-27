<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payzippy
{
	var $CI;
	
	//this can be used in several places
	var	$method_name;
	
	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->lang->load('payzippy');		
		$this->method_name  = lang('payzippy_solutions');
	}
	
	
	//these are the front end form and check functions
	public function checkout_form($post = false)
	{
		$settings	= $this->CI->Settings_model->get_settings('payzippy');
		$enabled	= $settings['enabled'];

		$cc_data = $this->CI->session->userdata('cc_data');
		
		$form			= array();
		if($enabled == 1)
		{
			$form['name']	= $this->method_name;
                        
                        if ($settings['mode'] == 'PAYZIPPY') {
                            $form['form']	= $this->CI->load->view('payzippy_redirect_checkout', array('cc_data'=>$cc_data), true);
                        } else {
                            $form['form']	= $this->CI->load->view('payzippy_iframe_checkout', array('cc_data'=>$cc_data), true);
                        }
			
		}
		
		return $form;
	}
	public function checkout_check()
	{
		$cc_tmp_data["cc_data"] = $_POST;
                $this->CI->session->set_userdata($cc_tmp_data);
		
		//if all is well, return false, otherwise, return an error message
		return false;
	}
	
	public function description()
	{
		$cc_data = $this->CI->session->userdata('cc_data');

		return 'Payzippy Payment Gateway';
	}
	
	//back end installation functions
	public function install()
	{
		$settings['enabled'] = '1';
		$settings['mode'] = 'PAYZIPPY';
		$settings['MERCHANT_ID'] = '';
		$settings['SECRET_KEY'] = '';
		$settings['TRANSACTION_TYPE'] = '';
                $settings['CURRENCY'] = '';
                $settings['UI_MODE'] = '';
                $settings['HASH_METHOD'] = '';
                $settings['MERCHANT_KEY_ID'] = '';
                $settings['CALLBACK_URL'] = '';
                
                $settings['API_BASE'] = '';
                $settings['API_CHARGING'] = '';
                $settings['API_QUERY'] = '';
                $settings['API_REFUND'] = '';
                $settings['API_VERSION'] = '';
                $settings['VERIFY_SSL_CERTS'] = '';               
                $settings['RETRY_ON_SALE_FAILURE'] = '';
                $settings['RETRY_ON_REFUND_FAILURE'] = '';

		//set a default blank setting for flatrate shipping
		$this->CI->Settings_model->save_settings('payzippy', $settings);
                
	}
	
	public function uninstall()
	{
		$this->CI->Settings_model->delete_settings('payzippy');
	}
        
	//admin end form and check functions
	public function form($post	= false)
	{
		//this same function processes the form
		if(!$post)
		{
			$settings = $this->CI->Settings_model->get_settings('payzippy');
			$data['settings']['enabled']            = $settings['enabled'];
			$data['settings']['mode']               = $settings['mode'];
			$data['settings']['MERCHANT_ID']	= $settings['MERCHANT_ID'];
			$data['settings']['SECRET_KEY']         = $settings['SECRET_KEY'];
			$data['settings']['TRANSACTION_TYPE']	= $settings['TRANSACTION_TYPE'];
			$data['settings']['CURRENCY']           = $settings['CURRENCY'];
			$data['settings']['UI_MODE']            = $settings['UI_MODE'];
			$data['settings']['HASH_METHOD']	= $settings['HASH_METHOD'];
			$data['settings']['MERCHANT_KEY_ID']	= $settings['MERCHANT_KEY_ID'];
			$data['settings']['CALLBACK_URL']	= $settings['CALLBACK_URL'];
                        
			$data['settings']['API_BASE']           = $settings['API_BASE'];
			$data['settings']['API_CHARGING']	= $settings['API_CHARGING'];
			$data['settings']['API_QUERY']          = $settings['API_QUERY'];
			$data['settings']['API_REFUND'] 	= $settings['API_REFUND'];
			$data['settings']['API_VERSION']	= $settings['API_VERSION'];
			$data['settings']['VERIFY_SSL_CERTS']	= $settings['VERIFY_SSL_CERTS'];
			$data['settings']['RETRY_ON_SALE_FAILURE']	= $settings['RETRY_ON_SALE_FAILURE'];
                        $data['settings']['RETRY_ON_REFUND_FAILURE']	= $settings['RETRY_ON_REFUND_FAILURE'];

		}
		else
		{
			$data['settings']['enabled']            = $post['enabled'];
			$data['settings']['mode']               = $post['mode'];
			$data['settings']['MERCHANT_ID']	= $post['MERCHANT_ID'];
			$data['settings']['SECRET_KEY']         = $post['SECRET_KEY'];
			$data['settings']['TRANSACTION_TYPE']	= $post['TRANSACTION_TYPE'];
			$data['settings']['CURRENCY']           = $post['CURRENCY'];
			$data['settings']['UI_MODE']            = $post['UI_MODE'];
			$data['settings']['HASH_METHOD']	= $post['HASH_METHOD'];
			$data['settings']['MERCHANT_KEY_ID']	= $post['MERCHANT_KEY_ID'];
			$data['settings']['CALLBACK_URL']	= $post['CALLBACK_URL'];
                        
                        $data['settings']['API_BASE']           = $post['API_BASE'];
                        $data['settings']['API_CHARGING']	= $post['API_CHARGING'];
                        $data['settings']['API_QUERY']          = $post['API_QUERY'];
                        $data['settings']['API_REFUND']         = $post['API_REFUND'];
                        $data['settings']['API_VERSION']	= $post['API_VERSION'];
                        $data['settings']['VERIFY_SSL_CERTS']	= $post['VERIFY_SSL_CERTS'];
                        $data['settings']['RETRY_ON_SALE_FAILURE']	= $post['RETRY_ON_SALE_FAILURE'];
                        $data['settings']['RETRY_ON_REFUND_FAILURE']	= $post['RETRY_ON_REFUND_FAILURE'];
		}
		
		return $this->CI->load->view('admin_form', $data, true);
	}
	
	public function check()
	{	
		
		$settings['enabled']            = $this->CI->input->post('enabled');
		$settings['mode']               = $this->CI->input->post('mode');
		$settings['MERCHANT_ID'] 	= $this->CI->input->post('MERCHANT_ID');
		$settings['SECRET_KEY'] 	= $this->CI->input->post('SECRET_KEY');
		$settings['TRANSACTION_TYPE']   = $this->CI->input->post('TRANSACTION_TYPE');
		$settings['CURRENCY']           = $this->CI->input->post('CURRENCY');
		$settings['UI_MODE']            = $this->CI->input->post('UI_MODE');
		$settings['HASH_METHOD']        = $this->CI->input->post('HASH_METHOD');
		$settings['MERCHANT_KEY_ID']    = $this->CI->input->post('MERCHANT_KEY_ID');
		$settings['CALLBACK_URL']       = $this->CI->input->post('CALLBACK_URL');
                
		$settings['API_BASE']           = $this->CI->input->post('API_BASE');
		$settings['API_CHARGING']       = $this->CI->input->post('API_CHARGING');
		$settings['API_QUERY']          = $this->CI->input->post('API_QUERY');
		$settings['API_REFUND']         = $this->CI->input->post('API_REFUND');
		$settings['API_VERSION']        = $this->CI->input->post('API_VERSION');
		$settings['VERIFY_SSL_CERTS']   = $this->CI->input->post('VERIFY_SSL_CERTS');
		$settings['RETRY_ON_SALE_FAILURE']   = $this->CI->input->post('RETRY_ON_SALE_FAILURE');
                $settings['RETRY_ON_REFUND_FAILURE'] = $this->CI->input->post('RETRY_ON_REFUND_FAILURE');

		//we save the settings if it gets here
		$this->CI->Settings_model->save_settings('payzippy', $settings);
                
                // write data to payzippy config file
                
                $settings = $this->CI->Settings_model->get_settings('payzippy');
                $data = $this->CI->load->view('create_config', array('settings'=>$settings), true);
                $file_path = './gocart/packages/payment/payzippy/libraries/PZ_Config.php';
                write_file($file_path, $data);
		
		return false;
	}
        
        /**************************************************************************************************************************************
         * Create the payment request and process the response from payzippy.
         * @return boolean
         */
	public function process_payment()
	{   
            $settings = $this->CI->Settings_model->get_settings('payzippy');
            date_default_timezone_set('Asia/Kolkata');
            $post_data = $this->CI->input->post();
            
            /**************debug: Save post data as xml for debugging**************************/
            if($post_data) {
                $file_prefix = TRANSCODE.'_sale'.'_resp_';
                $file_loc = './gocart/packages/payment/payzippy/postdata/sale/';
                $saved_xml_sts = $this->build_xml($post_data, $file_prefix, $file_loc);

                if($saved_xml_sts) {
                    $msg = 'PayZippy Sale Post Data recieved was saved on: '.date('Y-m-d H:i:s').' successfully.';
                    log_message('info', $msg);
                } else {
                    $msg = 'PayZippy Sale Post Data recieved was not saved on: '.date('Y-m-d H:i:s').' successfully.';
                    log_message('error', $msg);
                }
            }
            // start post processing
            if (empty($post_data['merchant_transaction_id'])) 
            {
                
                /******************************Create Charging Request and send back the charging object with response of creation *********/
                
                $charging_object = $this->_pz_charging_req($settings);
                
                /*****************************Save xml for request object**************************************/
                $file_prefix = TRANSCODE.'_sale'.'_req_';
                $file_loc = './gocart/packages/payment/payzippy/postdata/sale/';
                $saved_xml_sts = $this->build_xml($charging_object['params'], $file_prefix, $file_loc);

                if($saved_xml_sts) {
                    $msg = 'PayZippy charging request was saved on: '.date('Y-m-d H:i:s').' successfully.';
                    log_message('info', $msg);
                } else {
                    $msg = 'PayZippy charging request was not saved on: '.date('Y-m-d H:i:s').' successfully.';
                    log_message('error', $msg);
                }
                
                /******************************* Handle Charging Response ************************************/
                if($charging_object["url"] != '' && $charging_object["status"] == "OK") {

                    /*********************** Process the payment on the gateway **********************/
                    // below line processes the payment and then to recieve the response from the gateway 
                    // -we make the transaction die, so that the call back url from the pmt gateway can be correctly
                    // return to this function itself within the $post_data and that is handled in the second else below.
                    
                    echo $this->CI->load->view('inc/header_view', array('charging_object' => $charging_object),TRUE);
                    echo $this->CI->load->view('inc/navbar_view','',TRUE);
                    echo $this->CI->load->view('inc/saying_view','',TRUE);
                    echo $this->CI->load->view('process_pmts','',TRUE);
                    echo $this->CI->load->view('inc/footer_sub_view','',TRUE);
                    echo $this->CI->load->view('inc/footer_view','',TRUE);
                    die();

                } else {
                    // if there were problems creating the request object - show the creation errors on Step 3
                    return $charging_object["error_message"];
                }    
            } 
            else {
                
                if ($this->_pz_charging_res($post_data)) {
                    $pz_data['transaction_status'] = $this->CI->input->post('transaction_status');                        
                    $this->CI->session->set_userdata($pz_data);

                    // save payzippy_transaction_id to tracker db                   
                    $saved_rows = $this->_update_pz_tracker(null,$post_data, null);
                    $to = ADMIN_EMAIL;
                    $from = ADMIN_EMAIL;
    //                Debug - start
    //                echo '<pre>';
    //                print_r($this->CI->session->all_userdata());
    //                
    //                print_r($this->CI->input->post());
    //                echo '</pre>';
    //                Debug - end
                    
                    // Process the transaction response from payzippy
                    switch ($post_data['transaction_status']) {
                        case 'SUCCESS':
                            if($saved_rows > 0) {
                                return FALSE;
                            } else {
                                $user_msg = 
                                        'Sorry ! There was a problem with creating the order for your items with Transaction ID : '
                                        . $post_data['merchant_transaction_id'] 
                                        .' However, do not panic we will have one of our advisors call you within 24 hours to resolve the problem with the order !' 
                                        .' Your card card has been charged however, it may take us an extra 24 hours to process the payment and have the order shipped out to you.'
                                        .' Sorry for the inconvienience caused. Please contact us at our helpline if you would like to reach out to us. Thank You !'
                                        ;
                            }
                            //e-mail administrator that hash response does not match
                            $this->CI->load->helper('generic_email_helper');
                            
                            $subject = 'Problem saving data to Payzippy Tracker Detected:'.' with Transaction ID : '.$post_data['merchant_transaction_id'];
                            email_html($to, $from , $subject, $user_msg);        
                            return $user_msg;
                            break;
                        case 'FAILED':
                            if($saved_rows > 0) {
                            // Check RETRY_ON_SALE_FAILURE is TRUE and if yes initiate a new transaction based on setting value
                                if($settings['RETRY_ON_SALE_FAILURE'] == 'TRUE') {
                                    // load a modal box to to submit the same transaction with timegmt set in it
                                    $resp_data = array('merchant_transaction_id'        => $post_data['merchant_transaction_id'],
                                                        'transaction_currency'          => $post_data['transaction_currency'],
                                                        'transaction_status'            => $post_data['transaction_status'],
                                                        'transaction_response_message'  => $post_data['transaction_response_message'],
                                                        'transaction_amount'            => $post_data['transaction_amount']
                                                    );

                                    echo $this->CI->load->view('confirm_retry', array('resp_data' => $resp_data), TRUE);
                                    die();
                                }
                                else {
                                         
                                    $user_msg =
                                        'Sorry ! Your previous transaction of '
                                        . $post_data['transaction_currency']
                                        . '.'
                                        . $post_data['transaction_amount']/100
                                        . '/-'
                                        .' with Transaction ID : '
                                        . $post_data['merchant_transaction_id'] 
                                        .' has Failed !' 
                                        .' Your card has not been charged. The Gateway response was : '
                                        . $post_data['transaction_response_message'] 
                                        .' .Sorry for the inconvienience caused.'
                                        .' Please correct the details required and then try again. Alternatively,'
                                        .' please contact us at our helpline ' 
                                        . WEBPHONE 
                                        .' if you would like to reach out to us and place the order again. Thank You !'
                                        ;
                                }                          
                            }
                            //e-mail administrator that hash response does not match
                            $this->CI->load->helper('generic_email_helper');
                            
                            $subject = 'Failed Payzippy Sale Detected with Transaction ID : '.$post_data['merchant_transaction_id'];
                            email_html($to, $from , $subject, $user_msg);
                            
                            return $user_msg;
                            break;
                        case 'PENDING':
                            if(saved_rows > 0) {
                                
                                $user_msg = 'Sorry ! Your previous transaction of '
                                            . $post_data['transaction_currency']
                                            . '.'
                                            . $post_data['transaction_amount']/100
                                            . '/-'
                                            .' with Transaction ID : '
                                            . $post_data['merchant_transaction_id'] 
                                            .' is in PENDING Status.' 
                                            .'Do not panic we will have one of our advisors call you within 24 hours to resolve the problem with the order.' 
                                            .' If your payment has been charged to your account, it may take us an extra 24 hours to process the payment and have the order shipped out to you.'
                                            .' Sorry for the inconvienience caused. Please contact us at our helpline if you would like to reach out to us. Thank You !'
                                            ;
                            }
                            //e-mail administrator that hash response does not match
                            $this->CI->load->helper('generic_email_helper');
                            
                            $subject = 'Pending Payzippy Sale Detected with Transaction ID : '.$post_data['merchant_transaction_id'];
                            email_html($to, $from , $subject, $user_msg);
                            
                            return $user_msg;
                            break;
                        default:
                            //in all cases if fraud_action is review / reject / no action keep the details of the ip, transaction date/time etc and customer id mapped to db
                            // future to capture fraud statuses
                            $user_msg = 'Sorry ! Your previous transaction of '
                                            . $post_data['transaction_currency']
                                            . '.'
                                            . $post_data['transaction_amount']/100
                                            . '/-'
                                            .' with Transaction ID : '
                                            . $post_data['merchant_transaction_id'] 
                                            .' has been detected as a fraud and has not been APPROVED.' 
                                            .' Do not panic we will have one of our advisors call you within 24 hours to resolve the problem with the order.' 
                                            .' Your IP Details and Geo Location data have been detected and recorded. Your details will be investigated for Fraudulent activity in our records.'
                                            ;

                            // create log entry
                            $msg = 'Payzippy Fraud Activity was noticed for: '. $post_data['merchant_transaction_id'];
                            log_message('error', $msg); 

                            //e-mail administrator that hash response does not match
                            $this->CI->load->helper('generic_email_helper');
                            
                            $subject = 'PayZippy Fraud Detected with Transaction ID : '.$post_data['merchant_transaction_id'];
                            email_html($to, $from , $subject, $user_msg);
                            return $user_msg;
                    } 
                }
            }
            // end of processing
        }       
        
        /**************************************************************************************************************************************
         * processing post response recieved from the pazippy payment gateway
         * @param type $dets
         */
        public function complete_payment($dets) {

            $resp_data['merchant_transaction_id'] = $this->CI->session->userdata('merchant_transaction_id');
            $resp_data['transaction_status'] = $this->CI->session->userdata('transaction_status');
            if($resp_data['transaction_status'] != 'SUCCESS') {
                $resp_data['timegmt'] = $this->CI->session->userdata('timegmt');
            } else {
                $this->CI->session->unset_userdata('timegmt');
            }
            
            // update order id to tracker table on SUCCESS
            $save_rows = $this->_update_pz_tracker(null,$resp_data,$dets['order_id']);
            if ($save_rows > 0) {
                // write to a log stating that the record was deleted
                $msg = 'PayZippy Processing status for order id: '.$dets['order_id'].' was saved successfully.';
                log_message('info', $msg);
                $this->CI->session->unset_userdata('merchant_transaction_id');
                $this->CI->session->unset_userdata('computed_hash_req');
                $this->CI->session->unset_userdata('transaction_status');
                $this->CI->session->unset_userdata('is_logged');
                $this->CI->session->unset_userdata('cc_data');
            }
        }
               
        /**************************************************************************************************************************************
         * Create and return payzippy charging request
         * @param type $settings
         * @param type $prev_merchant_transaction_id
         * @return type
         */
        private function _pz_charging_req($settings) {
                
                //start with new payment process
                $customer = $this->CI->go_cart->customer();

                // Load the global classes
                require APPPATH."packages/payment/payzippy/libraries/PZ_Config.php";
                require APPPATH."packages/payment/payzippy/libraries/PZ_Constants.php";
                require APPPATH."packages/payment/payzippy/libraries/PZ_Utils.php";
                require APPPATH."packages/payment/payzippy/libraries/ChargingRequest.php";
                
                //start preparing load params for charging object
                $send_req['buyer_email_address'] = $customer['email'];

                // currency 
                $send_req['transaction_currency'] = PZ_Config::CURRENCY;
                
                // pz transaction amount conversion to paise from float type to int
                $pz_trans_amt = (int)($this->CI->go_cart->total() * 100);
                $send_req['transaction_amount'] = $pz_trans_amt;

                // payment method code - NET, Credit, Debit type
                if(!empty($cc_data['pz_bank_name']) && $cc_data['pz_bank_name'] != 'Select Your Bank') {
                    $send_req['payment_method'] = 'NET';
                    $this->CI->load->model('payzippy_bank_ref_model');
                    $bank_data = $this->CI->payzippy_bank_ref_model->get(array('bank_name' => $cc_data['pz_bank_name']));
                    $send_req['bank_name'] = $bank_data[0]['bank_code'];
                } elseif (!empty($cc_data['pz_credit_cart_type'])){
                    $send_req['payment_method'] = 'CREDIT';
                }elseif (!empty($cc_data['pz_debit_cart_type'])){
                    $send_req['payment_method'] = 'DEBIT';
                }else {
                    $send_req['payment_method'] = 'PAYZIPPY';
                    $send_req['bank_name'] = 'ICICI';
                }

                $send_req['ui_mode'] = PZ_Config::UI_MODE;

                // get the server ip to which the return response will be recieved

                //keep only one of the below lines
                $server_ip = '182.69.40.120';
//                $server_ip = $this->CI->input->server('SERVER_ADDR');
                $send_req["callback_url"] = 'http://'.$server_ip.'/checkout/place_order';
    

                $send_req['buyer_phone_no'] = $customer['phone'];

                // shipping details
                $send_req['shipping_address'] = $customer['ship_address']['address1'].' '. $customer['ship_address']['address2'];
                $send_req['shipping_city'] = $customer['ship_address']['city'];
                // get the shipping state from the city provided
                if (!empty($send_req['shipping_city'])) {
                    $this->CI->load->model('city_state_model');
                    $state = $this->CI->city_state_model->get(array('city_name' => $send_req['shipping_city']));
                    $send_req['shipping_state'] = $state[0]['state_name'];
                } else {
                    $send_req['shipping_state'] = '';
                }
                $send_req['shipping_zip'] = $customer['ship_address']['zip'];
                $send_req['shipping_country'] = $customer['ship_address']['country'];

                // billing details
                $send_req['billing_name'] = $customer['bill_address']['firstname'].' '. $customer['bill_address']['lastname'];
                $send_req['billing_address'] = $customer['bill_address']['address1'].' '. $customer['bill_address']['address2'];
                $send_req['billing_city'] = $customer['bill_address']['city'];
                // get the billing state from the city provided
                if (!empty($send_req['billing_city'])) {
                    $this->CI->load->model('city_state_model');
                    $state = $this->CI->city_state_model->get(array('city_name' => $send_req['billing_city']));
                    $send_req['billing_state'] = $state[0]['state_name'];
                } else {
                    $send_req['billing_state'] = '';
                }
                $send_req['billing_zip'] = $customer['bill_address']['zip'];
                $send_req['billing_country'] = $customer['bill_address']['country'];
                
                //Generate uniquie merchant transaction id only if this is a new charging request, 
                //incase its retry use the old merchant transaction id.
                $old_merchant_transaction_id = $this->CI->session->userdata('merchant_transaction_id');
                
                if($settings['RETRY_ON_SALE_FAILURE'] == 'TRUE' && $old_merchant_transaction_id) {
                    $send_req['merchant_transaction_id'] = $old_merchant_transaction_id;
                    // also create new timegmt parameter to send the req again with the same merchant transaction id, in milliseconds
                    $timegmt_requested = 'Y';
                } else {
                    $send_req['merchant_transaction_id'] = $this->_update_pz_tracker($send_req);
                    $timegmt_requested = 'N';
                }                
                
                $logged_sts = $this->_logged_in() ? TRUE: FALSE;
                $send_req['is_user_logged_in'] = $logged_sts;
                
                if ($logged_sts) {
                    // customer id
                    $send_req['buyer_unique_id'] = $customer['id'];
                }
             
                // save data to session
                $pz_data['merchant_transaction_id'] = $send_req['merchant_transaction_id'];
                $pz_data['is_logged'] = $logged_sts;
                
                /**************************** Transaction Object *****************************/
                // Get a new instance of ChargingRequest.
                $pz_charging = new ChargingRequest();

                /**************************** Set Request Variables *******************************/
                if (isset($send_req["buyer_email_address"])) {
                    $pz_charging->set_buyer_email_address($send_req["buyer_email_address"]);
                }
                if (isset($send_req["merchant_transaction_id"])) {
                    $pz_charging->set_merchant_transaction_id($send_req["merchant_transaction_id"]);
                }
                if (isset($send_req["transaction_currency"])) {
                    $pz_charging->set_currency($send_req["transaction_currency"]);
                }
                if (isset($send_req["transaction_amount"])) {
                    $pz_charging->set_transaction_amount($send_req["transaction_amount"]);
                }
                if (isset($send_req["payment_method"])) {
                    $pz_charging->set_payment_method($send_req["payment_method"]);
                }
                if (isset($send_req["bank_name"])) {
                    $pz_charging->set_bank_name($send_req["bank_name"]);
                }
                if (isset($send_req["ui_mode"])) {
                    $pz_charging->set_ui_mode($send_req["ui_mode"]);
                }
                if (isset($send_req["callback_url"])) {
                    $pz_charging->set_callback_url($send_req["callback_url"]);
                }
                if (isset($send_req["is_user_logged_in"])) {
                    $pz_charging->set_is_user_logged_in($send_req["is_user_logged_in"]);
                }
                if (isset($send_req["buyer_phone_no"])) {
                    $pz_charging->set_buyer_phone_no($send_req["buyer_phone_no"]);
                }
                if (isset($send_req["buyer_unique_id"])) {
                    $pz_charging->set_buyer_unique_id($send_req["buyer_unique_id"]);
                }
                if (isset($send_req["shipping_address"])) {
                    $pz_charging->set_shipping_address($send_req["shipping_address"]);
                }
                if (isset($send_req["shipping_city"])) {
                    $pz_charging->set_shipping_city($send_req["shipping_city"]);
                }
                if (isset($send_req["shipping_state"])) {
                    $pz_charging->set_shipping_state($send_req["shipping_state"]);
                }
                if (isset($send_req["shipping_zip"])) {
                    $pz_charging->set_shipping_zip($send_req["shipping_zip"]);
                }
                if (isset($send_req["shipping_country"])) {
                    $pz_charging->set_shipping_country($send_req["shipping_country"]);
                }
                if (isset($send_req["billing_name"])) {
                    $pz_charging->set_billing_name($send_req["billing_name"]);
                }
                if (isset($send_req["billing_address"])) {
                    $pz_charging->set_billing_address($send_req["billing_address"]);
                }
                if (isset($send_req["billing_city"])) {
                    $pz_charging->set_billing_city($send_req["billing_city"]);
                }
                if (isset($send_req["billing_state"])) {
                    $pz_charging->set_billing_state($send_req["billing_state"]);
                }
                if (isset($send_req["billing_zip"])) {
                    $pz_charging->set_billing_zip($send_req["billing_zip"]);
                }
                if (isset($send_req["billing_country"])) {
                    $pz_charging->set_billing_zip($send_req["billing_country"]);
                }
                if (isset($timegmt_requested) && $timegmt_requested == 'Y') {
                    $pz_charging->set_timegmt();
                }
                
                /****************************** Initiate Charging Request Object *******************************/
                $charging_object = $pz_charging->charge();
                
                // store data to session
                $pz_data['computed_hash_req'] = $charging_object['params']['hash'];
                if (isset($timegmt_requested) && $timegmt_requested == 'Y') {
                    $pz_data['timegmt'] = $charging_object['params']['timegmt'];
                }
                $this->CI->session->set_userdata($pz_data);
                
                return $charging_object;    
        }
        
        /**
         * Process PayZippy Response and check the hash for a match.
         * @param type $post_data
         * @return boolean
         */
        private function _pz_charging_res($post_data) {
            $settings	= $this->CI->Settings_model->get_settings('payzippy');
            
            // Load the global classes
            require APPPATH."packages/payment/payzippy/libraries/PZ_Config.php";
            require APPPATH."packages/payment/payzippy/libraries/PZ_Constants.php";
            require APPPATH."packages/payment/payzippy/libraries/PZ_Utils.php";
            require APPPATH."packages/payment/payzippy/libraries/ChargingResponse.php";
            
            /**************************** Make new Response Object *****************************/
                // Get a new instance of ChargingResponse.
                $pz_charging = new ChargingResponse($post_data);
                            
            /****************************** Validate Response Hash *******************************/
                $hash_status = $pz_charging->validate();    
                if($hash_status) {
                    return TRUE;
                } else {
                    return FALSE;
                }
        }

        /**************************************************************************************************************************************
         * Saves the request/response/retry objects into the payzippy_tracker db to keep tracking of requests generated
         * @param type $pz_charging
         * @param type $resp_data
         * @param type $order_id
         * @return type
         */
        private function _update_pz_tracker($pz_charging = null, $resp_data = null, $order_id = null) {
            
            $this->CI->load->model('payzippy_tracker_model');
            $settings	= $this->CI->Settings_model->get_settings('payzippy');
            
            $pz_trans_data = array();
            
            if (isset($resp_data['transaction_status'])) {
                
                if (isset($resp_data['payzippy_transaction_id'])) {
                    $pz_trans_data['payzippy_transaction_id'] = $resp_data['payzippy_transaction_id'];
                }
                if (isset($order_id)) {
                    $pz_trans_data['order_number'] = $order_id;
                }
                if (isset($resp_data['transaction_status'])) {
                    $pz_trans_data['transaction_status'] = $resp_data['transaction_status'];
                }
                if (isset($resp_data['transaction_response_code'])) {
                    $pz_trans_data['transaction_response_code'] = $resp_data['transaction_response_code'];
                }
                if (isset($resp_data['transaction_response_message'])) {
                    $pz_trans_data['transaction_response_message'] = $resp_data['transaction_response_message'];
                }
                if (isset($resp_data['payment_instrument'])) {
                    $pz_trans_data['payment_instrument'] = $resp_data['payment_instrument'];
                }
                if (isset($resp_data['bank_name'])) {
                    $pz_trans_data['bank_name'] = $resp_data['bank_name'];
                }
                if (isset($resp_data['transaction_time'])) {
                    $pz_trans_data['transaction_time'] = $resp_data['transaction_time'];
                }
                if (isset($resp_data['fraud_action'])) {
                    $pz_trans_data['fraud_action'] = $resp_data['fraud_action'];
                }
                if (isset($resp_data['fraud_details'])) {
                    $pz_trans_data['fraud_details'] = $resp_data['fraud_details'];
                }
                
                if ($settings['RETRY_ON_SALE_FAILURE'] == 'TRUE') {
                    $resp_data['timegmt'] = $this->CI->session->userdata('timegmt');
                    if (!empty($resp_data['timegmt'])) {
                        $pz_trans_data['timegmt'] = $this->CI->session->userdata('timegmt');
                        $escape_values['trans_retry_times'] = 'trans_retry_times + 1';
                    }
                }
                
                if ($this->_logged_in()) {
                    $pz_trans_data['is_user_logged_in_resp'] = 'Y';
                } else {
                    $pz_trans_data['is_user_logged_in_resp'] = 'N';
                }
                
                if (isset($resp_data['is_international']) && $resp_data['is_international']) {
                    $pz_trans_data['is_international'] = 'Y';
                } else {
                    $pz_trans_data['is_international'] = 'N';
                }
                
                if (isset($resp_data['hash'])) {
                    $pz_trans_data['computed_hash_resp'] = $resp_data['hash'];
                    // also store req hash
                    $pz_trans_data['computed_hash_req'] = $this->CI->session->userdata('computed_hash_req');
                }
                
                if (isset($resp_data['hash_method'])) {
                    $pz_trans_data['hash_method'] = $resp_data['hash_method'];
                }
                
                if (isset($resp_data['version'])) {
                    $pz_trans_data['api_version'] = $resp_data['version'];
                }
                
                if(!isset($order_id)) {
                    $escape_values['trans_count'] = 'trans_count + 1';
                }
                
                $pz_trans_data['date_modified'] = date('Y-m-d H:i:s');

                if (isset($resp_data['merchant_transaction_id'])) {
                    $where['merchant_transaction_id'] = $resp_data['merchant_transaction_id'];
                } else {
                    die('Merchant ID cannot be left blank');
                }
                
                if (empty($escape_values)) {
                    return $this->CI->payzippy_tracker_model->update_incr($pz_trans_data, $where);   
                } else {
                    return $this->CI->payzippy_tracker_model->update_incr($pz_trans_data, $where, $escape_values);   
                }              
            } 
            else {
                
                if (!isset($pz_charging['merchant_transaction_id'])) {
                    //  Formation of the Merchant Transaction ID
                    //  2 digit code
                    //  6 digit date
                    //  10 digit rand
                    $pz_trans_data['merchant_transaction_id'] = TRANSCODE.date('dmy').rand(1111111111, 9999999999);
                }
                
                if (isset($pz_charging['payment_method'])) {
                    $pz_trans_data['payment_method'] = $pz_charging['payment_method'];
                }
                
                if (!empty($pz_charging['transaction_amount'])) {
                    $pz_trans_data['transaction_amount'] = $pz_charging['transaction_amount'];
                } else {
                    die('Amount was not calculated !');
                }
                
                if (!empty($pz_charging['transaction_currency'])) {
                    $pz_trans_data['transaction_currency'] = $pz_charging['transaction_currency'];
                } else {
                    die('Currency was not defined !');
                }
                
                $pz_trans_data['transaction_type'] = 'SALE';
                $pz_trans_data['charging_req_code'] = 'INITIATED';
                $pz_trans_data['charging_req_date'] = date('Y-m-d H:i:s');
                
                if ($this->_logged_in()) {
                    $pz_trans_data['is_user_logged_in_req'] = 'Y';
                } else {
                    $pz_trans_data['is_user_logged_in_req'] = 'N';
                }
                
                if (isset($pz_charging['udf1'])) {
                    $pz_trans_data['udf1'] = $pz_charging['udf1'];
                }
                if (isset($pz_charging['udf2'])) {
                    $pz_trans_data['udf2'] = $pz_charging['udf2'];
                }
                if (isset($pz_charging['udf3'])) {
                    $pz_trans_data['udf3'] = $pz_charging['udf3'];
                }
                if (isset($pz_charging['udf4'])) {
                    $pz_trans_data['udf4'] = $pz_charging['udf4'];
                }
                if (isset($pz_charging['udf5'])) {
                    $pz_trans_data['udf5'] = $pz_charging['udf5'];
                }
                
                $pz_trans_data['trans_count'] = 0;
                // get ip address
                $ip = $this->_getIpDetails();
                $pz_trans_data['ipaddress'] = $ip;
                
                // get browser details
                $ua = $this->_getBrowser();
                
                $pz_trans_data['browser_name']  = $ua['name'];
                $pz_trans_data['browser_ver']   = $ua['version'];
                $pz_trans_data['platform']      = $ua['platform'];
                $pz_trans_data['user_agent']    = $ua['userAgent'];
                        
                $pz_trans_data['date_added'] = date('Y-m-d H:i:s');
                $pz_trans_data['date_modified'] = date('Y-m-d H:i:s');
                
                
                $this->CI->payzippy_tracker_model->insert($pz_trans_data);
                
                return $pz_trans_data['merchant_transaction_id'];
            }   
        }
        
        /**************************************************************************************************************************************
         * Check is customer is logged in or not
         * @param type $param
         * @return type
         */
        private function _logged_in() {
            $customer = $this->CI->go_cart->customer();
            if (!isset($customer['id']))
            {
                //check the cookie
                return isset($_COOKIE['GoCartCustomer']) ? TRUE : FALSE; 
            } 
        
        }
        /**
         * Builds a request and response xml file which is saved in postdata folder
         * @param type $save_data
         * @param type $file_prefix
         * @param type $file_loc
         * @return boolean
         */
        private function build_xml($save_data, $file_prefix, $file_loc) {
            
            foreach($save_data as $key => $value) {
                if ($key == 'merchant_transaction_id') {
                    $makedir = $value;
                }
            }
            
            if (!is_dir($file_loc.$makedir))
            {
                mkdir($file_loc.$makedir, 0777, true);
            }    
            
            if (isset($save_data)) {
                $this->CI->load->helper('post_xml_helper');
                $file_path = $file_loc.$makedir.'/'.$file_prefix.date('Y-m-d').'_'.date('H.i.s').'.xml';
                $file_data = print_r_xml($save_data);
                write_file($file_path, $file_data);
                return TRUE;
            } else {
                return FALSE;
            }
        }
        
        /**
         * Fetches the ipaddress which is stored on the tracker table
         * @return type
         */
        private function _getIpDetails() {
            
            //Test if it is a shared client
            if (null !== $this->CI->input->server('HTTP_CLIENT_IP')){
                $ip=$this->CI->input->server('HTTP_CLIENT_IP');
            //Is it a proxy address
            }elseif (null !== $this->CI->input->server('HTTP_X_FORWARDED_FOR')){
                $ip=$this->CI->input->server('HTTP_X_FORWARDED_FOR');
            }else{
                $ip=$this->CI->input->server('REMOTE_ADDR');
            }
            //The value of $ip at this point would look something like: "192.0.34.166"
            $ip = ip2long($ip);
            //The $ip would now look something like: 1073732954
            return $ip;
        }
        /**
         * Get Browser Details of the client
         * @return type
         */
        private function _getBrowser()
        {
            $u_agent = $_SERVER['HTTP_USER_AGENT'];
            $bname = 'Unknown';
            $platform = 'Unknown';
            $version= "";

            //First get the platform?
            if (preg_match('/linux/i', $u_agent)) {
                $platform = 'linux';
            }
            elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                $platform = 'mac';
            }
            elseif (preg_match('/windows|win32/i', $u_agent)) {
                $platform = 'windows';
            }

            // Next get the name of the useragent yes seperately and for good reason
            if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
            {
                $bname = 'Internet Explorer';
                $ub = "MSIE";
            }
            elseif(preg_match('/Firefox/i',$u_agent))
            {
                $bname = 'Mozilla Firefox';
                $ub = "Firefox";
            }
            elseif(preg_match('/Chrome/i',$u_agent))
            {
                $bname = 'Google Chrome';
                $ub = "Chrome";
            }
            elseif(preg_match('/Safari/i',$u_agent))
            {
                $bname = 'Apple Safari';
                $ub = "Safari";
            }
            elseif(preg_match('/Opera/i',$u_agent))
            {
                $bname = 'Opera';
                $ub = "Opera";
            }
            elseif(preg_match('/Netscape/i',$u_agent))
            {
                $bname = 'Netscape';
                $ub = "Netscape";
            }

            // finally get the correct version number
            $known = array('Version', $ub, 'other');
            $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
            if (!preg_match_all($pattern, $u_agent, $matches)) {
                // we have no matching number just continue
            }

            // see how many we have
            $i = count($matches['browser']);
            if ($i != 1) {
                //we will have two since we are not using 'other' argument yet
                //see if version is before or after the name
                if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                    $version= $matches['version'][0];
                }
                else {
                    $version= $matches['version'][1];
                }
            }
            else {
                $version= $matches['version'][0];
            }

            // check if we have a number
            if ($version==null || $version=="") {$version="?";}

            return array(
                'userAgent' => $u_agent,
                'name'      => $bname,
                'version'   => $version,
                'platform'  => $platform,
                'pattern'    => $pattern
            );
        }
}
