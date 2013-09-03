<?php

class Categories extends API_Controller {
    public function get($id, $data)
    {
        if($id == "index"){
            if($this->userData['Level'] >= 1){
                $data = $this->categorymodel->getCategoriesForCustomer($this->userData['CustomerID']);
            }else{
                $data = $this->categorymodel->getCategoriesForUser($this->userData['id']);
            }

            if(count($data) > 0){
                $this->apiOutput(true, 200, 'Matching categories found.', $data);
            }else{
                $this->apiOutput(false, 404, 'No matching categories found.', $data);
            }
        }else{
            if($this->userData['Level'] >= 1){
                $data = $this->categorymodel->getSingleCategoryByID($id, $this->userData['CustomerID']);
            }else{
                $data = $this->categorymodel->getSingleCategoryByID($id, $this->userData['CustomerID'], $this->userData['id']);

                if($data == null){
                    $this->apiOutput(false, 403, "User doesn't have sufficient rights to view this category.");
                    return;
                }
            }

            if($data != null){
                $this->apiOutput(true, 200, 'Matching category found.', $data);
            }else{
                $this->apiOutput(false, 404, 'No matching category found.', $data);
            }
        }
    }

    function post($id, $data)
    {
        if(!isset($data['Name']) || !isset($data['ParentID'])){
            $this->apiOutput(false, 400, "Some data is missing. Please check if you have sent the fields ParentID and Name.");
            return;
        }

        if(!$this->categorymodel->checkCategoryRights($this->userData['id'], $data['CategoryID'], true) || $this->userData['Level'] < 1){
            $this->apiOutput(false, 403, "This user doesn't have the sufficient rights to add an entry to the given Category.");
            return;
        }

        $response = $this->categorymodel->addCategory(
            $this->userData['CustomerID'],
            $data['Name'],
            $data['ParentID']
        );

        if($response){
            $this->apiOutput(true, 200, "The category has been successfully inserted.", array("id" => $this->db->insert_id()));
        }else{
            $this->apiOutput(true, 500, "The insertion failed because of an unknown error. Please try again later.");
        }
    }

    function put($id, $data)
    {
        if(!isset($data['id']) || !isset($data['Name']) || !isset($data['ParentID'])){
            $this->apiOutput(false, 400, "Some data is missing. Please check if you have sent the fields ID, CategoryID and EncryptedData.", $data);
            return;
        }

        if(!$this->categorymodel->checkCategoryRights($this->userData['id'], $data['id'], true) || $this->userData['Level'] < 1){
            $this->apiOutput(false, 403, "This user doesn't have the sufficient rights to change an entry in the given Category.");
            return;
        }

        $response = $this->categorymodel->editCategory(
            $data['id'],
            $data['Name'],
            $data['ParentID']
        );

        if($response){
            $this->apiOutput(true, 200, "The entry has been successfully updated.");
        }else{
            $this->apiOutput(true, 500, "The update failed because of an unknown error. Please try again later.");
        }
    }

    function delete($id, $data)
    {
        if(!isset($data['id'])){
            $this->apiOutput(false, 400, "Some data is missing. Please check if you have sent the field id.", $data);
            return;
        }

        if(!$this->categorymodel->checkCategoryRights($this->userData['id'], $data['CategoryID'], true) || $this->userData['Level'] < 1){
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