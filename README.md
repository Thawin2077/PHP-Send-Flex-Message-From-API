สามารถเพิ่มข้อมูลลง Database ได้ด้วย PhpMyAdmin

สร้างตัวแปร username & pass & dbname เพื่อเก็บ userid&password ของ phpmyadmin (สามารถดูได้ที่ไฟล์ config ของ phpmyadmin) เพื่อไว้ login เข้า database
สำรหับเก็บข้อมูลลง table

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flex";

ใช้ $sql = "INSERT INTO **ชื่อ table ใน db** (ชื่อฟิลเตอร์ที่สร้างไว้ใน table) 
Values (ตัวแปรที่เก็บข้อมูลเอาไว้ที่จะนำไปใส่ใน Database)

$sql = "INSERT INTO inventory_data (CCO_UUID, CLOG_AREA_UUID, TLOG_AREA_UUID, CMATERIAL_UUID, TMATERIAL_UUID, KCs1ANs556A4FF848FA1E6, KCON_HAND_STOCK) 
VALUES ('$cco_uuid', '$clog_area_uuid', '$tlog_area_uuid', '$cmaterial_uuid', '$tmaterial_uuid', '$kcs1ans556a4ff848fa1e6', '$kcon_hand_stock')";

แก้ filter เพื่อเลือก UUID ที่จะ loop เข้ามาใส่ flex

'$filter' => '(CSITE_UUID eq \'YDDM_SN\')',

หากต้องการตัดทศนิยมใน flex ออกให้ใช้ format ดังนี้

ตัดทศนิยมออก 
'text' => strval(intval($result['KCs1ANs556A4FF848FA1E6'])),

โดยใช้ strval(intval()) ครอบซ้อนไป

ตัดทศนิมยมเหลือ 2 ตำแหน่ง
'text' => number_format($result['KCs1ANs556A4FF848FA1E6'], 2),

โดยใช้ number_format ครอบเอาไว้และกำหนด 2 ไว้เพื่อระบุว่าจะเอา 2 ตำแหน่ง
