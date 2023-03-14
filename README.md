หากต้องการตัดทศนิยมใน flex ออกให้ใช้ format ดังนี้

ตัดทศนิยมออก 
'text' => strval(intval($result['KCs1ANs556A4FF848FA1E6'])),
โดยใช้ strval(intval()) ครอบซ้อนไป

ตัดทศนิมยมเหลือ 2 ตำแหน่ง
'text' => number_format($result['KCs1ANs556A4FF848FA1E6'], 2),
โดยใช้ number_format ครอบเอาไว้และกำหนด 2 ไว้เพื่อระบุว่าจะเอา 2 ตำแหน่ง
