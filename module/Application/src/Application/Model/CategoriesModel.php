<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

/**
 * CategoriesModel
 *
 * @uses
 *
 * @category Model
 * @package  Application
 * @author   Concetto Vecchio <info@cvsolutions.it>
 * @license  http://framework.zend.com/license/new-bsd New BSD License
 * @link     http://www.php-night.it
 */
class CategoriesModel
{

	const TABLE = 'pn_categories';

	/**
	 * $sql
	 *
	 * @var mixed
	 *
	 * @access protected
	 */
	protected $sql;

	/**
	 * __construct
	 *
	 * @param mixed \Adapter.
	 *
	 * @access public
	 *
	 * @return mixed Value.
	 */
	public function __construct(Adapter $adapter)
	{
		$this->sql = new Sql($adapter);
	}

	/**
	 * getFull
	 *
	 * @access public
	 *
	 * @return mixed Value.
	 */
	public function getFull()
	{
		$select = $this->sql->select();
		$select->from(self::TABLE);
		$select->order('fullname ASC');
		$statement = $this->sql->prepareStatementForSqlObject($select);
		return $statement->execute();
	}

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
	 * getByID
	 *
	 * @param int $id.
	 *
	 * @access public
	 *
	 * @return mixed Value.
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
	 * getBySlug
	 *
	 * @param string $slug.
	 *
	 * @access public
	 *
	 * @return mixed Value.
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
	 * getInsert
	 *
	 * @param array $form.
	 *
	 * @access public
	 *
	 * @return mixed Value.
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
	 * getUpdate
	 *
	 * @param int   $id.
	 * @param array $form.
	 *
	 * @access public
	 *
	 * @return mixed Value.
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
	 * getDelete
	 *
	 * @param int $id.
	 *
	 * @access public
	 *
	 * @return mixed Value.
	 */
	public function getDelete($id = 0)
	{
		$delete = $this->sql->delete(self::TABLE);
		$delete->where(array('id' => $id));
		$statement = $this->sql->prepareStatementForSqlObject($delete);
		return $statement->execute();
	}

}
