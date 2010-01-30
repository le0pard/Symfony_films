<?php


/**
 * This class defines the structure of the 'user_friends' table.
 *
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Sat Jan 30 21:25:06 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class UserFriendsTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.UserFriendsTableMap';

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
		$this->setName('user_friends');
		$this->setPhpName('UserFriends');
		$this->setClassname('UserFriends');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('USER_ID', 'UserId', 'INTEGER' , 'users', 'ID', true, null, null);
		$this->addForeignKey('FRIEND_ID', 'FriendId', 'INTEGER', 'users', 'ID', true, null, null);
		$this->addColumn('COMMIT', 'Commit', 'BOOLEAN', true, null, false);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('UsersRelatedByUserId', 'Users', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('UsersRelatedByFriendId', 'Users', RelationMap::MANY_TO_ONE, array('friend_id' => 'id', ), 'CASCADE', null);
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
		);
	} // getBehaviors()

} // UserFriendsTableMap
