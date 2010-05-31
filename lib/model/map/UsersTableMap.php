<?php


/**
 * This class defines the structure of the 'users' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Вто 01 Июн 2010 02:33:35
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class UsersTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.UsersTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('users');
		$this->setPhpName('Users');
		$this->setClassname('Users');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('users_id_seq');
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('LOGIN', 'Login', 'VARCHAR', true, 100, null);
		$this->addColumn('PASSWORD', 'Password', 'VARCHAR', true, 100, null);
		$this->addColumn('PASSWORD_SALT', 'PasswordSalt', 'VARCHAR', true, 100, null);
		$this->addColumn('EMAIL', 'Email', 'VARCHAR', true, 100, null);
		$this->addColumn('WEBSITE_BLOG', 'WebsiteBlog', 'VARCHAR', false, 500, null);
		$this->addColumn('AVATAR', 'Avatar', 'VARCHAR', false, 500, null);
		$this->addColumn('GENDER', 'Gender', 'INTEGER', false, null, 0);
		$this->addColumn('ABOUT', 'About', 'LONGVARCHAR', false, null, null);
		$this->addColumn('LAST_LOGIN', 'LastLogin', 'TIMESTAMP', false, null, null);
		$this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', true, null, false);
		$this->addColumn('PERSISTENCE_TOKEN', 'PersistenceToken', 'VARCHAR', false, 200, '');
		$this->addColumn('IS_SUPER_ADMIN', 'IsSuperAdmin', 'BOOLEAN', true, null, false);
		$this->addColumn('COUNT_OF_FILMS', 'CountOfFilms', 'INTEGER', false, null, 0);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('UsersUsersGroup', 'UsersUsersGroup', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), 'CASCADE', null);
    $this->addRelation('UsersRememberKey', 'UsersRememberKey', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), 'CASCADE', null);
    $this->addRelation('FilmRelatedByUserId', 'Film', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null);
    $this->addRelation('FilmRelatedByModifiedUserId', 'Film', RelationMap::ONE_TO_MANY, array('id' => 'modified_user_id', ), null, null);
    $this->addRelation('FilmRaiting', 'FilmRaiting', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), 'CASCADE', null);
    $this->addRelation('Comments', 'Comments', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null);
    $this->addRelation('MessagesRelatedByFromUserId', 'Messages', RelationMap::ONE_TO_MANY, array('id' => 'from_user_id', ), null, null);
    $this->addRelation('MessagesRelatedByToUserId', 'Messages', RelationMap::ONE_TO_MANY, array('id' => 'to_user_id', ), null, null);
    $this->addRelation('UserFriendsRelatedByUserId', 'UserFriends', RelationMap::ONE_TO_ONE, array('id' => 'user_id', ), 'CASCADE', null);
    $this->addRelation('UserFriendsRelatedByFriendId', 'UserFriends', RelationMap::ONE_TO_MANY, array('id' => 'friend_id', ), 'CASCADE', null);
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
			'symfony_timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
		);
	} // getBehaviors()

} // UsersTableMap
