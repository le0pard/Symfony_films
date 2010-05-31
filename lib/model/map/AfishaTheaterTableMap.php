<?php


/**
 * This class defines the structure of the 'afisha_theater' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Вто 01 Июн 2010 02:33:37
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class AfishaTheaterTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.AfishaTheaterTableMap';

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
		$this->setName('afisha_theater');
		$this->setPhpName('AfishaTheater');
		$this->setClassname('AfishaTheater');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('afisha_theater_id_seq');
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('EXTERNAL_ID', 'ExternalId', 'VARCHAR', false, 500, '');
		$this->addForeignKey('AFISHA_CITY_ID', 'AfishaCityId', 'INTEGER', 'afisha_city', 'ID', true, null, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', true, 500, null);
		$this->addColumn('LINK', 'Link', 'VARCHAR', false, 255, null);
		$this->addColumn('ADDRESS', 'Address', 'VARCHAR', false, 500, null);
		$this->addColumn('PHONE', 'Phone', 'VARCHAR', false, 500, null);
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
    $this->addRelation('AfishaCity', 'AfishaCity', RelationMap::MANY_TO_ONE, array('afisha_city_id' => 'id', ), null, null);
    $this->addRelation('Afisha', 'Afisha', RelationMap::ONE_TO_MANY, array('id' => 'afisha_theater_id', ), null, null);
    $this->addRelation('AfishaZal', 'AfishaZal', RelationMap::ONE_TO_MANY, array('id' => 'afisha_theater_id', ), 'CASCADE', null);
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

} // AfishaTheaterTableMap
