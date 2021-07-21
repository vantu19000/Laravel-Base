<?php


namespace App\Traits;


trait ServiceTrait
{
    protected $status;
    protected $data;
    protected $messages;

    public function __construct()
    {
        $this->status = true;
        $this->messages = [];
        $this->data = null;
    }

    protected function setFail($message) : void {
        $this->status = false;
        if (is_string($message)) {
            $this->messages = array($message);
        }
        if (is_array($message)) {
            $this->messages = $message;
        }
    }

    protected function setSuccess() : void {
        $this->status = false;
    }

    protected function response() : array {
        return array(
            'status'        => $this->status,
            'data'          => $this->data,
            'messages'      => $this->messages,
        );
    }

}
