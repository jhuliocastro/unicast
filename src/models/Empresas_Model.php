<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;
use Core\IModel;

class Empresas_Model extends DataLayer implements IModel {
    public function __construct()
    {
        parent::__construct("empresas", ["razaoSocial"], "id", true);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function register(array $data)
    {
        // TODO: Implement register() method.
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function edit(array $data)
    {
        // TODO: Implement edit() method.
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function exclude(int $id)
    {
        // TODO: Implement exclude() method.
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function dataID(int $id)
    {
        // TODO: Implement dataID() method.
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function dataName(string $name)
    {
        // TODO: Implement dataName() method.
    }

    /**
     * @return mixed
     */
    public function list()
    {
        // TODO: Implement list() method.
        return $this->find()->fetch(true);
    }

    /**
     * @param array $column
     * @return array
     */
    public function listColumn(string $column): array
    {
        // TODO: Implement listColumn() method.
        $dados = null;
        return $this->find(null, null, $column)->fetch(true);
    }
}