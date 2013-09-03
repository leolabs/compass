<?php

class User extends API_Controller {
    public function post($param, $data)
    {
        if(!isset($data['PasswordHash']) ||
            !isset($data['Mail']) || !isset($data['NameFirst']) ||
            !isset($data['NameLast']) || !isset($data['Level']))
        {
            $this->apiOutput(false, 400, "Some data is missing. Please check if you have sent the fields " .
                "CustomerID, PasswordHash, Mail, NameFirst, NameLast and Level.", $data);
            return;
        }

        if($data['Level'] > $this->userData['Level']){
            $this->apiOutput(false, 403, "This user doesn't have the sufficient rights to add a user with " .
                "rights higher than himself (" . $data['Level'] . ">" . $this->userData['Level'] . ").");
            return;
        }

        $data['CustomerID'] = $this->userData['CustomerID'];

        if($this->userData['Level'] < 2){
            $this->apiOutput(false, 403, "This user doesn't have the sufficient rights to add a user.");
            return;
        }

        $response = $this->usermodel->addUser(
            $data['CustomerID'], $data['PasswordHash'], $data['Mail'],
            $data['NameFirst'], $data['NameLast'], $data['Level']
        );

        if($response){
            $this->apiOutput(true, 200, "The entry has been successfully inserted.");
        }else{
            $this->apiOutput(true, 500, "The insertion failed because of an unknown error. Please try again later.");
        }
    }

    function get($id, $data)
    {
        if($id == "index"){
            if($this->userData['Level'] >= 2){
                $response = $this->usermodel->getUsersForCustomer($this->userData['CustomerID']);

                if(count($response) > 0){
                    $this->apiOutput(true, 200, "Users found.", $response);
                }else{
                    $this->apiOutput(false, 404, "No matching users found.");
                }
            }else{
                // No need to make another DB request
                $response = array($this->userData);
                $this->apiOutput(true, 200, "Own user found.", $response);
            }
        }else{
            if($this->userData['Level'] >= 2){
                $response = $this->usermodel->getUsersFiltered(
                    array("ID" => $id, "CustomerID" => $this->userData['CustomerID']));

                if(count($response) > 0){
                    $this->apiOutput(true, 200, "A matching user was found.", $response[0]);
                }else{
                    $this->apiOutput(false, 404, "A user with this ID doesn't exist.");
                }
            }else{
                $this->apiOutput(false, 403, "This user doesn't have the sufficient rights to get users.");
            }
        }
    }

    function put($id, $data)
    {
        if(!isset($data['id']) || !isset($data['PasswordHash']) ||
            !isset($data['Mail']) || !isset($data['NameFirst']) ||
            !isset($data['NameLast']) || !isset($data['Level']))
        {
            $this->apiOutput(false, 400, "Some data is missing. Please check if you have sent the fields " .
                "CustomerID, PasswordHash, Mail, NameFirst, NameLast and Level.", $data);
            return;
        }

        if($this->userData['Level'] < 2 && $data['id'] != $this->userData['id']){
            $this->apiOutput(false, 403, "This user doesn't have the sufficient rights to update users.");
            return;
        }

        $currentUser = $this->usermodel->getSingleUserByID($data['id']);

        if($data['Level'] > $this->userData['Level']){
            $this->apiOutput(false, 403, "This user doesn't have the sufficient rights to add a user with " .
                "rights higher than himself (" . $data['Level'] . ">" . $this->userData['Level'] . ").");
            return;
        }

        if($currentUser == null){
            $this->apiOutput(false, 404, "The user that should be updated doesn't exist.");
            return;
        }

        if($this->userData['CustomerID'] != $currentUser['CustomerID']){
            $this->apiOutput(false, 401, "This user doesn't have sufficient rights to update the given user.");
            return;
        }

        $response = $this->usermodel->changeUserData(array("id" => $data['id']), $data);

        if($response){
            $this->apiOutput(true, 200, "The user was successfully updated.");
        }else{
            $this->apiOutput(false, 500, "The user couldn't be updated because of an unknown error.");
        }
    }

    function delete($id, $data)
    {
        // TODO: Implement delete() method.
    }
}