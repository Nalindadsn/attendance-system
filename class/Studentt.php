<?php
class Studentt {	
   
	private $studentTable = 'sas_students';
	private $classTable = 'sas_classes';
	private $attendanceTable = 'sas_attendance_b';
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function listStudents(){
		
		$sqlQuery = "SELECT s.id, s.name, s.roll_no, c.name as class_name,c.year AS y, c.type AS type
		FROM ".$this->studentTable." as s 
		INNER JOIN batch as c ON s.class = c.id 
		 ";
		
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'WHERE (s.id LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR s.name LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR s.roll_no LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR s.name LIKE "%'.$_POST["search"]["value"].'%") ';								
		}
		
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY s.id DESC ';
		}
		
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();	
		
		$stmtTotal = $this->conn->prepare("SELECT * FROM ".$this->studentTable." as s 
		INNER JOIN batch as c ON s.class = c.id" );
		$stmtTotal->execute();
		$allResult = $stmtTotal->get_result();
		$allRecords = $allResult->num_rows;
		
		$displayRecords = $result->num_rows;
		$records = array();		
		while ($student = $result->fetch_assoc()) { 				
			$rows = array();			
			$rows[] = $student['id']."";
			$rows[] = ucfirst($student['name']);
			$rows[] = $student['roll_no'];		
			$rows[] = $student['class_name']."-".$student['y']."-".$student['type'];				
			$rows[] = '<button type="button" name="view" id="'.$student["id"].'" class="btn btn-info btn-xs view"><span class="glyphicon glyphicon-file" title="View"></span></button>';
			$rows[] = '<button type="button" name="update" id="'.$student["id"].'" class="btn btn-warning btn-xs update">Edit</button>';
			if(!empty($_SESSION["role"]) && $_SESSION["role"] == 'administrator') {
				$rows[] = '<button type="button" name="delete" id="'.$student["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
			} else {
				$rows[] = 'Delete';
			}
			$records[] = $rows;
		}
		
		$output = array(
			"draw"	=>	intval($_POST["draw"]),			
			"iTotalRecords"	=> 	$displayRecords,
			"iTotalDisplayRecords"	=>  $allRecords,
			"data"	=> 	$records
		);
		
		echo json_encode($output);
	}
	
	
	public function getStudent(){
		if($this->id) {
			$sqlQuery = "SELECT s.id, s.name, s.email, s.mobile, s.father_mobile, s.mother_name, s.mother_mobile, s.current_address, s.roll_no, as class_name
				FROM ".$this->studentTable." as s 
				
				WHERE s.id = ?";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->id);	
			$stmt->execute();
			$result = $stmt->get_result();
			$record = $result->fetch_assoc();
			echo json_encode($record);
		}
	}
public function ck($v,$cl,$ss){

			// $sqlQueryCheck = "SELECT * FROM sas_attendance_b WHERE 
			
			// student_id='".$v."' AND attendance_date='".$attendanceDate."'  LIMIT 1";	
				
			// $stmtCheck = $this->conn->prepare($sqlQueryCheck);
			// $stmtCheck->execute();
			// $result = $stmt->get_result();
			// 	$user = $result->fetch_assoc();

			//$attendanceDone = $resultCheck->num_rows;

			$sqlQuery = "SELECT * FROM sas_attendance_b WHERE 
			student_id='".$v."' AND class_id='".$ss."'    LIMIT 1";			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				$user = $result->fetch_assoc();
				//$vvv = $user['id'];				
				return $user['status'];		
			} else {
				return "";		
			}

	// return $user['status'];

}
	public function getClassStudents(){	
	

// $qur="SELECT * FROM sas_attendance_b WHERE "

		$sqlQuery = "SELECT s.id, s.name, s.roll_no, c.name as class_name,c.year AS y, c.type AS type
		FROM ".$this->studentTable." as s 
		INNER JOIN batch as c ON s.class = c.id
WHERE class=".$this->classId."  
		 ";
		
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'AND (s.id LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR s.name LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR s.roll_no LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR s.name LIKE "%'.$_POST["search"]["value"].'%") ';								
		}
		
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY s.id DESC ';
		}
		
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();	

		$stmtTotal = $this->conn->prepare("SELECT * FROM ".$this->studentTable." as s 
		INNER JOIN batch as c ON s.class = c.id" );
		$stmtTotal->execute();
		$allResult = $stmtTotal->get_result();
		$allRecords = $allResult->num_rows;
		
		$displayRecords = $result->num_rows;
		$records = array();		
		while ($student = $result->fetch_assoc()) { 	
				$checked = array();
				$checked[1] = '';
				$checked[2] = '';
				$checked[3] = '';
				$checked[4] = '';

					if($this->ck($student['id'],$this->classId, $this->sId) == 'present') {
						$checked[1] = 'checked';
					} else if($this->ck($student['id'],$this->classId, $this->sId) == 'absent') {
						$checked[2] = 'checked';
					} else if($this->ck($student['id'],$this->classId, $this->sId) == 'late') {
						$checked[3] = 'checked';
					} else if($this->ck($student['id'],$this->classId, $this->sId) == 'half_day') {
						$checked[4] = 'checked';
					}	



			$rows = array();			
			$rows[] = $student['id'];
			$rows[] = ucfirst($student['name'])."-".$this->sId;
			$rows[] = $this->ck($student['id'], $this->classId, $this->sId);		
			$rows[] = $student['class_name']."-".$student['y']."-".$student['type'];
$a='';
$a=$this->ck($student['id'], $this->classId, $this->sId);

				// $rows[]=ck();

				// $rows[] = '
				// <input type="radio" id="attendencetype1_'.$student['id'].'" value="present" name="attendencetype_'.$student['id'].'" autocomplete="off" '.$checked['1'].'>
				// <label for="attendencetype_'.$student['id'].'">Present</label>
				// <input type="radio" id="attendencetype2_'.$student['id'].'" value="absent" name="attendencetype_'.$student['id'].'" autocomplete="off" '.$checked['2'].'>
				// <label for="attendencetype'.$student['id'].'">Absent</label>
				// <input type="radio" id="attendencetype3_'.$student['id'].'" value="late" name="attendencetype_'.$student['id'].'" autocomplete="off" '.$checked['3'].'>
				// <label for="attendencetype3_'.$student['id'].'"> Late </label>
				// <input type="radio" id="attendencetype4_'.$student['id'].'" value="half_day" name="attendencetype_'.$student['id'].'" autocomplete="off" '.$checked['4'].'>
				// <label for="attendencetype_'.$student['id'].'"> Half Day </label>';	


				$rows[] = '
				<input type="number" id="attendencetype1_'.$student['id'].'"  name="attendencetype_'.$student['id'].'"  value="'.$a.'" />
				';


			$rows[] = '<button type="button" name="view" id="'.$student["id"].'" class="btn btn-info btn-xs view"><span class="glyphicon glyphicon-file" title="View"></span></button>';
			$rows[] = '<button type="button" name="update" id="'.$student["id"].'" class="btn btn-warning btn-xs update">Edit</button>';
			if(!empty($_SESSION["role"]) && $_SESSION["role"] == 'administrator') {
				$rows[] = '<button type="button" name="delete" id="'.$student["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
			} else {
				$rows[] = 'Delete';
			}
			$records[] = $rows;
		}
		
		$output = array(
			"draw"	=>	intval($_POST["draw"]),			
			"iTotalRecords"	=> 	$displayRecords,
			"iTotalDisplayRecords"	=>  $allRecords,
			"data"	=> 	$records
		);
		
		echo json_encode($output);
	}
	
	
	public function attendanceStatus(){	
		if($this->classId) {
			$attendanceYear = date('Y'); 
			$attendanceMonth = date('m'); 
			$attendanceDay = date('d'); 
			$attendanceDate = $attendanceYear."/".$attendanceMonth."/".$attendanceDay;

			$sqlQuery = "SELECT * FROM ".$this->attendanceTable." 
				WHERE class_id = '".$this->classId."' AND attendance_date = '".$attendanceDate."'";			
			$stmtTotal = $this->conn->prepare($sqlQuery);
			$stmtTotal->execute();
			$allResult = $stmtTotal->get_result();
			$attendanceDone = $allResult->num_rows;			
			if($attendanceDone) {
				echo " already submitted!";
			} 
		}
	}
	
	public function updateAttendance(){	
		$attendanceYear = date('Y'); 
		$attendanceMonth = date('m'); 
		$attendanceDay = date('d'); 
		$attendanceDate = $attendanceYear."/".$attendanceMonth."/".$attendanceDay;	
		
		$sqlQuery = "SELECT * FROM ".$this->attendanceTable." 
			WHERE class_id = '".$_POST["att_classid"]."'";			
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		$attendanceDone = $result->num_rows;		
		
		if($attendanceDone) {
			foreach($_POST as $key => $value) {				
				if (strpos($key, "attendencetype_") !== false) {
					$student_id = str_replace("attendencetype_","", $key);
					$attendanceStatus = $value;					
					if($student_id) {
						$updateQuery = "UPDATE ".$this->attendanceTable." SET status = '".$attendanceStatus."'
						WHERE student_id = '".$student_id."' AND class_id = '".$_POST["att_classid"]."'";						
						
						$stmt = $this->conn->prepare($updateQuery);							
						$stmt->execute();
						
					}
				}				
			}	
			echo " updated successfully!";			
		} else {
			foreach($_POST as $key => $value) {				
				if (strpos($key, "attendencetype_") !== false) {
					$student_id = str_replace("attendencetype_","", $key);
					$attendanceStatus = $value;					
					if($student_id) {
						$insertQuery = "INSERT INTO ".$this->attendanceTable."(student_id, class_id, status, attendance_date,assignmentNo,remark) 
						VALUES ('".$student_id."', '".$_POST["att_classid"]."', '".$attendanceStatus."', '".$attendanceDate."', '".$_POST["att_assignmentNo"]."', '".$_POST["att_remark"]."')";
						
						$stmt = $this->conn->prepare($insertQuery);							
						$stmt->execute();
					}
				}
				
			}
			echo " save successfully!";
		}	
	}
	
	public function updateMarks(){	
		$attendanceYear = date('Y'); 
		$attendanceMonth = date('m'); 
		$attendanceDay = date('d'); 
		$attendanceDate = $attendanceYear."/".$attendanceMonth."/".$attendanceDay;	
		
		$sqlQuery = "SELECT * FROM ".$this->attendanceTable." 
			WHERE class_id = '".$_POST["att_classid"]."' AND attendance_date = '".$attendanceDate."'";			
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		$attendanceDone = $result->num_rows;		
		
		if($attendanceDone) {
			foreach($_POST as $key => $value) {				
				if (strpos($key, "attendencetype_") !== false) {
					$student_id = str_replace("attendencetype_","", $key);
					$attendanceStatus = $value;					
					if($student_id) {
						$updateQuery = "UPDATE sas_attendance_b SET status = '".$attendanceStatus."'
						WHERE student_id = '".$student_id."' AND class_id = '".$_POST["att_classid"]."' AND attendance_date = '".$attendanceDate."'";						
						
						$stmt = $this->conn->prepare($updateQuery);							
						$stmt->execute();
						
					}
				}				
			}	
			echo "Marks updated successfully!";			
		} else {
			foreach($_POST as $key => $value) {				
				if (strpos($key, "attendencetype_") !== false) {
					$student_id = str_replace("attendencetype_","", $key);
					$attendanceStatus = $value;					
					if($student_id) {
						$insertQuery = "INSERT INTO sas_attendance_b (student_id, class_id, status, attendance_date) 
						VALUES ('".$student_id."', '".$_POST["att_classid"]."', '".$attendanceStatus."', '".$attendanceDate."')";
						
						$stmt = $this->conn->prepare($insertQuery);							
						$stmt->execute();
					}
				}
				
			}
			echo "Marks save successfully!";
		}	
	}
	
	public function getStudentsAttendance(){		
		if($this->classId) {
			$sqlQuery = "SELECT s.id, s.name, s.photo, s.gender, s.dob, s.mobile, s.email, s.current_address,s.admission_no, s.roll_no, s.admission_date, s.academic_year, a.status
				FROM ".$this->studentTable." as s
				LEFT JOIN ".$this->attendanceTable." as a ON s.id = a.student_id
				
				WHERE a.class_id = '".$this->classId."' AND (a.attendance_date BETWEEN '".$this->attendanceDate."' AND '".$this->attendanceDate_b."') ";
			if(!empty($_POST["search"]["value"])){
				$sqlQuery .= ' AND (s.id LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR s.name LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR s.admission_no LIKE "%'.$_POST["search"]["value"].'%" ';	
				$sqlQuery .= ' OR s.roll_no LIKE "%'.$_POST["search"]["value"].'%" ';	
				$sqlQuery .= ' OR a.attendance_date LIKE "%'.$_POST["search"]["value"].'%" )';
			}
			if(!empty($_POST["order"])){
				$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
			} else {
				$sqlQuery .= 'ORDER BY s.id DESC ';
			}
			if($_POST["length"] != -1){
				$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
			}	
			
			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			$result = $stmt->get_result();	
						
			$stmtTotal = $this->conn->prepare("SELECT * FROM ".$this->attendanceTable);
			$stmtTotal->execute();
			$allResult = $stmtTotal->get_result();
			$allRecords = $allResult->num_rows;
		
			$displayRecords = $result->num_rows;		
			
			$studentData = array();				
			while ($student = $result->fetch_assoc()) {			
							
				$studentRows = array();			
				$studentRows[] = $student['id'];				
				$studentRows[] = $student['roll_no'];
				$studentRows[] = $student['name'];		
				$studentRows[] = $student['status'];					
				$studentData[] = $studentRows;
			}
			
			$output = array(
				"draw"	=>	intval($_POST["draw"]),			
				"iTotalRecords"	=> 	$displayRecords,
				"iTotalDisplayRecords"	=>  $allRecords,
				"data"	=> 	$studentData
			);
			echo json_encode($output);
			
		}
	}

public function ckk($cl,$v,$t){


			$sqlQuery = "SELECT * FROM sas_attendance_b WHERE 
			student_id='".$v."' AND class_id='".$cl."' AND assignmentNo='".$t."' ORDER BY attendance_id LIMIT 1 ";			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				$user = $result->fetch_assoc();
				return $user['status'];		
			} else {
				return "0";		
			}

	// return $user['status'];

}

	public function getStudentsAttendance_b(){		
		if($this->classId) {
			$sqlQuery = "SELECT s.id, s.name,a.class_id AS class_id, s.photo, s.gender, s.dob, s.mobile, s.email, s.current_address,s.admission_no, s.roll_no, s.admission_date, s.academic_year, a.status
				FROM ".$this->studentTable." as s
				LEFT JOIN ".$this->attendanceTable." as a ON s.id = a.student_id
				
				WHERE a.class_id = '".$this->classId."'  ";
			if(!empty($_POST["search"]["value"])){
				$sqlQuery .= ' AND (s.id LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR s.name LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR s.admission_no LIKE "%'.$_POST["search"]["value"].'%" ';	
				$sqlQuery .= ' OR s.roll_no LIKE "%'.$_POST["search"]["value"].'%" ';	
				$sqlQuery .= ' OR a.attendance_date LIKE "%'.$_POST["search"]["value"].'%" )';
			}
			if(!empty($_POST["order"])){
				$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
			} else {
				$sqlQuery .= 'ORDER BY s.id DESC ';
			}
			if($_POST["length"] != -1){
				$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
			}	
			
			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			$result = $stmt->get_result();	
						
			$stmtTotal = $this->conn->prepare("SELECT * FROM ".$this->attendanceTable);
			$stmtTotal->execute();
			$allResult = $stmtTotal->get_result();
			$allRecords = $allResult->num_rows;
		
			$displayRecords = $result->num_rows;		
			
			$studentData = array();				
			while ($student = $result->fetch_assoc()) {			
							
				$studentRows = array();			
				$studentRows[] = $student['id'];				
				$studentRows[] = $student['roll_no'];
				$studentRows[] = $student['name'];	
				$studentRows[] = $this->ckk($student['class_id'],$student['id'],1);	
				$studentRows[] = $this->ckk($student['class_id'],$student['id'],2);	
				$studentRows[] = $this->ckk($student['class_id'],$student['id'],3);	
				$studentRows[] = $this->ckk($student['class_id'],$student['id'],4);	

				$studentRows[] = ($this->ckk($student['class_id'],$student['id'],1)+$this->ckk($student['class_id'],$student['id'],2)+$this->ckk($student['class_id'],$student['id'],3)+$this->ckk($student['class_id'],$student['id'],4));		

				$studentData[] = $studentRows;
			}
			
			$output = array(
				"draw"	=>	intval($_POST["draw"]),			
				"iTotalRecords"	=> 	$displayRecords,
				"iTotalDisplayRecords"	=>  $allRecords,
				"data"	=> 	$studentData
			);
			echo json_encode($output);
			
		}
	}
	
	public function getStudentDetails(){		
		if($this->studentId) {		
			$sqlQuery = "
				SELECT *
				FROM ".$this->studentTable." 
				WHERE id = ?";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->studentId);	
			$stmt->execute();
			$result = $stmt->get_result();			
			$row = $result->fetch_assoc();
			echo json_encode($row);
		}		
	}
	
	public function insert() {      
		if($this->name) {		              
			$queryInsert = "
				INSERT INTO ".$this->studentTable."(`name`, `gender`, `dob`, `mobile`, `email`, `current_address`, `permanent_address`, `academic_year`, `class`, `roll_no`) 
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";				
			$stmt = $this->conn->prepare($queryInsert);			
			$stmt->bind_param("sssssssssiii", $this->name, $this->gender, $this->dob, $this->mobile, $this->email, $this->currentAddress, $this->permanentAddress, $this->acamedicYear, $this->classid, $this->rollNo);	
			$stmt->execute();				
		}
	}
	
	public function update() {      
		if($this->studentId && $this->name) { 				
			$queryUpdate = "
				UPDATE ".$this->studentTable." 
				SET name = ?, gender = ?, dob = ?, mobile = ?, email = ?, current_address = ?, permanent_address = ?, academic_year = ?, class = ?, roll_no = ?
				WHERE id = ?";				
			$stmt = $this->conn->prepare($queryUpdate);
			$stmt->bind_param("sssssssssiiii", $this->name, $this->gender, $this->dob, $this->mobile, $this->email, $this->currentAddress, $this->permanentAddress, $this->acamedicYear, $this->classid, $this->rollNo, $this->studentId);
			$stmt->execute();			
		}
	}
	
	public function delete() {      
		if($this->studentId) {		          
			$queryDelete = "
				DELETE FROM ".$this->studentTable." 
				WHERE id = ?";				
			$stmt = $this->conn->prepare($queryDelete);
			$stmt->bind_param("i", $this->studentId);	
			$stmt->execute();		
		}
	}
}
?>
