<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

use Twilio\Rest\Client;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use JWTAuth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function appVersion()
    {
        $results = DB::selectOne(
            "SELECT (SELECT * FROM variable.spu_param_val('app-current-version') LIMIT 1) AS ver;",
            []
        );

        return self::resultSet($results);
    }

    public static function maintenance()
    {
        $results = DB::select(
            "SELECT * FROM maintenance.spu_maintenanceprogram_sel();",
            []
        );

        return response()->json($results);
    }

    /**
     * return results excluding fields different from error and message for not local env
     * 
     * @author Josue
     * @last Josue
     */
    public static function resultSet($response, $filter = true)
    {
        $env = config('app.env');
        if ($env != 'local') {
            if ($filter) {
                $results = [
                    'error' => $response->error
                    ,
                    'message' => $response->message
                ];
                return response()->json($results);
            } else {
                return response()->json($response);
            }
        } else {
            return response()->json($response);
        }
    }

    /**
     * get error on input language
     * 
     * @author Josue
     * @last Josue
     */
    public static function errorLanguage($p_erc_number, $p_lng_code = 'en')
    {
        $p_lng_code = $p_lng_code ?: 'en';

        $results = DB::selectOne(
            'SELECT * FROM errorcode.spu_errorcodelanguage_sel(?,?);',
            [
                $p_erc_number,
                $p_lng_code,
            ]
        );

        return self::resultSet($results);
    }

    /**
     * validate form input value
     * 
     * @author Josue
     * @last Josue
     */
    public static function inputFormValidate(Request $request)
    {
        $p_input = $request['p_input'];
        $p_value = $request['p_value'];
        $p_value_extra = $request['p_value_extra'] ?: 0;
        $p_lng_code = $request['p_lng_code'] ?: 'en';

        $results = DB::selectOne(
            'SELECT * FROM users.spu_forminput_val(?,?,?,?);',
            [
                $p_input
                ,
                $p_value
                ,
                $p_value_extra
                ,
                $p_lng_code
            ]
        );

        return self::resultSet($results);
    }

    /**
     * validate form input value having the user current email
     * 
     * @author Josue
     * @last Josue
     */
    public static function inputFormUserValidate(Request $request)
    {
        $p_usr_email = $request['p_usr_email'];
        $p_input = $request['p_input'];
        $p_value = $request['p_value'];
        $p_value_extra = $request['p_value_extra'] ?: 0;
        $p_lng_code = $request['p_lng_code'] ?: 'en';

        $results = DB::selectOne(
            'SELECT * FROM users.spu_forminputuser_val(?,?,?,?,?);',
            [
                $p_usr_email
                , $p_input
                , $p_value
                , $p_value_extra
                , $p_lng_code
            ]
        );

        return self::resultSet($results);
    }

    public static function inputFormUserValidateV2(Request $request)
    {
        $p_usr_id = JWTAuth::toUser(JWTAuth::getToken())->getJWTIdentifier();
        // $p_usr_email = $request['p_usr_email'];
        $p_input = $request['p_input'];
        $p_value = $request['p_value'];
        $p_value_extra = $request['p_value_extra'] ?: 0;
        $p_lng_code = $request['p_lng_code'] ?: 'en';

        $results = DB::selectOne(
            'SELECT * FROM users.spu_forminputuserv2_val(?,?,?,?,?);',
            [
                $p_usr_id
                , $p_input
                , $p_value
                , $p_value_extra
                , $p_lng_code
            ]
        );

        return self::resultSet($results);
    }

    public static function paramValue(Request $request)
    {
        $p_prm_name = $request['p_prm_name'];

        $results = DB::selectOne(
            'SELECT variable.spu_param_val(?) AS value'
            , [$p_prm_name]
        );

        return response()->json($results);
    }

    /**
     * obtain params needed to send emails
     * 
     * @author Josue
     * @last Josue
     */
    public static function mailParams()
    {
        $results = DB::selectOne(
            'SELECT * FROM variable.spu_parammail_sel();'
        );

        return json_decode($results->spu_parammail_sel, true);
    }

    public function sendSMS($prefix, $phone, $body)
    {
        $results = DB::selectOne(
            'SELECT * FROM variable.spu_paramsms_sel();',
            []
        );
        $message = null;
        if ($results) {
            $data = json_decode($results->spu_paramsms_sel, true);
            $sid = $data['sms-id'];
            $token = $data['sms-token'];
            $twilio = new Client($sid, $token);

            $message = $twilio->messages
                ->create(
                    $prefix . $phone,
                    array(
                        'messagingServiceSid' => $data['sms-service-id'],
                        'body' => $body,
                    )
                );
        }

        return ($message);
    }

    function mailSel($p_mat_jso = '{}', $p_mat_name = '', $p_lng_code = '')
    {
        $p_mat_jso = $p_mat_jso;
        $p_mat_name = $p_mat_name;
        $p_lng_code = $p_lng_code;

        $results = DB::selectOne('SELECT * FROM mail.spu_maillanguage_get(?,?,?);', [$p_mat_jso, $p_mat_name, $p_lng_code]);
        
        return $results;
    }

    function mailSentRegister($p_usr_id, $p_mat_name, $p_lng_code, $p_mse_email, $p_mse_format, $p_mse_subjct, $p_mse_to)
    {

        $results = DB::selectOne('SELECT * FROM mail.spu_mailsent_reg(?,?,?,?,?,?,?);', 
            [
                $p_usr_id
                , $p_mat_name
                , $p_lng_code
                , $p_mse_email
                , $p_mse_format
                , $p_mse_subjct
                , $p_mse_to
            ]
        );

        return $results;
    }

    public function sendMail($p_lng_code, $params, $p_mat_name, $p_to_mail, $p_to_name, $p_usr_id = 0)
    {
        // $p_mat_jso = json_encode(["p_code" => $request['p_code']]);
        $mail = self::mailSel($params, $p_mat_name, $p_lng_code);

        $p_to_mail = $p_to_mail;
        $p_to_name = $p_to_name;


        $html = $mail->extra;
        $subject = $mail->extra2;

        $mailParams = DB::selectOne('SELECT * FROM variable.spu_parammail_sel() AS mailjson;', []);
        if ($mailParams) {
            $mailParams = json_decode(json_encode($mailParams), true);
            $mailParams = json_decode($mailParams['mailjson'], true);
            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = 0;
                $mail->CharSet = 'UTF-8';
                $mail->isSMTP();
                $mail->Host = $mailParams['mail-host'];
                $mail->SMTPAuth = true;
                $mail->Username = $mailParams['mail-username'];
                $mail->Password = $mailParams['mail-password'];
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->setFrom('noreply@kaizenapp.io', $mailParams['mail-from']);
                $mail->addAddress($p_to_mail, $p_to_name);
                $mail->addReplyTo('noreply@kaizenapp.io', $mailParams['mail-from']);

                $mail->Subject = $subject;

                $mail->Body = $html;
                $mail->isHTML(true);

                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->send();

            if ($p_usr_id != 0) {
                self::mailSentRegister($p_usr_id
                            , $p_mat_name
                            , $p_lng_code
                            , $p_to_mail
                            , $html
                            , $subject
                            , $p_to_name);
            }

            // return $mail->ErrorInfo;
            return true;
          } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;

            }
        }
    }

    public function currentDate() {
        $results = [
            'date' => date('Y-m-d')
            , 'year' => date('Y')
            , 'month' => date('m')
            , 'month_last' => date("n", strtotime("first day of previous month"))
        ];
        return response()->json($results);
    }


}