<?php
include_once "db/database.php";
include_once "db/operaitons.php";
class Product extends database implements operations
{
    private $id;
    private $name_en;
    private $name_ar;
    private $image;
    private $status;
    private $code;
    private $amount;
    private $details_ar;
    private $details_en;
    private $price;
    private $brand_id;
    private $subcategory_id;
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
    public function getSubCategory_id()
    {
        return $this->subcategory_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */
    public function setSubCategory_id($subcategory_id)
    {
        $this->subcategory_id = $subcategory_id;

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
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
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



    /**
     * Get the value of code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of details_ar
     */
    public function getDetails_ar()
    {
        return $this->details_ar;
    }

    /**
     * Set the value of details_ar
     *
     * @return  self
     */
    public function setDetails_ar($details_ar)
    {
        $this->details_ar = $details_ar;

        return $this;
    }

    /**
     * Get the value of details_en
     */
    public function getDetails_en()
    {
        return $this->details_en;
    }

    /**
     * Set the value of details_en
     *
     * @return  self
     */
    public function setDetails_en($details_en)
    {
        $this->details_en = $details_en;

        return $this;
    }

    /**
     * Get the value of brand_id
     */
    public function getBrand_id()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     *
     * @return  self
     */
    public function setBrand_id($brand_id)
    {
        $this->brand_id = $brand_id;

        return $this;
    }


    public function selectData()
    {
        $query  = "SELECT `products`.`id`,`products`.`name_en`,`products`.`image`,`products`.`price`,`products`.`details_en` FROM `products` ORDER BY `products`.`name_en`";
        return $this->runDQL($query);
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

    public function getProductsBySub()
    {
        $query  = "SELECT `products`.`id`,`products`.`name_en`,`products`.`image`,`products`.`price`,`products`.`details_en` FROM `products` WHERE `products`.`subcategory_id` = $this->subcategory_id ORDER BY `products`.`name_en`";
        return $this->runDQL($query);
    }

    public function getProductByID()
    {
        $query = " SELECT `products_reviews`.* FROM `products_reviews` WHERE `products_reviews`.`id` = $this->id";
        return $this->runDQL($query);
    }

    public function getReviewsByProduct()
    {
        $query = "  SELECT
                        `reviews`.*,
                        `users`.`name`
                    FROM
                        `reviews`
                    JOIN `users` ON `reviews`.`user_id` = `users`.`id`
                    WHERE
                        `reviews`.`product_id` = $this->id
                    ORDER BY `reviews`.`created_at` ASC";
        return $this->runDQL($query);
    }

    public function getRecentProduct()
    {
        $query = " SELECT
    `products`.`id`,
    `products`.`name_en`,
    `products`.`image`,
    `products`.`price`

FROM
    `products`

ORDER BY `products`.`created_at` DESC LIMIT 4";
        return $this->runDQL($query);
    }

    public function mostRatedProduct(){
        $query="SELECT `products_reviews`.`name_en`,`products_reviews`.`name_ar`,
        `products_reviews`.`image`,`products_reviews`.`price`,`products_reviews`.`reviews_count`
        FROM `products_reviews`
        ORDER BY `products_reviews`.`reviews_count` DESC LIMIT 4";
          return $this->runDQL($query);
    }
}
