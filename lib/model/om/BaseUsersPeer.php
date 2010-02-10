<?php

/**
 * Base static class for performing query and update operations on the 'users' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Wed Feb 10 19:04:37 2010
 *
 * @package    lib.model.om
 */
abstract class BaseUsersPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'users';

	/** the related Propel class for this table */
	const OM_CLASS = 'Users';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.Users';

	/** the related TableMap class for this table */
	const TM_CLASS = 'UsersTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 16;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the ID field */
	const ID = 'users.ID';

	/** the column name for the LOGIN field */
	const LOGIN = 'users.LOGIN';

	/** the column name for the PASSWORD field */
	const PASSWORD = 'users.PASSWORD';

	/** the column name for the PASSWORD_SALT field */
	const PASSWORD_SALT = 'users.PASSWORD_SALT';

	/** the column name for the EMAIL field */
	const EMAIL = 'users.EMAIL';

	/** the column name for the WEBSITE_BLOG field */
	const WEBSITE_BLOG = 'users.WEBSITE_BLOG';

	/** the column name for the AVATAR field */
	const AVATAR = 'users.AVATAR';

	/** the column name for the GENDER field */
	const GENDER = 'users.GENDER';

	/** the column name for the ABOUT field */
	const ABOUT = 'users.ABOUT';

	/** the column name for the LAST_LOGIN field */
	const LAST_LOGIN = 'users.LAST_LOGIN';

	/** the column name for the IS_ACTIVE field */
	const IS_ACTIVE = 'users.IS_ACTIVE';

	/** the column name for the PERSISTENCE_TOKEN field */
	const PERSISTENCE_TOKEN = 'users.PERSISTENCE_TOKEN';

	/** the column name for the IS_SUPER_ADMIN field */
	const IS_SUPER_ADMIN = 'users.IS_SUPER_ADMIN';

	/** the column name for the COUNT_OF_FILMS field */
	const COUNT_OF_FILMS = 'users.COUNT_OF_FILMS';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'users.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'users.UPDATED_AT';

	/**
	 * An identiy map to hold any loaded instances of Users objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array Users[]
	 */
	public static $instances = array();


	// symfony behavior
	
	/**
	 * Indicates whether the current model includes I18N.
	 */
	const IS_I18N = false;

	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Login', 'Password', 'PasswordSalt', 'Email', 'WebsiteBlog', 'Avatar', 'Gender', 'About', 'LastLogin', 'IsActive', 'PersistenceToken', 'IsSuperAdmin', 'CountOfFilms', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'login', 'password', 'passwordSalt', 'email', 'websiteBlog', 'avatar', 'gender', 'about', 'lastLogin', 'isActive', 'persistenceToken', 'isSuperAdmin', 'countOfFilms', 'createdAt', 'updatedAt', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::LOGIN, self::PASSWORD, self::PASSWORD_SALT, self::EMAIL, self::WEBSITE_BLOG, self::AVATAR, self::GENDER, self::ABOUT, self::LAST_LOGIN, self::IS_ACTIVE, self::PERSISTENCE_TOKEN, self::IS_SUPER_ADMIN, self::COUNT_OF_FILMS, self::CREATED_AT, self::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'login', 'password', 'password_salt', 'email', 'website_blog', 'avatar', 'gender', 'about', 'last_login', 'is_active', 'persistence_token', 'is_super_admin', 'count_of_films', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Login' => 1, 'Password' => 2, 'PasswordSalt' => 3, 'Email' => 4, 'WebsiteBlog' => 5, 'Avatar' => 6, 'Gender' => 7, 'About' => 8, 'LastLogin' => 9, 'IsActive' => 10, 'PersistenceToken' => 11, 'IsSuperAdmin' => 12, 'CountOfFilms' => 13, 'CreatedAt' => 14, 'UpdatedAt' => 15, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'login' => 1, 'password' => 2, 'passwordSalt' => 3, 'email' => 4, 'websiteBlog' => 5, 'avatar' => 6, 'gender' => 7, 'about' => 8, 'lastLogin' => 9, 'isActive' => 10, 'persistenceToken' => 11, 'isSuperAdmin' => 12, 'countOfFilms' => 13, 'createdAt' => 14, 'updatedAt' => 15, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::LOGIN => 1, self::PASSWORD => 2, self::PASSWORD_SALT => 3, self::EMAIL => 4, self::WEBSITE_BLOG => 5, self::AVATAR => 6, self::GENDER => 7, self::ABOUT => 8, self::LAST_LOGIN => 9, self::IS_ACTIVE => 10, self::PERSISTENCE_TOKEN => 11, self::IS_SUPER_ADMIN => 12, self::COUNT_OF_FILMS => 13, self::CREATED_AT => 14, self::UPDATED_AT => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'login' => 1, 'password' => 2, 'password_salt' => 3, 'email' => 4, 'website_blog' => 5, 'avatar' => 6, 'gender' => 7, 'about' => 8, 'last_login' => 9, 'is_active' => 10, 'persistence_token' => 11, 'is_super_admin' => 12, 'count_of_films' => 13, 'created_at' => 14, 'updated_at' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. UsersPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(UsersPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{
		$criteria->addSelectColumn(UsersPeer::ID);
		$criteria->addSelectColumn(UsersPeer::LOGIN);
		$criteria->addSelectColumn(UsersPeer::PASSWORD);
		$criteria->addSelectColumn(UsersPeer::PASSWORD_SALT);
		$criteria->addSelectColumn(UsersPeer::EMAIL);
		$criteria->addSelectColumn(UsersPeer::WEBSITE_BLOG);
		$criteria->addSelectColumn(UsersPeer::AVATAR);
		$criteria->addSelectColumn(UsersPeer::GENDER);
		$criteria->addSelectColumn(UsersPeer::ABOUT);
		$criteria->addSelectColumn(UsersPeer::LAST_LOGIN);
		$criteria->addSelectColumn(UsersPeer::IS_ACTIVE);
		$criteria->addSelectColumn(UsersPeer::PERSISTENCE_TOKEN);
		$criteria->addSelectColumn(UsersPeer::IS_SUPER_ADMIN);
		$criteria->addSelectColumn(UsersPeer::COUNT_OF_FILMS);
		$criteria->addSelectColumn(UsersPeer::CREATED_AT);
		$criteria->addSelectColumn(UsersPeer::UPDATED_AT);
	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(UsersPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			UsersPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(UsersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		// symfony_behaviors behavior
		foreach (sfMixer::getCallables(self::getMixerPreSelectHook(__FUNCTION__)) as $sf_hook)
		{
		  call_user_func($sf_hook, 'BaseUsersPeer', $criteria, $con);
		}

		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     Users
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = UsersPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return UsersPeer::populateObjects(UsersPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(UsersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			UsersPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      Users $value A Users object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(Users $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A Users object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Users) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Users object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     Users Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Method to invalidate the instance pool of all tables related to users
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
		// invalidate objects in UsersUsersGroupPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
		UsersUsersGroupPeer::clearInstancePool();

		// invalidate objects in UsersRememberKeyPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
		UsersRememberKeyPeer::clearInstancePool();

		// invalidate objects in FilmRaitingPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
		FilmRaitingPeer::clearInstancePool();

		// invalidate objects in UserFriendsPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
		UserFriendsPeer::clearInstancePool();

		// invalidate objects in UserFriendsPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
		UserFriendsPeer::clearInstancePool();

	}

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol] === null) {
			return null;
		}
		return (string) $row[$startcol];
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = UsersPeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = UsersPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = UsersPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				UsersPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}
	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * Add a TableMap instance to the database for this peer class.
	 */
	public static function buildTableMap()
	{
	  $dbMap = Propel::getDatabaseMap(BaseUsersPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseUsersPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new UsersTableMap());
	  }
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * If $withPrefix is true, the returned path
	 * uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @param      boolean  Whether or not to return the path wit hthe class name 
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? UsersPeer::CLASS_DEFAULT : UsersPeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a Users or Criteria object.
	 *
	 * @param      mixed $values Criteria or Users object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseUsersPeer:doInsert:pre') as $sf_hook)
    {
      if (false !== $sf_hook_retval = call_user_func($sf_hook, 'BaseUsersPeer', $values, $con))
      {
        return $sf_hook_retval;
      }
    }

		if ($con === null) {
			$con = Propel::getConnection(UsersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from Users object
		}

		if ($criteria->containsKey(UsersPeer::ID) && $criteria->keyContainsValue(UsersPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.UsersPeer::ID.')');
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseUsersPeer:doInsert:post') as $sf_hook)
    {
      call_user_func($sf_hook, 'BaseUsersPeer', $values, $con, $pk);
    }

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a Users or Criteria object.
	 *
	 * @param      mixed $values Criteria or Users object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseUsersPeer:doUpdate:pre') as $sf_hook)
    {
      if (false !== $sf_hook_retval = call_user_func($sf_hook, 'BaseUsersPeer', $values, $con))
      {
        return $sf_hook_retval;
      }
    }

		if ($con === null) {
			$con = Propel::getConnection(UsersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(UsersPeer::ID);
			$selectCriteria->add(UsersPeer::ID, $criteria->remove(UsersPeer::ID), $comparison);

		} else { // $values is Users object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);

    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseUsersPeer:doUpdate:post') as $sf_hook)
    {
      call_user_func($sf_hook, 'BaseUsersPeer', $values, $con, $ret);
    }

    return $ret;
	}

	/**
	 * Method to DELETE all rows from the users table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(UsersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += UsersPeer::doOnDeleteCascade(new Criteria(UsersPeer::DATABASE_NAME), $con);
			$affectedRows += BasePeer::doDeleteAll(UsersPeer::TABLE_NAME, $con);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			UsersPeer::clearInstancePool();
			UsersPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Users or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Users object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(UsersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			UsersPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof Users) {
			// invalidate the cache for this single object
			UsersPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(UsersPeer::ID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				UsersPeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += UsersPeer::doOnDeleteCascade($criteria, $con);
			
				// Because this db requires some delete cascade/set null emulation, we have to
				// clear the cached instance *after* the emulation has happened (since
				// instances get re-added by the select statement contained therein).
				if ($values instanceof Criteria) {
					UsersPeer::clearInstancePool();
				} else { // it's a PK or object
					UsersPeer::removeInstanceFromPool($values);
				}
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			UsersPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * This is a method for emulating ON DELETE CASCADE for DBs that don't support this
	 * feature (like MySQL or SQLite).
	 *
	 * This method is not very speedy because it must perform a query first to get
	 * the implicated records and then perform the deletes by calling those Peer classes.
	 *
	 * This method should be used within a transaction if possible.
	 *
	 * @param      Criteria $criteria
	 * @param      PropelPDO $con
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	protected static function doOnDeleteCascade(Criteria $criteria, PropelPDO $con)
	{
		// initialize var to track total num of affected rows
		$affectedRows = 0;

		// first find the objects that are implicated by the $criteria
		$objects = UsersPeer::doSelect($criteria, $con);
		foreach ($objects as $obj) {


			// delete related UsersUsersGroup objects
			$criteria = new Criteria(UsersUsersGroupPeer::DATABASE_NAME);
			
			$criteria->add(UsersUsersGroupPeer::USER_ID, $obj->getId());
			$affectedRows += UsersUsersGroupPeer::doDelete($criteria, $con);

			// delete related UsersRememberKey objects
			$criteria = new Criteria(UsersRememberKeyPeer::DATABASE_NAME);
			
			$criteria->add(UsersRememberKeyPeer::USER_ID, $obj->getId());
			$affectedRows += UsersRememberKeyPeer::doDelete($criteria, $con);

			// delete related FilmRaiting objects
			$criteria = new Criteria(FilmRaitingPeer::DATABASE_NAME);
			
			$criteria->add(FilmRaitingPeer::USER_ID, $obj->getId());
			$affectedRows += FilmRaitingPeer::doDelete($criteria, $con);

			// delete related UserFriends objects
			$criteria = new Criteria(UserFriendsPeer::DATABASE_NAME);
			
			$criteria->add(UserFriendsPeer::USER_ID, $obj->getId());
			$affectedRows += UserFriendsPeer::doDelete($criteria, $con);

			// delete related UserFriends objects
			$criteria = new Criteria(UserFriendsPeer::DATABASE_NAME);
			
			$criteria->add(UserFriendsPeer::FRIEND_ID, $obj->getId());
			$affectedRows += UserFriendsPeer::doDelete($criteria, $con);
		}
		return $affectedRows;
	}

	/**
	 * Validates all modified columns of given Users object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Users $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Users $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UsersPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UsersPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(UsersPeer::DATABASE_NAME, UsersPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     Users
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = UsersPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(UsersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(UsersPeer::DATABASE_NAME);
		$criteria->add(UsersPeer::ID, $pk);

		$v = UsersPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(UsersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(UsersPeer::DATABASE_NAME);
			$criteria->add(UsersPeer::ID, $pks, Criteria::IN);
			$objs = UsersPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

	// symfony behavior
	
	/**
	 * Returns an array of arrays that contain columns in each unique index.
	 *
	 * @return array
	 */
	static public function getUniqueColumnNames()
	{
	  return array(array('login'), array('email'));
	}

	// symfony_behaviors behavior
	
	/**
	 * Returns the name of the hook to call from inside the supplied method.
	 *
	 * @param string $method The calling method
	 *
	 * @return string A hook name for {@link sfMixer}
	 *
	 * @throws LogicException If the method name is not recognized
	 */
	static private function getMixerPreSelectHook($method)
	{
	  if (preg_match('/^do(Select|Count)(Join(All(Except)?)?|Stmt)?/', $method, $match))
	  {
	    return sprintf('BaseUsersPeer:%s:%1$s', 'Count' == $match[1] ? 'doCount' : $match[0]);
	  }
	
	  throw new LogicException(sprintf('Unrecognized function "%s"', $method));
	}

} // BaseUsersPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseUsersPeer::buildTableMap();

