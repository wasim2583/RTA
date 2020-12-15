<?php
class Csv_mocktest_model extends CI_Model
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
            $count++;
            if($count == 1)
            {
                continue;
            }//keep this if condition if you want to remove the first row
            for($i = 0, $j = count($csv_line); $i < $j; $i++)
            {
                $insert_csv = array();
                //$insert_csv['care_id'] = $csv_line[0];//remove if you want to have primary key,
                $insert_csv['question'] = $csv_line[1];
				$insert_csv['answer'] = $csv_line[2];
                $insert_csv['written_on'] = $csv_line[3];
				$insert_csv['status'] = $csv_line[4];
				$insert_csv['option1'] = $csv_line[5];
				$insert_csv['option2'] = $csv_line[6];
				$insert_csv['option3'] = $csv_line[7];
				$insert_csv['option4'] = $csv_line[8];
				$insert_csv['option5'] = $csv_line[9];
				 
            }
            $i++;
            $mocktest = array(
                'question' => $insert_csv['question'],
				'answer' => $insert_csv['answer'],
				'written_on' => $insert_csv['written_on'],
				'status' => $insert_csv['status'],
				
				);
				  $mocktest_options = array(
                'option1' => $insert_csv['option1'],
				'option2' => $insert_csv['option2'],
				'option3' => $insert_csv['option3'],
				'option4' => $insert_csv['option4'],
				'option5' => $insert_csv['option5']
				);
            $data['mocktest_values']=$this->db->insert('da_mocktest_tbl', $mocktest);
			$data['mocktest_option_values']=$this->db->insert('da_mocktest_options_tbl', $mocktest_options);
        }
        fclose($fp) or die("can't close file");
        $data['success']="success";
        return $data;
    }
}