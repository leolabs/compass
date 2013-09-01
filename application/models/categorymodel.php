<?php

class CategoryModel extends CI_Model
{
    private $categoriesTable = 'categories';
    private $connectionTable = 'users_to_categories';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Returns a list of categories belonging to a given customer
     *
     * @param $customerID int the customer's ID
     * @param $topOnly bool should only top-level categories be shown?
     *
     * @return array an array containing the results
     */
    public function getCategoriesForCustomer($customerID, $topOnly = false)
    {
        $this->db->select("ID, Name, ParentID, ABS(0) AS ReadOnly");
        $this->db->where(array("CustomerID" => $customerID));
        if ($topOnly) $this->db->where("ParentID", 0);
        return $this->db->get($this->categoriesTable)->result_array();
    }

    /**
     * Returns a list of categories belonging to a given user
     *
     * @param $userID int the user's ID
     * @param $topOnly bool should only top-level categories be shown?
     *
     * @return array an array containing the results
     */
    public function getCategoriesForUser($userID, $topOnly = false)
    {
        $this->db->select("uc.CategoryID AS ID, c.Name, c.ParentID, uc.ReadOnly");
        $this->db->from('`' . $this->categoriesTable . '` AS c,  `' . $this->connectionTable . '` AS uc');
        $this->db->where("uc.CategoryID = c.ID")->where("uc.UserID", $userID);
        if ($topOnly) $this->db->where("c.ParentID", 0);
        return $this->db->get()->result_array();
    }

    /**
     * Adds a category to the categories table
     *
     * @param $customerID int the customer's ID
     * @param $name string the category's name
     * @param $parent int the parent category
     * @return object the operation's result
     */
    public function addCategory($customerID, $name, $parent = 0)
    {
        $data = array(
            "CustomerID" => $customerID,
            "Name" => $name,
            "ParentID" => $parent
        );

        return $this->db->insert($this->categoriesTable, $data);
    }

    /**
     * Adds an assignment of a user to a category
     *
     * @param $categoryID int the category's ID
     * @param $userID int the user's ID
     * @param $readOnly bool should the user only be able to view the entries?
     * @return object the operation's result
     */
    public function addCategoryAssignment($categoryID, $userID, $readOnly = true)
    {
        $data = array(
            "CategoryID" => $categoryID,
            "UserID" => $userID,
            "ReadOnly" => $readOnly
        );

        return $this->db->insert($this->connectionTable, $data);
    }

    /**
     * Edits an assignment of a user to a category based on the userID and categoryID
     *
     * @param $categoryID int the category's ID
     * @param $userID int the user's ID
     * @param $readOnly bool should the user only be able to view the entries?
     * @return object the operation's result
     */
    public function changeCategoryAssignment($categoryID, $userID, $readOnly = true)
    {
        $data = array(
            "ReadOnly" => $readOnly
        );

        $filter = array(
            "CategoryID" => $categoryID,
            "UserID" => $userID
        );

        return $this->db->update($this->connectionTable, $data, $filter);
    }

    /**
     * Deletes an assignment of a user to a category based on the userID and categoryID
     *
     * @param $categoryID int the category's ID
     * @param $userID int the user's ID
     * @return object the operation's result
     */
    public function deleteCategoryAssignment($categoryID, $userID)
    {
        $filter = array(
            "CategoryID" => $categoryID,
            "UserID" => $userID
        );

        return $this->db->delete($this->connectionTable, $filter);
    }

    /**
     * Returns a single category by it's ID
     *
     * @param $id int the category's ID
     * @param $customerID int the customer's ID
     * @param null|int $userID the userID or null if it doesn't matter
     * @return array|null the result or null if no result found
     */
    public function getSingleCategoryByID($id, $customerID, $userID = null){
        $this->db->select("uc.CategoryID AS ID, c.Name, c.ParentID, uc.ReadOnly");
        $this->db->from('`' . $this->categoriesTable . '` AS c,  `' . $this->connectionTable . '` AS uc');
        $this->db->where("uc.CategoryID = c.ID")->where("c.ID", $id)->where("c.CustomerID", $customerID);
        if($userID != null) $this->db->where("uc.UserID", $userID);
        $result = $this->db->get()->result_array();

        if(count($result) > 0){
            return $result[0];
        }else{
            return null;
        }
    }
}