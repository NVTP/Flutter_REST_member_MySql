<?php
    //ไฟล์นี้เป็น WebService (REST API) ที่จะรองรับ request จาก Client ไปทำงาน
    //แล้ว respond ผลลัพธ์ที่ได้กลับไปยัง Client
    //สว่นทีควรจะมีเสมอในไฟล์
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once "database.php";    //include("database.php");
    include_once "member.php";      //include("member.php");

    //สร้างตัวแทนที่จะทำงานกับ DB แล้วให้ทำการติดต่อ DB
    $database = new Database();
    $db = $database->getConnection();

    //สร้างตัวแทนของ Member
    $member = new Member($db);

    //เรียกใช้งานฟังก์ชัน checkLogin ให้ทำงาน
    //ทั้งนี้เราจะสร้างตัวแปรมาเก็บผลที่ได้จากการทำงานด้วย
    $stmt = $member->getAllMember();
    //สร้างตัวแปรเก็บ แถว-เรคอร์ดที่ได้จากการทำงานข้างต้น
    $num = $stmt->rowCount();

    //ตรวจสอบว่ามีแถวไหม ถ้ามีแปลว่า username password ถูกต้อง
    if ($num > 0) { //แสดงว่ามี  คือ ถูกต้อง
        //respond กลับไปยัง client
        $member_arr = array();

        // get retrieved row
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            extract($row);
            $member_item = array(
                "message" => "1",
                "memId" => $memId,
                "memName" => $memName,
                "memUsername" => $memUsername,
                "memPassword" => $memPassword,
                "memStatus" => $memStatus
            );
            array_push($member_arr, $member_item);
        }

        // set response code - 200 OK
        http_response_code(200);

        // make it json format
        echo json_encode($member_arr);
    } else if ($num == 0) { //แสดงว่าไม่มี คือ ไม่ถูกต้อง
        //respond กลับไปยัง client
        http_response_code(200);
        echo json_encode(array("message" => "2"));
    } else { //แปลว่ามีปัญหาเกิดขึ้นในการทำงานกับ DB
        http_response_code(200);
        echo json_encode(array("message" => "3"));
    }
