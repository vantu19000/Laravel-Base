<?php


namespace App\Common\Libraries\Firebase;


interface ICloudMessaging
{
    public function setAuthKey(string $authKey) : ICloudMessaging;
    public function setAndroidKey(string $androidKey) : ICloudMessaging;
    public function setIosKey(string $iosKey) : ICloudMessaging;
    public function setTitle(string $title) : ICloudMessaging;
    public function setMessage(string $message) : ICloudMessaging;
    public function setStoreId(string $storeId) : ICloudMessaging;
    public function setData(array $data) : ICloudMessaging;
    public function sendGCM(array $users = []);
}
