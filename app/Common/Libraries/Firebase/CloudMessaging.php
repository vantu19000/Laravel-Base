<?php


namespace App\Common\Libraries\Firebase;


class CloudMessaging implements ICloudMessaging
{

    protected $fcmUrl;
    protected $authKey;
    protected $androidKey;
    protected $iosKey;
    protected $storeId;
    protected $title;
    protected $message;
    protected $data;

    public function __construct()
    {
        $this->fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    }

    public function setTitle(string $title): ICloudMessaging
    {
        $this->title = $title;
        return $this;
    }

    public function setMessage(string $message): ICloudMessaging
    {
        $this->message = $message;
        return $this;
    }

    public function setStoreId(string $storeId): ICloudMessaging
    {
        $this->storeId = $storeId;
        return $this;
    }

    public function setData(array $data): ICloudMessaging
    {
        $this->data = $data;
        return $this;
    }


    public function setAuthKey(string $authKey): ICloudMessaging
    {
        $this->authKey = $authKey;
        return $this;
    }

    public function setAndroidKey(string $androidKey): ICloudMessaging
    {
        $this->androidKey = $androidKey;
        return $this;
    }

    public function setIosKey(string $iosKey): ICloudMessaging
    {
        $this->iosKey = $iosKey;
        return $this;
    }

    public function sendGCM(array $users = []) {
        $receivers = [];
        if (count($users) === 0) {
            $items = DeviceToken::all();
            foreach ($items AS $item) {
                $receivers[] = $item->token;
            }
        } else {
            $items = DeviceToken::whereIn('user_id', $users)
                ->where('store_id', '=', $this->storeId)
                ->get();
            foreach ($items AS $item) {
                $receivers[] = $item->token;
            }
        }

        if (count($receivers) > 0) {
            $fields = array (
                'registration_ids' => $receivers,
                'collapseKey' => $this->androidKey,
                'notification' => array(
                    'body' => $this->message,
                    'title' => $this->title
                ),
                'data' => $this->data
            );
            $fields = json_encode ( $fields );
            $headers = array (
                'Authorization: key=' . "$this->authKey",
                'Content-Type: application/json'
            );
            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $this->fcmUrl );
            curl_setopt ( $ch, CURLOPT_POST, true );
            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

            $result = curl_exec ( $ch );
            curl_close ( $ch );
            return $result;
        }
    }

}
