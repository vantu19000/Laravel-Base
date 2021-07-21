<?php


namespace App\Traits;

use App\Common\Enums\GenderEnum;
use App\Common\Libraries\Jwt\JWT;
use Carbon\Carbon;

trait UserTrait
{
    public function getAccountInfo(object $user, bool $generateStringee = false) : array {

        if ($generateStringee) {
            $stringeeConfig = $user->stringee_config;
            $renewStringee = false;
            if ($stringeeConfig !== null) {
                if (Carbon::parse($stringeeConfig->expired) < Carbon::now()->addMinutes(15)) {
                    $renewStringee = true;
                }
            } else {
                $renewStringee = true;
            }

            if ($renewStringee) {
                $expired = Carbon::now()->addSeconds(7200);

                $header = array('cty' => "stringee-api;v=1");

                $now = time();
                $exp = $now + 7200;

                $apiKeySid = env('STRINGEE_APIKEYSID');
                $apiKeySecret = env('STRINGEE_APIKEYSECRET');

                $payload = array(
                    "jti" => $apiKeySid . "-" . $now,
                    "iss" => $apiKeySid,
                    "exp" => $exp,
                    "icc_api" => true,
                    "userId" => 'user' . $user->id
                );
                $token = JWT::encode($payload, $apiKeySecret, 'HS256', null, $header);
                $stringeeConfig = [
                    'token' => $token,
                    'expired' => $expired->format('Y-m-d H:s:i')
                ];
                $user->stringee_config = $stringeeConfig;
                $user->save();
            }
        }


        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'mobile' => $user->mobile,
            'gender' => $user->gender,
            'gender_display' => GenderEnum::getDisplay($user->gender),
            'avatar_image' => $user->avatar_image,
            'is_active' => $user->is_active,
            'is_verify' => $user->is_verify,
            'introduce' => $user->introduce,
            'hobbies' => $user->hobbies,
            'job_title' => $user->job_title,
            'company_name' => $user->company_name,
            'school' => $user->school,
            'sexual_orientation' => $user->sexual_orientation,
            'hide_me' => $user->hide_me,
            'affiliate_code' => $user->affiliate_code,
            'setting' => $user->setting,
            'feature_media' => $user->feature_media,
            'face_image' => $user->face_image,
            'age' => 20,
            'stringee_config' => $user->stringee_config,
            'birthday' => $user->birthday,
            'nickname' => $user->nickname
        ];
    }

    public function getWalletInfo(object $wallets) : array {
        return [
            'name' => $wallets->name,
            'point' => $wallets->point,
            'status' => $wallets->status
        ];
    }
}
