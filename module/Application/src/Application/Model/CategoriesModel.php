<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

/**
 * Class CategoriesModel
 * @package Application\Model
 */
class CategoriesModel
{
    const TABLE = 'pn_categories';

    /**
     * @var \Zend\Db\Sql\Sql
     */
    protected $sql;

    /**
     * @param Adapter $adapter
     */
    public function __construct(Adapter $adapter)
    {
        $this->sql = new Sql($adapter);
    }

    /**
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function getFull()
    {
        $select = $this->sql->select();
        $select->from(self::TABLE);
        $select->order('fullname ASC');
        $statement = $this->sql->prepareStatementForSqlObject($select);
        return $statement->execute();
    }

    /**
     * @param int $menu
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function getFullByMenu($menu = 0)
    {
        $select = $this->sql->select();
        $select->from(self::TABLE);
        $select->where(array('menu' => $menu));
        $select->order('fullname ASC');
        $statement = $this->sql->prepareStatementForSqlObject($select);
        return $statement->execute();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getByID($id = 0)
    {
        $select = $this->sql->select();
        $select->from(self::TABLE);
        $select->where(array('id' => $id));
        $select->limit(1);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        return $statement->execute()->current();
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getBySlug($slug = '')
    {
        $select = $this->sql->select();
        $select->from(self::TABLE);
        $select->where(array('slug' => $slug));
        $select->limit(1);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        return $statement->execute()->current();
    }

    /**
     * @param array $form
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function getInsert($form = array())
    {
        $insert = $this->sql->insert(self::TABLE);
        $insert->values(array(
            'fullname' => $form['fullname'],
            'slug' => $form['slug'],
            'menu' => $form['menu']
        ));
        $statement = $this->sql->prepareStatementForSqlObject($insert);
        return $statement->execute();
    }

    /**
     * @param int $id
     * @param array $form
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function getUpdate($id = 0, $form = array())
    {
        $update = $this->sql->update();
        $update->table(self::TABLE);
        $update->set(array(
            'fullname' => $form['fullname'],
            'slug' => $form['slug'],
            'menu' => $form['menu']
        ));
        $update->where(array('id' => $id));
        $updateStatement = $this->sql->prepareStatementForSqlObject($update);
        return $updateStatement->execute();
    }

    /**
     * @param int $id
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function getDelete($id = 0)
    {
        $delete = $this->sql->delete(self::TABLE);
        $delete->where(array('id' => $id));
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
}
