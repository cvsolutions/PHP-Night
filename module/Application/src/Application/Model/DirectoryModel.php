<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Predicate;
use Zend\Db\Sql\Sql;

/**
 * Class DirectoryModel
 * @package Application\Model
 */
class DirectoryModel
{
    const TABLE = 'pn_directory';

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
        $select->join('pn_categories', 'pn_categories.id = pn_directory.category_id', array('category_name' => 'fullname'));
        $select->order('fullname ASC');
        $statement = $this->sql->prepareStatementForSqlObject($select);
        return $statement->execute();
    }

    /**
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function getByHome()
    {
        $select = $this->sql->select();
        $select->from(self::TABLE);
        $select->join('pn_categories', 'pn_categories.id = pn_directory.category_id', array('category_name' => 'fullname'));
        $select->where(array('active' => 1));
        $select->order('publication DESC');
        $select->limit(25);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        return $statement->execute();
    }

    /**
     * @param int $category
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function getByCategory($category = 0)
    {
        $select = $this->sql->select();
        $select->from(self::TABLE);
        $select->where(array('category_id' => $category, 'active' => 1));
        $select->order('publication DESC');
        $statement = $this->sql->prepareStatementForSqlObject($select);
        return $statement->execute();
    }

    /**
     * @param string $q
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function getBySearch($q = '')
    {
        $select = $this->sql->select();
        $select->from(self::TABLE);
        $select->where(array(
            new Predicate\PredicateSet(
                array(
                    new Predicate\Like('fullname', '%' . $q . '%'),
                    new Predicate\Expression("tags REGEXP '[[:<:]]" . $q . "[[:>:]]'"),
                ),
                Predicate\PredicateSet::COMBINED_BY_OR
            ),
        ));
        $select->where(array('active' => 1));
        $select->order('publication DESC');
        // echo $this->sql->getSqlStringForSqlObject($select);
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
        $select->where(array('slug' => $slug, 'active' => 1));
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
            'description' => $form['description'],
            'website' => $form['website'],
            'tags' => $form['tags'],
            'category_id' => $form['category_id'],
            'publication' => new Expression('NOW()'),
            'auth_id' => $form['auth_id'],
            'active' => $form['active']
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
            'description' => $form['description'],
            'website' => $form['website'],
            'tags' => $form['tags'],
            'category_id' => $form['category_id'],
            'active' => $form['active']
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
