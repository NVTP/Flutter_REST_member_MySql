<?php
    class Member{
        private $conn;

        //ควรตั้งเป็นชื่อเดียวกับ column ใน DB
        public $memId;
        public $memName;
        public $memUsername;
        public $memPassword;
        public $memStatus;

        //function เพื่อที่จะติดต่อกับ DB
        public function __construct($db)
        {
            $this->conn = $db;
        }

        //ส่วนต่อจากนี้ไปคือ function การทำงานต่าง ๆ กับตาราง membetTb
        //เฃ่น ตรวจสอบ Username, Password, บันทึกสมาชิก, แก้ไขสมาชิก เป็นต้น

        //function ตรวจสอบ username/password
        public function checkLogin(){

            //สร้างคำสั่ง SQL ที่ต้องการทำงานกับตาราง memberTb
            $query = "SELECT
                         *
                        FROM
                            memberTb
                        WHERE
                            memUsername=:memUsername
                        AND
                            memPassword=:memPassword";
            //สร้าง Statement เพื่อทำงานตามคำสั่ง SQL ด้านบน
            $stmt = $this->conn->prepare($query);

            //ตรวจสอบคำ
            $this->memUsername = htmlspecialchars(strip_tags($this->memUsername));
            $this->memPassword = htmlspecialchars(strip_tags($this->memPassword));

            //กำหนดค่าข้อมูลให้กับคีย์ :memUsrname, :memPassword เพื่อเอาไปใช้กับคำสั่ง SQL ด้านบน
            $stmt->bindParam(":memUsername",$this->memUsername);
            $stmt->bindParam(":memPassword",$this->memPassword);
            //สั่งให้ Statement ทำงาน
            $stmt->execute();
            //ส่งค่าที่ได้จากการทำงาน Statement กลับไปยังจุดที่จะเรียกใช้ function
            return $stmt;
        }

        public function getAllmember(){
            $query = "SELECT * FROM memberTb";

             //สร้าง Statement เพื่อทำงานตามคำสั่ง SQL ด้านบน
             $stmt = $this->conn->prepare($query);

              //สั่งให้ Statement ทำงาน
            $stmt->execute();
            //ส่งค่าที่ได้จากการทำงาน Statement กลับไปยังจุดที่จะเรียกใช้ function
            return $stmt;
        }
    }