<?php

class EntryModel extends CI_Model {
    private $entryTable = 'entries';
    
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Adds an ecrypted entry to the database
     *
     * @param $customerID int the customer's ID
     * @param $categoryID int the category's ID
     * @param $userID int the ID of the user who created the entry
     * @param $encryptedData string the encrypted data
     * @return object the operation's result
     */
    public function addEntry($customerID, $categoryID, $userID, $encryptedData)
    {
        $data = array(
            "CustomerID" => $customerID,
            "CategoryID" => $categoryID,
            "EncryptedData" => $encryptedData,
            "CreatedUserID" => $userID,
            "EditedUserID" => $userID,
            "ViewedUserID" => $userID,
            "DateCreated" => strftime("%Y-%m-%d %H:%M:%S"),
            "DateEdited" => strftime("%Y-%m-%d %H:%M:%S"),
            "DateViewed" => strftime("%Y-%m-%d %H:%M:%S")
        );

        return $this->db->insert($this->entryTable, $data);
    }

    /**
     * Updates the entry's encrypted data
     *
     * @param $entryID int the entry's ID
     * @param $userID int the user's ID
     * @param $encryptedData string the new encrypted data
     * @return object the operation's result
     */
    public function editEntry($entryID, $userID, $encryptedData)
    {
        $data = array(
            "EditedUserID" => $userID,
            "DateEdited" => strftime("%Y-%m-%d %H:%M:%S"),
            "EncryptedData" => $encryptedData
        );

        $filter = array(
            "ID" => $entryID
        );

        return $this->db->update($this->entryTable, $data, $filter);
    }

    /**
     * Returns a list of all entries in one category
     *
     * @param $categoryID int the category's id
     * @return array the result
     */
    public function getEntriesInCategory($categoryID){
        return $this->db->get_where($this->entryTable, array("CategoryID" => $categoryID))->result_array();
    }

    /**
     * Returns a list of all entries in multiple categories
     *
     * @param $categoryIDs int the category's id
     * @return array the result
     */
    public function getEntriesInMultipleCategories($categoryIDs){
        return $this->db->where_in("CategoryID", $categoryIDs)->get($this->entryTable)->result_array();
    }

    /**
     * Returns one entry by it's ID or null if no entry is found
     *
     * @param $id int the entry's ID
     * @return array|null
     */
    public function getEntryByID($id){
        $data = $this->db->get_where($this->entryTable, array("ID" => $id));

        if(count($data) > 0){
            return $data[0];
        }else{
            return null;
        }
    }

    /**
     * Updates the date and user who viewed the given entry
     *
     * @param $id int the entry's ID
     * @param $userID int the user's ID
     * @return object the operation's result
     */
    public function updateEntryView($id, $userID)
    {
        $data = array(
            "ViewedUserID" => $userID,
            "DateViewed" => strftime("%Y-%m-%d %H:%M:%S")
        );

        $filter = array(
            "ID" => $id
        );

        return $this->db->update($this->entryTable, $data, $filter);
    }
}