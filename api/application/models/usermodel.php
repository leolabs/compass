<?php

class UserModel extends CI_Model {
    private $usersTable = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Generates an SHA1 hash of the password
     *
     * @param $password string the given unhashed password
     * @return string the hashed result
     */
    public function generatePassHash($password)
    {
        return $this->sha1->generate($password . 'compass-fh39sjd');
    }

    /**
     * Returns all users that match a given filter
     *
     * @param array $filter the filter
     * @param null $limit MySQL limit
     * @param null $offset MySQL offset
     * @return mixed the result
     */
    public function getUsersFiltered($filter, $limit = NULL, $offset = NULL)
    {
        return $this->db->get_where($this->usersTable, $filter, $limit, $offset)->result_array();
    }

    /**
     * Checks if a given user exists
     *
     * @param $mail string the given email address
     * @param $password string the given password
     *
     * @return array the result as an array (Login Status | Matched user data)
     */
    public function tryLogin($mail, $password)
    {
        $result = $this->getUsersFiltered(array(
            "Mail" => $mail,
            "PasswordHash" => $this->generatePassHash($password)
        ), 1);

        if(count($result) > 0){
            return array(true, $result[0]);
        }else{
            return array(false, NULL);
        }
    }

    /**
     * Returns a single user by it's ID or null if no matching user was found
     *
     * @param $id int the user's ID
     * @return array|null
     */
    public function getSingleUserByID($id){
        $result = $this->db->get_where($this->usersTable, array("ID" => $id));

        if(count($result) > 0){
            return $result[0];
        }else{
            return null;
        }
    }

    /**
     * Adds a new user to the database
     *
     * @param $customerID int the customer's ID
     * @param $password string the unhashed new password
     * @param $mail string the email address
     * @param $nameFirst string the first name
     * @param $nameLast string the last name
     * @param $level int the user's level (0: Employee | 1: Moderator | 2: Admin)
     * @return object
     */
    public function addUser($customerID, $password, $mail, $nameFirst, $nameLast, $level){
        /*
         * Guest: See assigned categories, edit own profile
         * Moderator: Guest + See all categories, manage categories and users
         * Admin: Manage everything
         */

        $data = array(
            "CustomerID" => $customerID,
            "PasswordHash" => $this->generatePassHash($password),
            "Mail" => $mail,
            "NameFirst" => $nameFirst,
            "NameLast" => $nameLast,
            "Level" => $level
        );

        return $this->db->insert($this->usersTable, $data);
    }

    /**
     * Changes the user's level for every entry that matches the filter.
     *
     * @param $filter array the filter
     * @param $newLevel int the user's new level
     * @return mixed the operation's result
     */
    public function changeUserLevel($filter, $newLevel){
        return $this->db->where($filter)->update($this->usersTable, array("Level" => $newLevel));
    }

    /**
     * Changes the user's mail for every entry that matches the filter.
     *
     * @param $filter array the filter
     * @param $newMail string the user's new mail address
     * @return mixed the operation's result
     */
    public function changeUserMail($filter, $newMail){
        return $this->db->where($filter)->update($this->usersTable, array("Mail" => $newMail));
    }

    /**
     * Changes the user's mail for every entry that matches the filter.
     *
     * @param $filter array the filter
     * @param $newPass string the user's new password (unhashed)
     * @return mixed the operation's result
     */
    public function changeUserPassword($filter, $newPass){
        return $this->db->where($filter)->update($this->usersTable, array("Mail" => $this->generatePassHash($newPass)));
    }

    /**
     * Changes the user's data for every entry that matches the filter.
     *
     * @param $filter array the filter
     * @param $newData array the user's new data
     * @return mixed the operation's result
     */
    public function changeUserData($filter, $newData){
        return $this->db->where($filter)->update($this->usersTable, $newData);
    }

    /**
     * Deletes users matching the given filter
     *
     * @param $filter array the filter
     * @return object the operation's result
     */
    public function deleteUser($filter)
    {
        return $this->db->delete($this->usersTable, $filter);
    }
}