<?php


namespace simpleengine\models;


use simpleengine\core\Application;

class Order implements DbModelInterface
{
    private $id_user;
    private $amount;
    private $id;


    public function __construct($id_user, $amount)
    {
        $this->amount = $amount;
        $this->id_user = $id_user;
        $this->id = $this->generateNewId();
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function makeNewOrder() {
        $app = Application::instance();
        $sql = "INSERT INTO orders (`id`, `id_user`, `amount`, `id_order_status`)
                VALUES (".$this->id.", ".$this->id_user.", ".$this->amount.", 1)";
        if(!$app->db()->insertDataToDb($sql))
            throw new \Exception("We experience technical problems. Please try again later.1");
        try{
            $this->clearUsersCart();
        }catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    private function clearUsersCart() {
        $app = Application::instance();
        $sql = "UPDATE cart
                SET id_order = ".$this->id."
                WHERE id_user = ".$this->id_user;
        if(!$app->db()->insertDataToDb($sql))
            throw new \Exception("We experience technical problems. Please try again later.");
    }

    /**
     * @return int
     */
    private function generateNewId() {
        $id = $this->getLastId();
        $id++;

        return $id;
    }

    /**
     * @return int
     */
    private function getLastId() {
        $app = Application::instance();
        $sql = "SELECT id FROM orders ORDER BY id DESC LIMIT 1";
        $result = $app->db()->getArrayBySqlQuery($sql);

        return $result[0]['id'];
    }
}
