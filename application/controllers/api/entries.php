<?php

class Entries extends API_Controller {
    public function get($id, $data){
        if($id == "index"){
            if($this->userData['Level'] >= 1){
                $data = $this->entrymodel->getEntriesForCustomer($this->userData['CustomerID']);
            }else{
                $data = $this->entrymodel->getEntriesForUserByID($this->userData['id']);
            }

            if(count($data) > 0){
                $this->apiOutput(true, 200, 'Matching entries found.', $data);
            }else{
                $this->apiOutput(false, 404, 'No matching categories found.', $data);
            }
        }else{
            if($this->userData['Level'] >= 1){
                $data = $this->entrymodel->getSingleEntryByID($id, $this->userData['CustomerID']);
            }else{
                $data = $this->entrymodel->getSingleEntryByID($id);
                if(!$this->categorymodel->checkCategoryRights($this->userData['id'], $data['CategoryID'])){
                    $this->apiOutput(false, 403, "User doesn't have sufficient rights to view this entry.");
                    return;
                }
            }

            if($data != null){
                $this->apiOutput(true, 200, 'Matching entry found.', $data);
            }else{
                $this->apiOutput(false, 404, 'No matching entry found.', $data);
            }
        }
    }

    public function post($id, $data){
        if(!isset($data['CategoryID']) || !isset($data['EncryptedData'])){
            $this->apiOutput(false, 400, "Some data is missing. Please check if you have sent the fields CategoryID and EncryptedData.", $data);
            return;
        }

        if(!$this->categorymodel->checkCategoryRights($this->userData['id'], $data['CategoryID'], true)){
            $this->apiOutput(false, 403, "This user doesn't have the sufficient rights to add an entry to the given Category.");
            return;
        }

        $response = $this->entrymodel->addEntry(
            $this->userData['CustomerID'],
            $data['CategoryID'],
            $this->userData['id'],
            $data['EncryptedData']
        );

        if($response){
            $this->apiOutput(true, 200, "The entry has been successfully inserted.", array("id" => $this->db->insert_id()));
        }else{
            $this->apiOutput(true, 500, "The insertion failed because of an unknown error. Please try again later.");
        }
    }

    public function put($id, $data){
        if(!isset($data['CategoryID']) || !isset($data['EncryptedData']) || !isset($data['id'])){
            $this->apiOutput(false, 400, "Some data is missing. Please check if you have sent the fields ID, CategoryID and EncryptedData.", $data);
            return;
        }

        if(!$this->categorymodel->checkCategoryRights($this->userData['id'], $data['CategoryID'], true)){
            $this->apiOutput(false, 403, "This user doesn't have the sufficient rights to change an entry in the given Category.");
            return;
        }

        $response = $this->entrymodel->editEntry(
            $data['id'],
            $this->userData['id'],
            $data['CategoryID'],
            $data['EncryptedData']
        );

        if($response){
            $this->apiOutput(true, 200, "The entry has been successfully updated.");
        }else{
            $this->apiOutput(true, 500, "The update failed because of an unknown error. Please try again later.");
        }
    }

    public function delete($id, $data)
    {
        if(!isset($data['id']) || !isset($data['CategoryID'])){
            $this->apiOutput(false, 400, "Some data is missing. Please check if you have sent the field ID.", $data);
            return;
        }

        if(!$this->categorymodel->checkCategoryRights($this->userData['id'], $data['CategoryID'], true)){
            $this->apiOutput(false, 403, "This user doesn't have the sufficient rights to change an entry in the given Category.");
            return;
        }

        $response = $this->entrymodel->removeEntry($data['id'], $data['CategoryID']);

        if($response){
            $this->apiOutput(true, 200, "The entry has been successfully deleted.");
        }else{
            $this->apiOutput(true, 500, "The deletion failed because of an unknown error. Please try again later.");
        }
    }
}