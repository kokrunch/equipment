<?php
include("../models/employeeModel.php");
class LineNotifyClass
{
    private function sendlinemesg($token, $message)
    {
        define('LINE_API', "https://notify-api.line.me/api/notify");
        define('LINE_TOKEN', "{$token}");
        header('Content-Type: text/html; charset=utf-8');
        $this->notify_message($message);
    }

    private function notify_message($message)
    {
        $querydata = array('message' => $message);
        $querydata = http_build_query($querydata, '', '&');
        $headerOptions = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                    . "Authorization: Bearer " . LINE_TOKEN . "\r\n"
                    . "Content-Length: " . strlen($querydata) . "\r\n",
                "content" => $querydata
            )
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents(LINE_API, FALSE, $context);
        $res = json_decode($result);
        //return $res;
    }


    public function writeMessageLineNotifyMat($token, $emp_name) //แจ้งไปยังเจ้าหน้าที่
    {
        $header = "การแจ้งเตือน\n ถึงเจ้าหน้าที่พัสดุ \n";
        $message = $header . "มีรายการเบิกวัสดุเข้ามา 1 รายการ \nจากคุณ " . $emp_name . "\n โปรดตรวจสอบรายการเบิกวัสดุ";
        $this->sendlinemesg($token, $message);
    }

    public function writeMessageLineNotifyRepair($token, $emp_name) //แจ้งไปยังเจ้าหน้าที่
    {
        $header = "การแจ้งเตือน\n ถึงช่าง \n";
        $message = $header . "มีรายการแจ้งซ่อมเข้ามา 1 รายการ \nจากคุณ " . $emp_name . "\n โปรดตรวจสอบรายการแจ้งซ่อม";
        $this->sendlinemesg($token, $message);
    }

    public function writeMessageLineNotifyEqu($token, $emp_name) //แจ้งไปยังเจ้าหน้าที่
    {
        $header = "การแจ้งเตือน\n ถึงเจ้าหน้าที่พัสดุ \n";
        $message = $header . "มีรายการยืมคุภัณฑ์เข้ามา 1 รายการ \nจากคุณ " . $emp_name . "\n โปรดตรวจสอบรายการยืมครุภัณฑ์";
        $this->sendlinemesg($token, $message);
    }
}
