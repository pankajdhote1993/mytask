<?php
if(!defined('BASEPATH')){ exit('You dont have direct access of this page...'); }

class App_details extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Task_model');
		$this->load->helper(array('form', 'url'));
	}
			
	
	// student registration
	public function register_student(){
		
		if($this->input->post('first_name')!='' && $this->input->post('last_name')!='' && $this->input->post('parent_name')!='' && $this->input->post('mobile')!='' && $this->input->post('standard')!='' && $this->input->post('course')!='' && $this->input->post('birth_certificate')!='' && $this->input->post('base64_code') != ''){
			
			
			$data['first_name'] 		= $this->input->post('first_name');
			$data['last_name'] 			= $this->input->post('last_name');
			$data['parent_name'] 		= $this->input->post('parent_name');
			$data['mobile_number'] 		= $this->input->post('mobile');
			$data['standard']			= $this->input->post('standard');
			$data['course']				= $this->input->post('course');
			$data['stud_email']			= $this->input->post('email');
			$data['birth_certificate']	= $this->input->post('birth_certificate');
			$base64_code 				= $this->input->post('base64_code');
			
			$file_name = $data['birth_certificate'];
			$file_path = './assets/birth_certificate/'.$file_name;
			
			//check file extension
			$allowed = array('jpeg', 'png', 'pdf');
			$filename = $file_name;
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if (!in_array($ext, $allowed)) {
				$response[0]['result'] = "FE";
				echo json_encode($response);die;
			}
			
			header('Content-Type: bitmap; charset=utf-8');
			$base64_image_decoded = base64_decode($base64_code);

			// open file and write			
			$file = fopen($file_path, 'wb');
			// Create File
			$result = fwrite($file, $base64_image_decoded);
			fclose($file);
			
			date_default_timezone_set('Asia/Calcutta');
			$data['inserted_date_time']=date("Y-m-d H:i:s");
			
			$this->db->insert('student_details',$data);
			$stud_id = $this->db->insert_id();
			
			
			$student_doc_array  =  $_FILES['student_doc']['name'];
			if(count($student_doc_array) > 0){
				$i=0;
				foreach($student_doc_array as $stud_doc){
					$upload_student_doc 		= './assets/student_document/';
					$student_doc_source 		= $_FILES['student_doc']['tmp_name'][$i];
					$data1['stud_id'] 			= $stud_id;
					$data1['document'] 			= $student_doc_array[$i];
					$data1['inserted_date_time'] = date("Y-m-d H:i:s");
					
					// Insert into student_document table			
					$this->db->insert('student_document',$data1);				
					$document_id = $this->db->insert_id();
					
					if($document_id != ""){
						$added_img[] = $student_doc_array[$i];
						move_uploaded_file($student_doc_source , $upload_student_doc.'/'.$student_doc_array[$i]);
					}
					$i = $i+1;	
				}
			}
			
			if($stud_id != ''){
				$response[0]['result'] = "S";
				echo json_encode($response);
			}else{
				$response[0]['result'] = "F";
				echo json_encode($response);
				die;
			}
				
			
		}else{
				$response[0]['result'] = "F";
				echo json_encode($response);
				die;
			}
	}		
	
	
	//function to display product against service
	public function get_student_list() {
		
		$data = $this->Task_model->custom_query("SELECT * FROM `student_details` order by student_id desc");
		
		//$data = $this->Task_model->custom_query("SELECT * FROM `student_details` std inner join student_document sd on std.student_id = sd.stud_id order by std.student_id desc");
		
		$student_count = count($data);
		for($i=0;$i<$student_count;$i++){
			$data[$i]['birth_certificate'] = WEB."/birth_certificate/".$data[$i]['birth_certificate'];
			$studid = $data[$i]['student_id'];
			
			$doc_data = $this->Task_model->custom_query("SELECT * FROM `student_document` where stud_id = '".$studid."' ");
			for($j=0;$j<count($doc_data);$j++){
				$data[$i]['document'][$j]['document_id'] = $doc_data[$j]['document_id'];
				$data[$i]['document'][$j]['student_document'] = WEB."/student_document/".$doc_data[$j]['document'];
			}
			
		}
		
		
		if(count($data) > 0){
			echo json_encode($data);die;
		}else{
			$data = array();
			echo json_encode($data); die;
		}
	}
	
	public function update_student_data(){
		
		if($this->input->post('student_id') != '' && $this->input->post('first_name')!='' && $this->input->post('last_name')!='' && $this->input->post('parent_name')!='' && $this->input->post('mobile')!='' && $this->input->post('standard')!='' && $this->input->post('course')!=''){
			
			$student_id 				= $this->input->post('student_id');
			$data['first_name'] 		= $this->input->post('first_name');
			$data['last_name'] 			= $this->input->post('last_name');
			$data['parent_name'] 		= $this->input->post('parent_name');
			$data['mobile_number'] 		= $this->input->post('mobile');
			$data['standard']			= $this->input->post('standard');
			$data['course']				= $this->input->post('course');
			$data['stud_email']			= $this->input->post('email');
			
			if($this->input->post('birth_certificate')!='' && $this->input->post('base64_code') != ''){
				$data['birth_certificate']	= $this->input->post('birth_certificate');
				$base64_code 				= $this->input->post('base64_code');
				
				$file_name = $data['birth_certificate'];
				$file_path = './assets/birth_certificate/'.$file_name;
				
				//check file extension
				$allowed = array('jpeg', 'png', 'pdf');
				$filename = $file_name;
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if (!in_array($ext, $allowed)) {
					$response[0]['result'] = "FE";
					echo json_encode($response);die;
				}
				
				header('Content-Type: bitmap; charset=utf-8');
				$base64_image_decoded = base64_decode($base64_code);

				// open file and write			
				$file = fopen($file_path, 'wb');
				// Create File
				$result = fwrite($file, $base64_image_decoded);
				fclose($file);
			}
			
			date_default_timezone_set('Asia/Calcutta');
			$data['inserted_date_time']=date("Y-m-d H:i:s");
			
			$this->db->where('student_id', $student_id);
			$this->db->update('student_details',$data);
			
			$student_doc_array  =  $_FILES['student_doc']['name'];
			if(count($student_doc_array) > 0){
				$i=0;
				foreach($student_doc_array as $stud_doc){
					$upload_student_doc 		= './assets/student_document/';
					$student_doc_source 		= $_FILES['student_doc']['tmp_name'][$i];
					$data1['stud_id'] 			= $student_id;
					$data1['document'] 			= $student_doc_array[$i];
					$data1['inserted_date_time'] = date("Y-m-d H:i:s");
					
					// Insert into student_document table			
					$this->db->insert('student_document',$data1);				
					$document_id = $this->db->insert_id();
					
					if($document_id != ""){
						$added_img[] = $student_doc_array[$i];
						move_uploaded_file($student_doc_source , $upload_student_doc.'/'.$student_doc_array[$i]);
					}
					$i = $i+1;	
				}
			}
			
			$response[0]['result'] = "S";
			echo json_encode($response);
			
		}else{
				$response[0]['result'] = "F";
				echo json_encode($response);
				die;
			}
	}
	
	
	/*public function upload_student_doc(){
	
		$data['stud_id'] 	= $this->input->post('stud_id');
		
		$student_doc_array  =  $_FILES['student_doc']['name'];
		if(count($student_doc_array) > 0){
			$i=0;
			foreach($student_doc_array as $stud_doc){
				$upload_student_doc 		= './assets/student_document/';
				$student_doc_source 		= $_FILES['student_doc']['tmp_name'][$i];
				$data['document'] 			= $student_doc_array[$i];
				
				date_default_timezone_set('Asia/Calcutta');
				$data['inserted_date_time'] = date("Y-m-d H:i:s");
				
				
				// Insert into student_document table			
				$this->db->insert('student_document',$data);				
				$document_id = $this->db->insert_id();
				
				if($document_id != ""){
					move_uploaded_file($student_doc_source , $upload_student_doc.'/'.$student_doc_array[$i]);
					$response[0]['result'] = "S";
					echo json_encode($response);
				}else{
					$response[0]['result'] = "F";
					echo json_encode($response);
					die;
				}
				$i = $i+1;	
			}
		}	
	}*/
	
}
	