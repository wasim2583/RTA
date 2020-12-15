<?php
class Csv_mock_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function uploadData()
    {
        $count=0;
        $fp = fopen($_FILES['userfile']['tmp_name'],'r') or die("can't open file");
        while($csv_line = fgetcsv($fp,1024))
        {
            
            if($count>0)
            { // echo $csv_line[0];echo $csv_line[1]; echo $csv_line[2];echo $csv_line[3];exit;
				// if($csv_line[0]!="question_id" && $csv_line[1]!="Question" && $csv_line[2]!="Answer" ){
					// return 777;exit;
				// }
                //continue;
            //keep this if condition if you want to remove the first row
            for($i = 1, $j = count($csv_line); $i < $j; $i++)
            { 
				//echo $csv_line[1];exit;
				$result = 2 ;
                $insert_csv = array();
              $insert_csv['question_id'] = $csv_line[0];//remove if you want to have primary key,
               $insert_csv['question'] = $csv_line[1];
				$insert_csv['related_img'] = $csv_line[2];
                //$insert_csv['written_on'] = $csv_line[3];related_img
				$insert_csv['status'] = 1;
				$insert_csv['option1'] = $csv_line[3];
				$insert_csv['option2'] = $csv_line[4];
				$insert_csv['option3'] = $csv_line[5];
				$insert_csv['option4'] = $csv_line[6];
					$insert_csv['answer'] = $csv_line[7];
					$insert_csv['question_type'] = $csv_line[8];
				//$insert_csv['option5'] = $csv_line[9];
				 
            }
            $i++;
			$data = array(
                'question' => $insert_csv['question'],
				'answer' => $insert_csv['answer'],
				'related_img' => $insert_csv['related_img'],
				'question_type' => $insert_csv['question_type'],
				'status' => 1,
				
				);
				 $mocktest_options = array(
				 'question_id' => $insert_csv['question_id'],
                'option1' => $insert_csv['option1'],
				'option2' => $insert_csv['option2'],
				'option3' => $insert_csv['option3'],
				'option4' => $insert_csv['option4'],
				//'option5' => $insert_csv['option5']
				);
			
            $res=$this->db->insert('da_mocktest_tbl', $data);
			$data['mocktest_option_values']=$this->db->insert('da_mocktest_options_tbl', $mocktest_options);
			
			if($res)
			{
				$result = 1;
				
			}
			}
			$count++;
        }
        fclose($fp) or die("can't close file");
        $data['success']="success";
        return $result;
    }
	public function check($hospital_name,$phone_number){
		$where=array('hospital_name'=>$hospital_name,'phone_number'=>$phone_number);
		$this->db->where($where);
		$res=$this->db->get('su_corporate_hospital_tbl');
	return	$res->num_rows();
	
	}
}