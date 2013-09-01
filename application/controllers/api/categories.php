<?php

class Categories extends API_Controller {
    public function get($id)
    {
        if($this->checkUser(false)){
            if($id == "index"){
                if($this->userData['Level'] >= 1){
                    $data = $this->categorymodel->getCategoriesForCustomer($this->userData['CustomerID']);
                }else{
                    $data = $this->categorymodel->getCategoriesForUser($this->userData['ID']);
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
                    $data = $this->categorymodel->getSingleCategoryByID($id, $this->userData['CustomerID'], $this->userData['ID']);
                }

                if($data != null){
                    $this->apiOutput(true, 200, 'Matching category found.', $data);
                }else{
                    $this->apiOutput(false, 404, 'No matching category found.', $data);
                }
            }
        }else{
            $this->apiOutput(false, 401, 'User is unauthorized.');
        }
    }
}