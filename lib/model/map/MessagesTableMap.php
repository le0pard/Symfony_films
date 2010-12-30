<?php


/**
 * This class defines the structure of the 'messages' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Fri Dec 31 00:41:05 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class MessagesTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.MessagesTableMap';

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
		$this->setName('messages');
		$this->setPhpName('Messages');
		$this->setClassname('Messages');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('messages_id_seq');
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('FROM_USER_ID', 'FromUserId', 'INTEGER', 'users', 'ID', false, null, null);
		$this->addForeignKey('TO_USER_ID', 'ToUserId', 'INTEGER', 'users', 'ID', true, null, null);
		$this->addColumn('MESSAGE_TYPE', 'MessageType', 'INTEGER', true, null, null);
		$this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('UsersRelatedByFromUserId', 'Users', RelationMap::MANY_TO_ONE, array('from_user_id' => 'id', ), null, null);
    $this->addRelation('UsersRelatedByToUserId', 'Users', RelationMap::MANY_TO_ONE, array('to_user_id' => 'id', ), null, null);
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

} // MessagesTableMap
