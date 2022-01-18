<?php
include_once "db/database.php";
include_once "db/operaitons.php";
class Subcategory extends database implements operations
{
    private $id;
    private $name_en;
    private $name_ar;
    private $image;
    private $status;
    private $category_id;
    private $created_at;
    private $updated_at;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNameEn()
    {
        return $this->name_en;
    }

    public function setNameEn($name_en)
    {
        $this->name_en = $name_en;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;
    }


    /**
     * Get the value of name_ar
     */
    public function getName_ar()
    {
        return $this->name_ar;
    }

    /**
     * Set the value of name_ar
     *
     * @return  self
     */
    public function setName_ar($name_ar)
    {
        $this->name_ar = $name_ar;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

      /**
     * Get the value of category_id
     */ 
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */ 
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;
    }


    public function selectData()
    {
    }
    public function insertData()
    {
    }
    public function deleteData()
    {
    }
    public function updateData()
    {
    }

    public function subcategoriesByCategory()
    {
       $query = "SELECT `subcategories`.`id`,`subcategories`.`name_en` FROM `subcategories`
        WHERE `subcategories`.`category_id` = $this->category_id ORDER BY `subcategories`.`name_en`";
        return $this->runDQL($query);
    }

    public function Findsubcategory()
    {
        $query = "SELECT `subcategories`.* FROM `subcategories` WHERE `subcategories`.`id` = $this->id ";
        return $this->runDQL($query);
    }
  
}
