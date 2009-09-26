<?php


/**
 * This class adds structure of 'users' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Sun Sep 27 00:08:37 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class UsersMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.UsersMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(UsersPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(UsersPeer::TABLE_NAME);
		$tMap->setPhpName('Users');
		$tMap->setClassname('Users');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('LOGIN', 'Login', 'VARCHAR', true, 100);

		$tMap->addColumn('PASSWORD', 'Password', 'VARCHAR', true, 100);

		$tMap->addColumn('EMAIL', 'Email', 'VARCHAR', true, 100);

		$tMap->addColumn('WEBSITE_BLOG', 'WebsiteBlog', 'VARCHAR', false, 500);

		$tMap->addColumn('AVATAR', 'Avatar', 'VARCHAR', false, 500);

		$tMap->addColumn('ABOUT', 'About', 'LONGVARCHAR', false, null);

		$tMap->addColumn('LAST_LOGIN', 'LastLogin', 'TIMESTAMP', false, null);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', true, null);

		$tMap->addColumn('IS_SUPER_ADMIN', 'IsSuperAdmin', 'BOOLEAN', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} // doBuild()

} // UsersMapBuilder
