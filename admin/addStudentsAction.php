<?php
include('dbcon.php');
if (isset($_FILES["file"])) {
    if($_FILES["file"]["name"] != 'studentsSheet.xlsx') {
        print_r(json_encode(array('text'=>'false','data'=>'')));
    } else {
        $file = "files/".basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $file);
        
        require_once "PHPExcel.php";
        $excelReader = PHPExcel_IOFactory::createReaderForFile($file);
        $excelObj = $excelReader->load($file);
        $sheetCount = $excelObj->getSheetCount();
        $sheetNames = $excelObj->getSheetNames();
        
        $result = [];
        for ($sheet = 0; $sheet < $sheetCount; $sheet++) {
            $worksheet = $excelObj->getSheet($sheet);
            $lastRow = $worksheet->getHighestRow();
            $lastCol = $worksheet->getHighestColumn();
            
            $data = [];
            for ($row = 2; $row <= $lastRow; $row++) {
                $output = Array();
                for ($col = 'A'; $col <= $lastCol; $col++) {
                    if ($worksheet->getCell($col.'1')->getValue() !== null && $worksheet->getCell($col.'1')->getValue() !== "") {
                        $output[$worksheet->getCell($col.'1')->getValue()] = $worksheet->getCell($col.$row)->getValue();
                    }
                }
                $data[] = $output;
            }
            $result[$sheetNames[$sheet]] = $data;
        }
        print_r(json_encode(array('text'=>'true','data'=>$result)));
    }
}
if(isset($_POST['action'])) {
    if($_POST['action'] === 'addStudents') {
        $data = json_decode($_POST['data']);
        foreach ($data as &$value) {
               $un = $value->usn;
               $fn = $value->fname;
               $ln = $value->lname;
               $class_id = $value->classId;
               $dob = $value->dob;
               mysqli_query($conn,"insert into student (username,firstname,lastname, dob, location,class_id,status)
		values ('$un','$fn','$ln', '$dob', uploads/NO-IMAGE-AVAILABLE.jpg','$class_id','Unregistered')                                    
		") or die(mysqli_error());
        }
    }
    print_r(json_encode(array('text'=>'true')));
}
?>