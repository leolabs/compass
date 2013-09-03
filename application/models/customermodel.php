<?php

class CustomerModel extends CI_Model {
    private $customerTable = "customers";

    public function getCustomerByID($customerID, $safe = true)
    {
        if($safe) $this->db->select("ID, CompanyName, NameFirst, NameLast");
        $result = $this->db->get_where($this->customerTable, array("ID" => $customerID))->result_array();

        if(count($result) > 0){
            return $result[0];
        }else{
            return null;
        }
    }
}