<?php
    //ไฟล์นี้เป็นไฟล์ WebService (REST API) ที่จะรองรับ requsest จาก Client ไปทำงาน
    //แล้ว response ผลลัพธ์ที่ได้กลับไปยัง Client
    //ส่วนที่ควรจะมีเสมอในไฟล์
    header("Access-control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once 'database.php'; //include()
    include_once 'member.php';

    //สร้าง instance(ตัวแทน) ที่จะทำงานกับ DB แล้วให้ทำการติดต่อ DB
    $database = new Database();
    $db = $database->getConnection();
    
    //สร้างตัวแปรรับค่าที่ส่งมาจาก Client 
    $data = json_decode(file_get_contents("php://input"));

    //สร้างตัวแทนของ Member
    $member = new Member($db);
    
    // ควรทั้งเป็นชื่อเดียวกับ column ใน DB
    $member->memUsername = $data->memUsername;
    $member->memPassword = $data->memPassword;

    //เรียกใช้งาน function checkLogin() ให้ทำงาน
    //ทั้งนี้เราจะสร้างตัวแปมาเก็บผลที่ได้จากการทำงานด้วย
    $stmt = $member->checkLogin();

    //สร้างตัวแปรเก็บแถว(record)ที่ได้จากการทำงานข้างต้น
    $num = $stmt->rowCount();

    //ตรวจสอบว่ามีแถวไหม ถ้ามีแปลว่า username password ถูกต้อง
    if ($num > 0) { //แสดงว่ามี ถูกต้อง
        # response กลับไปยัง client
        http_response_code(200);
        echo json_encode(array("message"=>"1"));
    }else if(num == 0){ //แสดงว่าไม่มี คือไม่ถูกต้อง
        # response กลับไปยัง client
        http_response_code(200);
        echo json_encode(array("message"=>"2"));
    }else{ //แปลว่ามีปัญหาเกิดขึ้นในการทำงานกับ DB
        # response กลับไปยัง client
        http_response_code(200);
        echo json_encode(array("message"=>"3"));
    }