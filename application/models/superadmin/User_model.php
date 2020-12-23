<?php
Class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function get_cat_priority()
    {
    	$category_priority = $this->db->select_max('category_priority')->from('rl_book_categories_tbl')->get()->row();
    	return $category_priority->category_priority;

    }
    public function get_subcat_priority()
    {
        $subcategory_priority = $this->db->select_max('subcategory_priority')->from(' rl_book_subcategories_tbl')->get()->row();
        return $subcategory_priority->subcategory_priority;

    }    
    public function categories()
    {
    	$response = array();
        $sql = $this->db->select("*	")->from(' rl_book_categories_tbl')->get();
        $count = $sql->num_rows();
        $resposne['code'] = ($count > 0) ? 200 : 204;
        $resposne['message'] = ($count > 0) ? 'Success' : 'Fail';
        $resposne['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $resposne['category_list'] = ($count > 0) ? $sql->result() : array();
        return json_encode($resposne);
    }
    public function subMenu($where = NULL) {
        $response = array();
        $this->db->select('subcategory_id,title')->from(' rl_book_subcategories_tbl');
        ($where != '' && is_array($where)) ? $this->db->where($where) : '';
        $sql = $this->db->order_by('title', 'ASC')->get();
        $count = $sql->num_rows();
        $response[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $response[MESSAGE] = ($count > 0 ) ? 'Success' : 'Fail';
        $response[DESCRIPTION] = ($count > 0) ? 'Total ' . $count . 'results found' : 'No results found';
        $response['submenu_result'] = ($count > 0) ? $sql->result() : array();
        return json_encode($response);
    }
    public function user_listing($title,$si,$limit)
    {
        $response = array();
        if($title!='')
        {
			$this->db->like('name',$title);
            $this->db->or_like('disignation',$title);
			$this->db->or_like('location',$title);
        }      
        $this->db->limit($limit,$si);                  
        $sql = $this->db->select("*")->from('da_users_tbl')->order_by('user_id','desc')->get();
        //echo $this->db->last_query();
        $count = $sql->num_rows();
        $resposne['code'] = ($count > 0) ? 200 : 204;
        $resposne['message'] = ($count > 0) ? 'Success' : 'Fail';
        $resposne['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $resposne['books'] = ($count > 0) ? $sql->result() : array();
        return json_encode($resposne);        
    }
    public function get_stock($title)
    {
        $qry = $this->db->select('stock')->from('rl_books_tbl b')->where('title',$title)->get()->row();
        if($qry == '')
        {
            return 0;
        }
        else
        {
            return $qry->stock;
        }
    }
	  public function get_employeesdata($table, $uid) {
      
        $this->db->where('employee_id', $uid);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {

            $result = $query->row();
        }else{
			$result = null;
		}
          $result= json_encode($result);
        return $result;
        //print_r($result);
       }
	   
	      public function getData($cols,$table_name,$list_name,$where=NULL)
    {
        $response=array();
        if($where)
        {
            $this->db->where($where);
        }
        $query=$this->db->select($cols)->from($table_name)->get();
        //echo $this->db->last_query();exit;
        $db_error=$this->db->error();
        if($db_error['code']!=0){
            $response['code']='575';
            $resposne['message']='';
            $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
        }
        else
        {
            $count=$query->num_rows();
            $response['code']=($count > 0)?200 :204;
            $response['message']=($count  > 0 )?'Success':'Fail';
            $response['description']=($count  > 0 )?'Getting the '.$list_name.' data':'No results found';
            $response['result_count']=$count;
            $response[($list_name!='')?$list_name:'common_result']=($count  > 0 )?$query->result():(object) null;
        }
        return json_encode($response);
    }
	   public function getDataOwners($list_name,$where=NULL)
    {
        $response=array();
        if($where)
        {
            $this->db->where($where);
        }
         $this->db->select("*")->from("qr_code_employees_tbl")
        ->join('qr_codes_owners_tbl','qr_code_employees_tbl.employee_id=qr_codes_owners_tbl.employee_id','inner');
        $query=$this->db->get();
        //echo $this->db->last_query();exit;
        $db_error=$this->db->error();
        if($db_error['code']!=0){
            $response['code']='575';
            $resposne['message']='';
            $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
        }
        else
        {
            $count=$query->num_rows();
            $response['code']=($count > 0)?200 :204;
            $response['message']=($count  > 0 )?'Success':'Fail';
            $response['description']=($count  > 0 )?'Getting the '.$list_name.' data':'No results found';
            $response['result_count']=$count;
            $response[($list_name!='')?$list_name:'common_result']=($count  > 0 )?$query->result():(object) null;
        }
        return json_encode($response);
    }
	public function qo(){
		 $this->db->select("*")->from("qr_code_employees_tbl")
        ->join('qr_codes_owners_tbl','qr_code_employees_tbl.employee_id=qr_codes_owners_tbl.employee_id');
     return   $query=$this->db->where('qr_code_employees_tbl.employee_id',1)->get()->result_array();
	}
}
?>