<?php


/**
 * This class defines the structure of the 'afisha_zal' table.
 *
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Sun Jan 17 01:37:47 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class AfishaZalTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.AfishaZalTableMap';

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
		$this->setName('afisha_zal');
		$this->setPhpName('AfishaZal');
		$this->setClassname('AfishaZal');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('EXTERNAL_ID', 'ExternalId', 'VARCHAR', false, 500, '');
		$this->addForeignKey('AFISHA_THEATER_ID', 'AfishaTheaterId', 'INTEGER', 'afisha_theater', 'ID', true, null, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', true, 500, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('AfishaTheater', 'AfishaTheater', RelationMap::MANY_TO_ONE, array('afisha_theater_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('Afisha', 'Afisha', RelationMap::ONE_TO_MANY, array('id' => 'afisha_zal_id', ), 'CASCADE', null);
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

} // AfishaZalTableMap
