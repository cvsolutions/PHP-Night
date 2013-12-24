<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Predicate;

/**
 * DirectoryModel
 *
 * @uses
 *
 * @category Model
 * @package  Application
 * @author   Concetto Vecchio <info@cvsolutions.it>
 * @license  http://framework.zend.com/license/new-bsd New BSD License
 * @link     http://www.php-night.it
 */
class DirectoryModel
{

	const TABLE = 'pn_directory';

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
		$select->join('pn_categories', 'pn_categories.id = pn_directory.category_id', array('category_name' => 'fullname'));
		$select->order('fullname ASC');
		$statement = $this->sql->prepareStatementForSqlObject($select);
		return $statement->execute();
	}

	/**
	 * getByHome
	 *
	 * @access public
	 *
	 * @return mixed Value.
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
	 * getByCategory
	 *
	 * @param int $category.
	 *
	 * @access public
	 *
	 * @return mixed Value.
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
	 * getBySearch
	 *
	 * @param string $q.
	 *
	 * @access public
	 *
	 * @return mixed Value.
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
		$select->where(array('slug' => $slug, 'active' => 1));
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
				'fullname'    => $form['fullname'],
				'slug'        => $form['slug'],
				'description' => $form['description'],
				'website'     => $form['website'],
				'tags'        => $form['tags'],
				'category_id' => $form['category_id'],
				'publication' => new Expression('NOW()'),
				'auth_id'     => $form['auth_id'],
				'active'      => $form['active']
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
				'fullname'    => $form['fullname'],
				'slug'        => $form['slug'],
				'description' => $form['description'],
				'website'     => $form['website'],
				'tags'        => $form['tags'],
				'category_id' => $form['category_id'],
				'active'      => $form['active']
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
